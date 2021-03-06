<?php

/*
 * This file is part of the [code]
 *
 * Copyright (C) [year] [author]
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\[code]\ServiceProvider;

use Eccube\Common\Constant;
use Plugin\[code]\Form\Type\[code]ConfigType;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;

class [code]ServiceProvider implements ServiceProviderInterface
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
        $admin->match('/plugin/[code]/config', 'Plugin\[code]\Controller\ConfigController::index')->bind('plugin_[code]_config');

        $app->mount('/'.trim($app['config']['admin_route'], '/').'/', $admin);

        // フロント画面定義
        $front = $app['controllers_factory'];
        // 強制SSL
        if ($app['config']['force_ssl'] == Constant::ENABLED) {
            $front->requireHttps();
        }

        // 独自コントローラ
        $front->match('/plugin/[lower_code]/hello', 'Plugin\[code]\Controller\[code]Controller::index')->bind('plugin_[code]_hello');

        $app->mount('', $front);

        // Form
        $app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {
            $types[] = new [code]ConfigType();

            return $types;
        }));

        // Repository

        // Service

        // メッセージ登録
//       $file = __DIR__ . '/../Resource/locale/message.' . $app['locale'] . '.yml';
//       $app['translator']->addResource('yaml', $file, $app['locale']);

        // load config
        // プラグイン独自の定数はconfig.ymlの「const」パラメータに対して定義し、$app['[lower_code]config']['定数名']で利用可能
//       if (isset($app['config']['[code]']['const'])) {
//           $config = $app['config'];
//           $app['[lower_code]config'] = $app->share(function () use ($config) {
//               return $config['[code]']['const'];
//           });
//       }

    }

    public function boot(BaseApplication $app)
    {
    }

}
