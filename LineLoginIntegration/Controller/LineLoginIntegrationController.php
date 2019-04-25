<?php

namespace Plugin\LineLoginIntegration\Controller;

use Eccube\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Eccube\Controller\AbstractController;
use Plugin\LineLoginIntegration\Entity\LineLoginIntegration;
use Plugin\LineLoginIntegration\Controller\Admin\LineLoginIntegrationAdminController;

class LineLoginIntegrationController extends AbstractController
{

    private $lineChannelId;
    private $lineChannelSecret;

    const PLUGIN_LINE_LOGIN_INTEGRATION_SSO_USERID = 'plugin.line_login_integration.sso.userid';
    const PLUGIN_LINE_LOGIN_INTEGRATION_SSO_STATE = 'plugin.line_login_integration.sso.state';

    public function __construct()
    {
        $lineIntegrationSetting = $this->getLineLoginIntegrationSetting();
        $this->lineChannelId = $lineIntegrationSetting->getLineChannelId();
        $this->lineChannelSecret = $lineIntegrationSetting->getLineChannelSecret();
    }

    public function login(Application $app, Request $request)
    {
        $state = uniqid();
        $session = $request->getSession();
        $session->set(self::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_STATE, $state);
        // TODO bot_prompt
        // bot_prompt=normal or aggressive
        // https://developers.line.me/ja/docs/line-login/web/link-a-bot/
        $lineAuthUrl = 'https://access.line.me/oauth2/v2.1/authorize?response_type=code&client_id=' . $this->lineChannelId . '&redirect_uri=' . rawurlencode($app->url('plugin_line_login_callback')) . '&state=' . $state . '&scope=profile&bot_prompt=aggressive';
        return $app->redirect($lineAuthUrl);
    }

    public function loginCallback(Application $app, Request $request)
    {
        $code = $request->get('code');

        $session = $request->getSession();
        $originalState = $session->get(self::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_STATE);
        $state = $request->get('state');

        $session->remove(self::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_STATE);

        if (empty($state)) {
            log_error('LINE API エラー(1)');
            return $app->render('LineLoginIntegration/Resource/template/admin/error.twig');
        }
        if (empty($originalState)) {
            log_error('LINE API エラー(2)');
            return $app->render('LineLoginIntegration/Resource/template/admin/error.twig');
        }
        if ($state != $originalState) {
            log_error('LINE API エラー(3)');
            return $app->render('LineLoginIntegration/Resource/template/admin/error.twig');
        }

        $accessTokenUrl = "https://api.line.me/oauth2/v2.1/token";
        $accessTokenData = array(
            "grant_type" => "authorization_code",
            "code" => $code,
            "redirect_uri" => $app->url('plugin_line_login_callback'),
            "client_id" => $this->lineChannelId,
            "client_secret" => $this->lineChannelSecret,
        );
        $accessTokenData = http_build_query($accessTokenData, "", "&");
        $header = array(
            "Content-Type: application/x-www-form-urlencoded",
            "Content-Length: " . strlen($accessTokenData)
        );
        $context = array(
            "http" => array(
                "method" => "POST",
                "header" => implode("\r\n", $header),
                "content" => $accessTokenData
            )
        );

        $res = file_get_contents($accessTokenUrl, false, stream_context_create($context));
        $tokenJson = json_decode($res, true);
        if (isset($token['error'])) {
            log_error('LINE API エラー(4)' . $tokenJson['error'] . ' ' . $tokenJson['error_description']);
            return $app->render('LineLoginIntegration/Resource/template/admin/error.twig');
        }

        if (!array_key_exists("access_token", $tokenJson)) {
            log_error('LINE API エラー(5)');
        }

        $accessToken = $tokenJson['access_token'];
        $lineProfileUrl = "https://api.line.me/v2/profile";
        $context = array(
            "http" => array(
                "method" => "GET",
                "header" => "Authorization: Bearer " . $accessToken
            )
        );

        $res = file_get_contents($lineProfileUrl, false, stream_context_create($context));
        $profileJson = json_decode($res, true);
        if (!array_key_exists("userId", $profileJson)) {
            log_error('LINE API エラー(6)');
        }

        $lineUserId = $profileJson['userId'];
        if (empty($lineUserId)) {
            log_error('LINE API エラー(7)');
        }

        $session->set(self::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_USERID, $lineUserId);

        // TODO これがないとマイページ表示時にエラー（セッション？）
        $app['eccube.repository.customer']->findAll();

        $lineIntegrationRepository = $app['eccube.plugin.line_login_integration.repository.line_login_integration'];
        $lineIntegration = $lineIntegrationRepository->findOneBy(['line_user_id' => $lineUserId]);
        $customer = null;
        if (!is_null($lineIntegration)) {
            $customer = $lineIntegration->getCustomer();
            if (is_null($customer)) {
                // TODO 矛盾しているので削除？
                $lineIntegration = null;
                log_info('LINE_INTEGRATIONレコードあり、Customerレコードなし（矛盾した状態）');
                return $app->redirect($app->url('entry'));
            }
        }

        /*
          ・ROLE_ADMIN EC-CUBE３では管理者としてログインしていることを意味します。
          ・ROLE_USER EC-CUBE３では顧客としてログインしていることを意味します。
          ・IS_AUTHENTICATED_ANONYMOUSLY 匿名ユーザーを含みます。要はログインしていなくても表示できるという意味です。
          ・IS_AUTHENTICATED_REMEMBERED 「次回から自動的にログインする」機能によってログインしたユーザーです。
          ・IS_AUTHENTICATED_FULLY IS_AUTHENTICATED_REMEMBEREDの対比です。自動的にログインする機能ではなく、当セッション中にフォームで認証を行いログインしたユーザーです。
         */
        if ($app->isGranted('ROLE_USER')) {
            log_info('ログイン済み');

            if (is_null($lineIntegration)) {
                log_info('plg_line_login_integrationレコードなし');
                //  ログインユーザーのLINEIDが保存されていない場合、ログインユーザーとLINEIDを紐付ける
                $lineIntegration = new LineLoginIntegration();
                $lineIntegration->setLineUserId($lineUserId);
                $lineIntegration->setLineNotificationFlg(true);
                $lineIntegration->setCustomer($customer);
                $app['orm.em']->persist($lineIntegration);
                $app['orm.em']->flush();
            } else {
                log_info('plg_line_login_integrationレコードあり');
                // ログインユーザーのLINEIDが保存されている場合
                // なにもしない
            }

            return $app->redirect($app->url('mypage'));
        }
        log_info('未ログイン');

        if (is_null($lineIntegration)) {
            // 登録なし→新規登録のフロー
            log_info('plg_line_login_integrationレコードなし');

            return $app->redirect($app->url('entry'));
        } else {
            log_info('plg_line_login_integrationレコードあり');

            // 登録あり→ログイン状態にする
            $token = new UsernamePasswordToken($customer, null, 'customer', array('ROLE_USER'));
            $this->getSecurity($app)->setToken($token);
            log_info('ログイン済に変更', array($app->user()->getId()));

            return $app->redirect($app->url('mypage'));
        }
    }

    /**
     * 設定レコードの取得
     * @return type
     */
    private function getLineLoginIntegrationSetting()
    {
        $app = \Eccube\Application::getInstance();
        $lineIntegrationSettingRepository = $app['eccube.plugin.line_login_integration.repository.line_login_integration_setting'];
        $lineIntegrationSetting = $lineIntegrationSettingRepository->find(LineLoginIntegrationAdminController::LINE_LOGIN_INTEGRATION_SETTING_TABLE_ID);
        return $lineIntegrationSetting;
    }
}
