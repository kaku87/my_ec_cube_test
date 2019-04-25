<?php

namespace Plugin\LineLoginIntegration;

use Plugin\LineLoginIntegration\Controller\LineLoginIntegrationController;
use Plugin\LineLoginIntegration\Controller\Admin\LineLoginIntegrationAdminController;
use Plugin\LineLoginIntegration\Entity\LineLoginIntegration;
use Eccube\Event\EventArgs;
use Eccube\Event\TemplateEvent;

class LineLoginIntegrationEvent
{

    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * 会員情報変更画面の表示
     * @param TemplateEvent $event
     */
    public function onRenderMypageChange(TemplateEvent $event)
    {
        if (!$this->isLineSettingCompleted()) {
            return;
        }

        $this->isLineSettingCompleted();
    }

    /**
     * 新規会員登録画面の表示.
     * @param TemplateEvent $event
     */
    public function onRenderEntryIndex(TemplateEvent $event)
    {
        if (!$this->isLineSettingCompleted()) {
            return;
        }

        $session = $this->app['session'];
        $lineUserId = $session->get(LineLoginIntegrationController::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_USERID);
    }

    public function onRenderLineEntryButton(TemplateEvent $event)
    {
        if (!$this->isLineSettingCompleted()) {
            return;
        }

        $session = $this->app['session'];
        $lineUserId = $session->get(LineLoginIntegrationController::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_USERID);
        $snipet = '<div class="col-md-10 col-md-offset-1"><a href="' . $this->app->url('plugin_line_login') . '" class="line-button"><img src="' . $this->app->url('homepage') . 'plugin/line_login_integration/assets/img/btn_register_base.png"></a></div>' . PHP_EOL;
        $snipet .= PHP_EOL;
        if (!empty($lineUserId)) {
            $snipet .= '<div class="col-md-10 col-md-offset-1">LINEアカウントログイン済みです。会員登録を進めて下さい。</div>';
            $snipet .= PHP_EOL;
        }

        $search = '<div id="top_box" class="row">';
        $replace = $search . $snipet;
        $source = str_replace($search, $replace, $event->getSource());
        $event->setSource($source);
    }

    public function onRenderLineLoginButton(TemplateEvent $event)
    {
        if (!$this->isLineSettingCompleted()) {
            return;
        }

        $snipet = '<div class="col-sm-8 col-sm-offset-2" style="margin-bottom:5px;"><a href="' . $this->app->url('plugin_line_login') . '" class="line-button"><img src="' . $this->app->url('homepage') . 'plugin/line_login_integration/assets/img/btn_login_base.png"></a></div>' . PHP_EOL;
        $search = '<div id="login_box" class="row">';
        $replace = $search . $snipet;
        $source = str_replace($search, $replace, $event->getSource());
        $event->setSource($source);
    }

    public function onCompleteMypageWithdraw(EventArgs $event)
    {
        if (!$this->isLineSettingCompleted()) {
            return;
        }

        log_info('退会');
        // LINE情報を削除する
        $session = $this->app['session'];
        $lineUserId = $session->get(LineLoginIntegrationController::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_USERID);

        $lineIntegrationRepository = $this->app['eccube.plugin.line_login_integration.repository.line_login_integration'];
        $lineIntegration = $lineIntegrationRepository->findOneBy(['line_user_id' => $lineUserId]);
        if (!empty($lineIntegration)) {
            $lineIntegrationRepository->delete($lineIntegration);
        }

        $session->remove(LineLoginIntegrationController::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_STATE);
        $session->remove(LineLoginIntegrationController::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_USERID);
    }

    public function onCompleteEntry(EventArgs $event)
    {
        if (!$this->isLineSettingCompleted()) {
            return;
        }

        // 顧客とLINEユーザーIDをひも付け（line_login_integrationテーブルのレコードを作成）
        log_info('LINEユーザーとの関連付け開始');

        $session = $this->app['session'];
        $lineUserId = $session->get(LineLoginIntegrationController::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_USERID);
        if (!empty($lineUserId)) {
            log_info('LINEログインしているため、ユーザーとの関連付けを実行');
            $lineIntegrationRepository = $this->app['eccube.plugin.line_login_integration.repository.line_login_integration'];
            $lineIntegration = $lineIntegrationRepository->findOneBy(['line_user_id' => $lineUserId]);

            $form = $event['form'];

            if (empty($lineIntegration)) {
                $lineIntegration = new LineLoginIntegration();
                $lineIntegration->setLineUserId($lineUserId);
                $customer = $event['Customer'];
                $lineIntegration->setCustomer($customer);
                $this->app['orm.em']->persist($lineIntegration);
                $this->app['orm.em']->flush();
            }

            log_info('LINEユーザーとの関連付け終了');
        } else {
            log_info('LINE未ログインのため関連付け未実施');
        }
    }

    /**
     * twigテンプレートの置換
     * @param type $event
     * @param type $viewName
     * @param type $search
     */
    private function replaceTwig($event, $viewName, $search)
    {
        $snippet = $this->app['twig']->getLoader()->getSource($viewName);
        $replace = $snippet . $search;
        $source = str_replace($search, $replace, $event->getSource());
        $event->setSource($source);
    }

    /**
     * LINE設定が初期化済みかチェックする
     */
    private function isLineSettingCompleted()
    {
        $lineIntegrationSettingRepository = $this->app['eccube.plugin.line_login_integration.repository.line_login_integration_setting'];
        $lineIntegrationSetting = $lineIntegrationSettingRepository->find(LineLoginIntegrationAdminController::LINE_LOGIN_INTEGRATION_SETTING_TABLE_ID);

        if (empty($lineIntegrationSetting->getLineChannelId())) {
            log_error("Line Channel Idが未設定です");
            return false;
        }
        if (empty($lineIntegrationSetting->getLineChannelSecret())) {
            log_error("Line Channel Secretが未設定です");
            return false;
        }

        return true;
    }
}
