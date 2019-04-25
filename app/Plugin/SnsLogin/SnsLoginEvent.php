<?php

/*
 * This file is part of the SnsLogin
 *
 * Copyright (C) 2018 kaku
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\SnsLogin;

use Eccube\Application;
use Eccube\Event\EventArgs;
use Eccube\Event\TemplateEvent;

class SnsLoginEvent
{

    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function onFrontMypageMypageLoginInitialize(EventArgs $event)
    {
    }
    
    public function onRenderLineLoginButton(TemplateEvent $event)
    {
        $parameters = $event->getParameters();
        $form = $parameters['form'];
        // $parts = '<div class="col-md-10 col-md-offset-1"><a href="' . $this->app->url('plugin_sns_login') . '">facebook login</a></div>' . PHP_EOL;
        $parts = $this->app['twig']->getLoader()->getSource("SnsLogin/Resource/template/snsLogin.twig");
        $search = '<div class="extra-form form-group">';
        $replace = $parts.$search;
        $source = str_replace($search, $replace, $event->getSource());
        $event->setSource($source);
    }

}
