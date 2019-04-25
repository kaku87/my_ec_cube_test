<?php

/*
 * This file is part of the SnsLogin
 *
 * Copyright (C) 2018 kaku
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\SnsLogin\Controller;

use Eccube\Application;
use Symfony\Component\HttpFoundation\Request;

class SnsLoginController
{

    /**
     * SnsLogin画面
     *
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Application $app, Request $request)
    {

        // add code...
  
                
        return $app->render('SnsLogin/Resource/template/index.twig', array(
            // add parameter...
        ));
    }
    
    public function login(Application $app, Request $request)
    {
        $state = uniqid();
        $session = $request->getSession();
        //$session->set(self::PLUGIN_LINE_LOGIN_INTEGRATION_SSO_STATE, $state);
        // TODO bot_prompt
        // bot_prompt=normal or aggressive
        // https://developers.line.me/ja/docs/line-login/web/link-a-bot/
        // $lineAuthUrl = 'https://access.line.me/oauth2/v2.1/authorize?response_type=code&client_id=' . $this->lineChannelId . '&redirect_uri=' . rawurlencode($app->url('plugin_line_login_callback')) . '&state=' . $state . '&scope=profile&bot_prompt=aggressive';
        return $app->redirect('www.baidu.com');
    }

}
