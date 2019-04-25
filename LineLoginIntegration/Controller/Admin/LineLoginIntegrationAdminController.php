<?php

namespace Plugin\LineLoginIntegration\Controller\Admin;

use Eccube\Application;
use Symfony\Component\HttpFoundation\Request;
use Plugin\LineLoginIntegration\Entity\LineLoginIntegrationSetting;
use Plugin\LineLoginIntegration\Entity\LineLoginIntegrationHistory;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Eccube\Common\Constant;

class LineLoginIntegrationAdminController
{

    const LINE_LOGIN_INTEGRATION_SETTING_TABLE_ID = 1;

    public function setting(Application $app, Request $request)
    {
        $lineIntegrationSetting = $this->getLineLoginIntegrationSetting();

        $settingForm = $app['form.factory']
                ->createBuilder('line_setting', $lineIntegrationSetting)
                ->getForm();

        return $app->render('LineLoginIntegration/Resource/template/admin/setting.twig', array('settingForm' => $settingForm->createView()));
    }

    public function commit(Application $app, Request $request)
    {
        // POST以外はエラーにする
        if ('POST' !== $request->getMethod()) {
            throw new MethodNotAllowedHttpException();
        }

        $postParameters = $request->request->get('line_setting');

        $lineChannelId = trim($postParameters['line_channel_id']);
        $lineChannelSecret = trim($postParameters['line_channel_secret']);

        $lineIntegrationSetting = $this->getLineLoginIntegrationSetting();
        if (empty($lineIntegrationSetting)) {
            $lineIntegrationSetting = new LineLoginIntegrationSetting();
        }
        $lineIntegrationSetting->setId(self::LINE_LOGIN_INTEGRATION_SETTING_TABLE_ID);
        $lineIntegrationSetting->setLineChannelId($lineChannelId);
        $lineIntegrationSetting->setLineChannelSecret($lineChannelSecret);
        $app['orm.em']->persist($lineIntegrationSetting);
        $app['orm.em']->flush();

        return $app->redirect($app->url('plugin_line_login_setting'));
    }

    /**
     * 設定レコードの取得
     * @return type
     */
    private function getLineLoginIntegrationSetting()
    {
        $app = \Eccube\Application::getInstance();
        $lineIntegrationSettingRepository = $app['eccube.plugin.line_login_integration.repository.line_login_integration_setting'];
        $lineIntegrationSetting = $lineIntegrationSettingRepository->find(self::LINE_LOGIN_INTEGRATION_SETTING_TABLE_ID);
        return $lineIntegrationSetting;
    }
}
