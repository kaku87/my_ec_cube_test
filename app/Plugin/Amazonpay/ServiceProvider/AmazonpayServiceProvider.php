<?php

/*
 * This file is part of the Amazonpay
 *
 * Copyright (C) 2019 kaku
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\Amazonpay\ServiceProvider;

use Eccube\Common\Constant;
use Plugin\Amazonpay\Form\Type\AmazonpayConfigType;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;

require_once(__DIR__.'/../log.php');

class AmazonpayServiceProvider implements ServiceProviderInterface
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
        $admin->match('/plugin/Amazonpay/config', 'Plugin\Amazonpay\Controller\ConfigController::index')->bind('plugin_Amazonpay_config');

        $app->mount('/'.trim($app['config']['admin_route'], '/').'/', $admin);

        // フロント画面定義
        $front = $app['controllers_factory'];
        // 強制SSL
        if ($app['config']['force_ssl'] == Constant::ENABLED) {
            $front->requireHttps();
        }

        // 独自コントローラ
        $front->match('/plugin/amazonpay/hello', 'Plugin\Amazonpay\Controller\AmazonpayController::index')->bind('plugin_Amazonpay_hello');

        $app->mount('', $front);

        // Form
        $app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {
            $types[] = new AmazonpayConfigType();

            return $types;
        }));

        // Repository

        // Service

        // メッセージ登録
//       $file = __DIR__ . '/../Resource/locale/message.' . $app['locale'] . '.yml';
//       $app['translator']->addResource('yaml', $file, $app['locale']);

        // load config
        // プラグイン独自の定数はconfig.ymlの「const」パラメータに対して定義し、$app['amazonpayconfig']['定数名']で利用可能
//       if (isset($app['config']['Amazonpay']['const'])) {
//           $config = $app['config'];
//           $app['amazonpayconfig'] = $app->share(function () use ($config) {
//               return $config['Amazonpay']['const'];
//           });
//       }

        if (!method_exists('Eccube\Application', 'getInstance')) {
            eccube_log_init($app);
        }

        // ログファイル設定
        $app['monolog.logger.amazonpay'] = $app->share(function ($app) {
            $config = array(
                'name' => 'amazonpay',
                'filename' => 'amazonpay',
                'delimiter' => '_',
                'dateformat' => 'Y-m-d',
                'log_level' => 'INFO',
                'action_level' => 'ERROR',
                'passthru_level' => 'INFO',
                'max_files' => '90',
                'log_dateformat' => 'Y-m-d H:i:s,u',
                'log_format' => '[%datetime%] %channel%.%level_name% [%session_id%] [%uid%] [%user_id%] [%class%:%function%:%line%] - %message% %context% %extra% [%method%, %url%, %ip%, %referrer%, %user_agent%]',
            );
            return $app['eccube.monolog.factory']($config);
        });

    }

    public function boot(BaseApplication $app)
    {
    }

}
