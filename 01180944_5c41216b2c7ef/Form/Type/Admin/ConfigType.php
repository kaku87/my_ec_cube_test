<?php
 namespace Plugin\AmazonPayments\Form\Type\Admin; use Symfony\Component\Form\AbstractType; use Symfony\Component\Form\FormBuilderInterface; use Symfony\Component\Validator\Constraints as Assert; class ConfigType extends AbstractType { private $app; private $settingData; public function __construct(\Eccube\Application $app, $settingData = array()) { $this->app = $app; $this->settingData = $settingData; } public function buildForm(FormBuilderInterface $builder, array $options) { if (!isset($this->settingData['amazon_account_mode'])) { $this->settingData['amazon_account_mode'] = 0; } if (!isset($this->settingData['prod_mode'])) { $this->settingData['prod_mode'] = 0; } if (!isset($this->settingData['seller_id'])) { $this->settingData['seller_id'] = null; } if (!isset($this->settingData['mws_access_key_id'])) { $this->settingData['mws_access_key_id'] = null; } if (!isset($this->settingData['mws_secret_access_key'])) { $this->settingData['mws_secret_access_key'] = null; } if (!isset($this->settingData['client_id'])) { $this->settingData['client_id'] = null; } if (!isset($this->settingData['sale'])) { $this->settingData['sale'] = 1; } if (!isset($this->settingData['auto_login'])) { $this->settingData['auto_login'] = 1; } if (!isset($this->settingData['login_required'])) { $this->settingData['login_required'] = 0; } if (!isset($this->settingData['order_revise'])) { $this->settingData['order_revise'] = 1; } if (!isset($this->settingData['mail_text'])) { $this->settingData['mail_text'] = null; } if (!isset($this->settingData['button_select'])) { $this->settingData['button_select'] = array('cart'); } if (!isset($this->settingData['cart_button_color'])) { $this->settingData['cart_button_color'] = 'Gold'; } if (!isset($this->settingData['cart_button_size'])) { $this->settingData['cart_button_size'] = 'large'; } if (!isset($this->settingData['cart_button_place'])) { $this->settingData['cart_button_place'] = 'auto'; } if (!isset($this->settingData['products_button_color'])) { $this->settingData['products_button_color'] = 'Gold'; } if (!isset($this->settingData['products_button_size'])) { $this->settingData['products_button_size'] = 'large'; } if (!isset($this->settingData['products_button_place'])) { $this->settingData['products_button_place'] = 'auto'; } if (!isset($this->settingData['deliv_widget_height'])) { $this->settingData['deliv_widget_height'] = 260; } if (!isset($this->settingData['deliv_widget_width'])) { $this->settingData['deliv_widget_width'] = 340; } if (!isset($this->settingData['payment_widget_height'])) { $this->settingData['payment_widget_height'] = 260; } if (!isset($this->settingData['payment_widget_width'])) { $this->settingData['payment_widget_width'] = 340; } $builder ->add('amazon_account_mode', 'choice', array( 'label' => 'アカウント切り替え', 'choices' => array( 0 => 'アイピーロジック発行テストアカウント', 1 => '自社契約アカウント', ), 'data' => $this->settingData['amazon_account_mode'], 'multiple' => false, 'expanded' => true, )) ->add('prod_mode', 'choice', array( 'label' => '環境切り替え', 'choices' => array( 0 => 'テスト環境', 1 => '本番環境', ), 'data' => $this->settingData['prod_mode'], 'multiple' => false, 'expanded' => true, )) ->add('seller_id', 'text', array( 'label' => '出品者ID', 'required' => false, 'attr' => array( 'class' => 'lockon_card_row', ), 'constraints' => array( new Assert\Length(array('max' => $this->app['config']['stext_len'])), ), 'data' => $this->settingData['seller_id'], )) ->add('mws_access_key_id', 'text', array( 'label' => 'アクセスキー', 'required' => false, 'attr' => array( 'class' => 'lockon_card_row', ), 'constraints' => array( new Assert\Length(array('max' => $this->app['config']['stext_len'])), ), 'data' => $this->settingData['mws_access_key_id'], )) ->add('mws_secret_access_key', 'text', array( 'label' => 'シークレットアクセスキー', 'required' => false, 'attr' => array( 'class' => 'lockon_card_row', ), 'constraints' => array( new Assert\Length(array('max' => $this->app['config']['smtext_len'])), ), 'data' => $this->settingData['mws_secret_access_key'], )) ->add('client_id', 'text', array( 'label' => 'クライアントID', 'required' => false, 'attr' => array( 'class' => 'lockon_card_row', ), 'constraints' => array( new Assert\Length(array('max' => $this->app['config']['smtext_len'])), ), 'data' => $this->settingData['client_id'], )) ->add('test_client_id', 'text', array( 'label' => 'テスト用クライアントID', 'required' => false, 'attr' => array( 'class' => 'lockon_card_row', ), 'constraints' => array( new Assert\Length(array('max' => $this->app['config']['smtext_len'])), ), 'data' => $this->settingData['test_client_id'], )) ->add('prod_key', 'text', array( 'label' => '本番環境切り替えキー', 'required' => false, 'attr' => array( 'class' => 'lockon_card_row', ), 'constraints' => array( new Assert\Length(array('max' => $this->app['config']['smtext_len'])), ), 'data' => $this->settingData['prod_key'], )) ->add('sale', 'choice', array( 'label' => '仮売上 or 売上', 'choices' => array( 1 => '仮売上', 2 => '売上', ), 'constraints' => array( new Assert\NotBlank(array('message' => '※ 仮売上 or 売上が選択されていません。')), ), 'data' => $this->settingData['sale'], 'multiple' => false, 'expanded' => true, )) ->add('auto_login', 'choice', array( 'label' => 'EC自動ログイン', 'choices' => array( 1 => 'オン', 0 => 'オフ', ), 'constraints' => array( new Assert\NotBlank(array('message' => '※ EC自動ログインが選択されていません。')), ), 'data' => $this->settingData['auto_login'], 'multiple' => false, 'expanded' => true, )) ->add('login_required', 'choice', array( 'label' => 'ログイン・会員登録必須', 'choices' => array( 1 => 'オン', 0 => 'オフ', ), 'constraints' => array( new Assert\NotBlank(array('message' => '※ ログイン・会員登録必須が選択されていません。')), ), 'data' => $this->settingData['login_required'], 'multiple' => false, 'expanded' => true, )) ->add('order_revise', 'choice', array( 'label' => '受注補正機能', 'choices' => array( 1 => 'オン', 0 => 'オフ', ), 'constraints' => array( new Assert\NotBlank(array('message' => '※ 受注補正機能が選択されていません。')), ), 'data' => $this->settingData['order_revise'], 'multiple' => false, 'expanded' => true, )) ->add('mail_text', 'textarea', array( 'label' => '受注完了メール特記事項', 'required' => false, 'attr' => array( 'class' => 'lockon_card_row', ), 'constraints' => array( new Assert\Length(array('max' => 2000)), ), 'data' => $this->settingData['mail_text'], )) ->add('button_select', 'choice', array( 'label' => 'Amazonログインボタン選択', 'choices' => array( 'cart' => 'カート画面', 'products_detail' => '商品詳細画面', ), 'data' => $this->settingData['button_select'], 'multiple' => true, 'expanded' => true, )) ->add('cart_button_color', 'choice', array( 'label' => 'Amazonログインボタンカラー(カート)', 'choices' => array( 'Gold' => 'ゴールド', 'DarkGray' => 'ダークグレー', 'LightGray' => 'ライトグレー', ), 'constraints' => array( new Assert\NotBlank(array('message' => '※ Amazonログインボタンカラー(カート)が選択されていません。')), ), 'data' => $this->settingData['cart_button_color'], 'multiple' => false, 'expanded' => true, )) ->add('cart_button_size', 'choice', array( 'label' => 'Amazonログインボタンサイズ(カート)', 'choices' => array( 'small' => '小', 'medium' => '中', 'large' => '大', 'x-large' => '特大', ), 'constraints' => array( new Assert\NotBlank(array('message' => '※ Amazonログインボタンサイズ(カート)が選択されていません。')), ), 'data' => $this->settingData['cart_button_size'], 'multiple' => false, 'expanded' => true, )) ->add('cart_button_place', 'choice', array( 'label' => 'Amazonログインボタン配置(カート)', 'choices' => array( 'auto' => '自動', 'manual' => '手動', ), 'constraints' => array( new Assert\NotBlank(array('message' => '※ Amazonログインボタン配置(カート)が選択されていません。')), ), 'data' => $this->settingData['cart_button_place'], 'multiple' => false, 'expanded' => true, )) ->add('products_button_color', 'choice', array( 'label' => 'Amazonログインボタンカラー(商品詳細)', 'choices' => array( 'Gold' => 'ゴールド', 'DarkGray' => 'ダークグレー', 'LightGray' => 'ライトグレー', ), 'constraints' => array( new Assert\NotBlank(array('message' => '※ Amazonログインボタンカラー(商品詳細)が選択されていません。')), ), 'data' => $this->settingData['products_button_color'], 'multiple' => false, 'expanded' => true, )) ->add('products_button_size', 'choice', array( 'label' => 'Amazonログインボタンサイズ(商品詳細)', 'choices' => array( 'small' => '小', 'medium' => '中', 'large' => '大', 'x-large' => '特大', ), 'constraints' => array( new Assert\NotBlank(array('message' => '※ Amazonログインボタンサイズ(商品詳細)が選択されていません。')), ), 'data' => $this->settingData['products_button_size'], 'multiple' => false, 'expanded' => true, )) ->add('products_button_place', 'choice', array( 'label' => 'Amazonログインボタン配置(商品詳細)', 'choices' => array( 'auto' => '自動', 'manual' => '手動', ), 'constraints' => array( new Assert\NotBlank(array('message' => '※ Amazonログインボタン配置(商品詳細)が選択されていません。')), ), 'data' => $this->settingData['products_button_place'], 'multiple' => false, 'expanded' => true, )) ->add('deliv_widget_height', 'text', array( 'label' => 'お届け先ウィジェットサイズ(縦)', 'required' => false, 'attr' => array( 'class' => 'lockon_card_row', ), 'constraints' => array( new Assert\NotBlank(array('message' => '※ お届け先ウィジェットサイズ(縦)が入力されていません。')), new Assert\GreaterThanOrEqual(array('value' => 228)), new Assert\LessThanOrEqual(array('value' => 400)), ), 'data' => $this->settingData['deliv_widget_height'], )) ->add('deliv_widget_width', 'text', array( 'label' => 'お届け先ウィジェットサイズ(横)', 'required' => false, 'attr' => array( 'class' => 'lockon_card_row', ), 'constraints' => array( new Assert\NotBlank(array('message' => '※ 届け先ウィジェットサイズ(横)が入力されていません。')), new Assert\GreaterThanOrEqual(array('value' => 300)), new Assert\LessThanOrEqual(array('value' => 600)), ), 'data' => $this->settingData['deliv_widget_width'], )) ->add('payment_widget_height', 'text', array( 'label' => 'お支払い方法ウィジェットサイズ(縦)', 'required' => false, 'attr' => array( 'class' => 'lockon_card_row', ), 'constraints' => array( new Assert\NotBlank(array('message' => '※ お支払い方法ウィジェットサイズ(縦)が入力されていません。')), new Assert\GreaterThanOrEqual(array('value' => 228)), new Assert\LessThanOrEqual(array('value' => 400)), ), 'data' => $this->settingData['payment_widget_height'], )) ->add('payment_widget_width', 'text', array( 'label' => 'お支払い方法ウィジェットサイズ(横)', 'required' => false, 'attr' => array( 'class' => 'lockon_card_row', ), 'constraints' => array( new Assert\NotBlank(array('message' => '※ お支払い方法ウィジェットサイズ(横)が入力されていません。')), new Assert\GreaterThanOrEqual(array('value' => 300)), new Assert\LessThanOrEqual(array('value' => 600)), ), 'data' => $this->settingData['payment_widget_width'], )) ->addEventSubscriber(new \Eccube\Event\FormEventSubscriber()); } public function getName() { return 'config'; } } 