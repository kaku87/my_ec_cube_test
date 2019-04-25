<?php

namespace Plugin\LineLoginIntegration\ServiceProvider;

use Eccube\Common\Constant;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;
use Plugin\LineLoginIntegration\Repository\LineLoginIntegrationRepository;

class LineLoginIntegrationServiceProvider implements ServiceProviderInterface
{

    public function register(BaseApplication $app)
    {
        // リポジトリ
        $app['eccube.plugin.line_login_integration.repository.line_login_integration'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\LineLoginIntegration\Entity\LineLoginIntegration');
        });
        $app['eccube.plugin.line_login_integration.repository.line_login_integration_setting'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\LineLoginIntegration\Entity\LineLoginIntegrationSetting');
        });

        // LINEログイン：ログイン
        $app->match('/plugin/line_login', '\\Plugin\\LineLoginIntegration\\Controller\\LineLoginIntegrationController::login')
                ->bind('plugin_line_login');

        // LINEログイン：ログインコールバック
        $app->match('/plugin/line_login_callback', '\\Plugin\\LineLoginIntegration\\Controller\\LineLoginIntegrationController::loginCallback')
                ->bind('plugin_line_login_callback');

        // 管理画面
        $admin = $app['controllers_factory'];
        // 強制SSL
        if ($app['config']['force_ssl'] == Constant::ENABLED) {
            $admin->requireHttps();
        }

        // LINE連携：設定
        $admin->match('/plugin/line_login_setting', '\\Plugin\\LineLoginIntegration\\Controller\\Admin\\LineLoginIntegrationAdminController::setting')
                ->bind('plugin_line_login_setting');

        // LINE連携：設定：確定
        $admin->match('/plugin/line_login_setting_commit', '\\Plugin\\LineLoginIntegration\\Controller\\Admin\\LineLoginIntegrationAdminController::commit')
                ->bind('plugin_line_login_setting_commit');

        // 型登録
        $app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {
                    $types[] = new \Plugin\LineLoginIntegration\Form\Type\LineLoginSettingType($app); // 設定
                    return $types;
                }));

        $app->mount('/' . trim($app['config']['admin_route'], '/') . '/', $admin);

        // -----------------------------
        // メッセージ登録
        // -----------------------------
        $file = __DIR__ . '/../Resource/locale/message.' . $app['locale'] . '.yml';
        $app['translator']->addResource('yaml', $file, $app['locale']);

        // メニュー登録
        $app['config'] = $app->share($app->extend('config', function ($config) {
                    $addNavi = array(
                        'id' => 'plugin_line_login_integration',
                        'name' => 'LINE管理',
                        'has_child' => true,
                        'icon' => 'cb-comment',
                        'child' => array(
                            array(
                                'id' => 'plugin_line_login_setting',
                                'name' => 'ログイン設定',
                                'url' => 'plugin_line_login_setting',
                            ),
                        ),
                    );

                    $nav = $config['nav'];
                    foreach ($nav as $key => $val) {
                        if ('setting' == $val['id']) {
                            array_splice($nav, $key, 0, array($addNavi));
                            break;
                        }
                    }
                    $config['nav'] = $nav;

                    return $config;
                }));
    }

    public function boot(BaseApplication $app)
    {
        
    }
}
