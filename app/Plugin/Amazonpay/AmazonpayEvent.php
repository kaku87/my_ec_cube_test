<?php

/*
 * This file is part of the Amazonpay
 *
 * Copyright (C) 2019 kaku
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\Amazonpay;

use Eccube\Application;
use Eccube\Event\EventArgs;
use Eccube\Event\TemplateEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class AmazonpayEvent
{

    /** @var  \Eccube\Application $app */
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        //テスト環境
        $this->amazonconfig = array(
        'merchant_id' => 'A37V6UCLTXYT8M',
        'access_key'  => 'AKIAJA4FR3SHANRCSJVQ',
        'secret_key'  => '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',
        'client_id'   => 'amzn1.application-oa2-client.322fd99d151c4e6cbea1889e5d8aef62',
        'region'      => 'jp',
        'currency_code' => 'JPY',
        'sandbox'     => true);
        
    
    }

    public function onCartIndexRender(TemplateEvent $event)
    {
        //AmazonPayお支払い関連ブロックを表示
		$insert = $this->app->renderView('Amazonpay/Resource/template/amazonpaybutton.twig');
		$search = '</form>';
		$replace = $search.$insert;
		$source = str_replace($search, $replace, $event->getSource());
		$event->setSource($source);
		
		
    }

    public function onRouteShoppingRequest(GetResponseEvent $event)
    {
        dump("1111");
        $app = $this->app;
        $request = $this->app['request'];
        $amazonconfig = $this->amazonconfig;
        dump($amazonconfig);
        // Instantiate the client class with the config type
        $amazonclient = new Client($amazonconfig);
         
        // Calling the function getUserInfo with the access token parameter returns object
        $userInfo = $amazonclient->getUserInfo($access_token);
         
        //名前を全角スペースで姓名に変更
        $namestr = explode("　", $userInfo['name']);
        $amazonDMname01 = $namestr[0];
        $amazonDMname02 = $namestr[1];
         
        //顧客情報を設定
        $Customer = new Customer();
        $Customer
        	->setName01($amazonDMname01)
        	->setName02($amazonDMname02)
        	->setEmail($userInfo['email']);
         
        // 非会員用セッションを作成
        $nonMember = array();
        $nonMember['customer'] = $Customer;
        $nonMember['pref'] = '1';
        $app['session']->set($this->sessionKey, $nonMember);
    }
    
    public function onShoppingIndexRender(TemplateEvent $event)
    {
        dump("111");
        $app = $this->app;
        $request = $this->app['request'];
         
        //ソース・ファイルを取得
        $source = $event->getSource();			
         
        //AmazonPayログイン中の処理
        // if(AmazonPayログイン中の場合を判別する条件分){
        $search = '差し替え部分の文字列';
        $replace = '置き換える文字列';
        $source = str_replace($search, $replace, $source);
        $event->setSource($source);		
    }
}
