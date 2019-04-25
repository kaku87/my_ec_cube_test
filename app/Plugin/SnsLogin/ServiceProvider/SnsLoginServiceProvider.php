<?php

/*
 * This file is part of the SnsLogin
 *
 * Copyright (C) 2018 kaku
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\SnsLogin\ServiceProvider;

use Eccube\Common\Constant;
use Plugin\SnsLogin\Form\Type\SnsLoginConfigType;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;

require_once(__DIR__.'/../log.php');

class SnsLoginServiceProvider implements ServiceProviderInterface
{

    public function register(BaseApplication $app)
    {
        // 管理画面定義
        $admin = $app['controllers_factory'];
        // 強制SSL
        if ($app['config']['force_ssl'] == Constant::ENABLED) {
            $admin->requireHttps();
        }

        // プラグイン用設定画面
        $admin->match('/plugin/SnsLogin/config', 'Plugin\SnsLogin\Controller\ConfigController::index')->bind('plugin_SnsLogin_config');

        $app->mount('/'.trim($app['config']['admin_route'], '/').'/', $admin);

        // フロント画面定義
        $front = $app['controllers_factory'];
        // 強制SSL
        if ($app['config']['force_ssl'] == Constant::ENABLED) {
            $front->requireHttps();
        }

        // 独自コントローラ
        $front->match('/plugin/snslogin/hello', 'Plugin\SnsLogin\Controller\SnsLoginController::index')->bind('plugin_SnsLogin_hello');

        // ログイン：ログイン
        $app->match('/plugin/sns_login', '\\Plugin\\SnsLogin\\Controller\\SnsLoginController::login')
                ->bind('plugin_sns_login');

        // ログイン：ログインコールバック
        $app->match('/plugin/sns_login_callback', '\\Plugin\\SnsLogin\\Controller\\SnsLoginController::loginCallback')
                ->bind('plugin_sns_login_callback');
                
        $app->mount('', $front);

        // Form
        $app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {
            $types[] = new SnsLoginConfigType();

            return $types;
        }));

        // Repository

        // Service

        // メッセージ登録
//       $file = __DIR__ . '/../Resource/locale/message.' . $app['locale'] . '.yml';
//       $app['translator']->addResource('yaml', $file, $app['locale']);

        // load config
        // プラグイン独自の定数はconfig.ymlの「const」パラメータに対して定義し、$app['snsloginconfig']['定数名']で利用可能
//       if (isset($app['config']['SnsLogin']['const'])) {
//           $config = $app['config'];
//           $app['snsloginconfig'] = $app->share(function () use ($config) {
//               return $config['SnsLogin']['const'];
//           });
//       }

        if (!method_exists('Eccube\Application', 'getInstance')) {
            eccube_log_init($app);
        }

        // ログファイル設定
        $app['monolog.logger.snslogin'] = $app->share(function ($app) {
            $config = array(
                'name' => 'snslogin',
                'filename' => 'snslogin',
                'delimiter' => '_',
                'dateformat' => 'Y-m-d',
                'log_level' => 'INFO',
                'action_level' => 'ERROR',
                'passthru_level' => 'INFO',
                'max_files' => '90',
                'log_dateformat' => 'Y-m-d H:i:s,u',
                'log_format' => '[%datetime%] %channel%.%level_name% [%session_id%] [%uid%] [%user_id%] [%class%:%function%:%sns%] - %message% %context% %extra% [%method%, %url%, %ip%, %referrer%, %user_agent%]',
            );
            return $app['eccube.monolog.factory']($config);
        });

    }

    public function boot(BaseApplication $app)
    {
    }

}
