<?php

/*
 * This file is part of the Amazonpay
 *
 * Copyright (C) 2019 kaku
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\Amazonpay\Controller;

use Eccube\Application;
use Symfony\Component\HttpFoundation\Request;

class AmazonpayController
{

    /**
     * Amazonpay画面
     *
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Application $app, Request $request)
    {

        // add code...

        return $app->render('Amazonpay/Resource/template/index.twig', array(
            // add parameter...
        ));
    }

}
