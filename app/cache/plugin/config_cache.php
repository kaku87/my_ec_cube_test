<?php return array (
  'Amazonpay' => 
  array (
    'config' => 
    array (
      'name' => 'amazonpay',
      'code' => 'Amazonpay',
      'version' => '0.0.1',
      'event' => 'AmazonpayEvent',
      'service' => 
      array (
        0 => 'AmazonpayServiceProvider',
      ),
    ),
    'event' => 
    array (
      'Cart/index.twig' => 
      array (
        0 => 
        array (
          0 => 'onCartIndexRender',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
  'PluginGenerator' => 
  array (
    'config' => 
    array (
      'name' => 'プラグインジェネレータ',
      'code' => 'PluginGenerator',
      'version' => '1.2.1',
      'service' => 
      array (
        0 => 'PluginGeneratorServiceProvider',
      ),
    ),
    'event' => NULL,
  ),
  'SnsLogin' => 
  array (
    'config' => 
    array (
      'name' => 'SNSログイン',
      'code' => 'SnsLogin',
      'version' => '1.0.0',
      'event' => 'SnsLoginEvent',
      'service' => 
      array (
        0 => 'SnsLoginServiceProvider',
      ),
    ),
    'event' => 
    array (
      'Mypage/login.twig' => 
      array (
        0 => 
        array (
          0 => 'onRenderLineLoginButton',
          1 => 'NORMAL',
        ),
      ),
      'front.mypage.mypage.login.initialize' => 
      array (
        0 => 
        array (
          0 => 'onFrontMypageMypageLoginInitialize',
          1 => 'NORMAL',
        ),
      ),
    ),
  ),
);