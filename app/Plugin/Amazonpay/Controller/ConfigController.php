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

class ConfigController
{

    /**
     * Amazonpay用設定画面
     *
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Application $app, Request $request)
    {

        $form = $app['form.factory']->createBuilder('amazonpay_config')->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();

                // add code...
        }

        return $app->render('Amazonpay/Resource/template/admin/config.twig', array(
            'form' => $form->createView(),
        ));
    }

}
