<?php
 namespace Plugin\AmazonPayments; use Eccube\Plugin\AbstractPluginManager; use Symfony\Component\Filesystem\Filesystem; use Eccube\Common\Constant; use Symfony\Component\Yaml\Yaml; class PluginManager extends AbstractPluginManager { public function __construct() { $this->origin_html = __DIR__ . '/Resource/assets/html'; $this->origin_user_data = __DIR__ . '/Resource/assets/user_data'; if (file_exists(__DIR__.'/../../../index.php')) { $this->target_html = __DIR__ . '/../../..'; } else { $this->target_html = __DIR__ . '/../../../html'; } $this->target_user_data = __DIR__ . '/../../../html/user_data/AmazonPayments'; } public function install($config, $app) { $this->migrationSchema($app, __DIR__ . '/Migration', $config['code']); $this->copyAssets(); $this->sendAutoMail('インストール'); } public function uninstall($config, $app) { $this->migrationSchema($app, __DIR__ . '/Migration', $config['code'], 0); $this->removeAssets(); $this->sendAutoMail('削除'); } public function enable($config, $app) { } public function disable($config, $app) { } public function update($config, $app) { $this->migrationSchema($app, __DIR__ . '/Migration', $config['code']); $this->copyAssets(); $this->sendAutoMail('アップデート'); } private function copyAssets() { $file = new Filesystem(); $file->mirror($this->origin_html, $this->target_html); $file->mkdir($this->target_user_data); $file->mirror($this->origin_user_data, $this->target_user_data); } private function removeAssets() { $file = new Filesystem(); $file->remove($this->target_html . '/amazon_redirect.html'); $file->remove($this->target_user_data); } public function sendAutoMail($process) { $app = new \Eccube\Application(); $app->initialize(); $app->initializePlugin(); $app->boot(); $BaseInfo = $app['eccube.repository.base_info']->get(); $url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI']; $url = substr($url, 0, strrpos($url, 'store') - 1); $url = substr($url, 0, strrpos($url, '/') + 1); $datetime = date('Y-m-d H:i:s'); $eccube_version = Constant::VERSION; $config_file = __DIR__ . '/config.yml'; $config = Yaml::parse(file_get_contents($config_file)); $body = <<<__EOS__
AmazonPay プラグインサポート各位

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
■　プラグイン{$process}のお知らせ　■
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

以下のECサイトでAmazonPay プラグインが{$process}されました。

【店名】{$BaseInfo->getShopName()}
【EC-CUBE】{$eccube_version}
【プラグイン】{$config['version']}
【URL】{$url}
【メールアドレス】{$BaseInfo->getEmail01()}
【処理日時】{$datetime}


※本メールは、配信専用です。
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
AmazonPay　プラグインサポート
URL：https://www.iplogic.co.jp/lp/amazonpayments.html
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
__EOS__;
$message = \Swift_Message::newInstance() ->setSubject('[' . $BaseInfo->getShopName() . '] ' . 'プラグイン' . $process . '処理のお知らせ【AmazonPay】') ->setFrom(array($BaseInfo->getEmail03() => $BaseInfo->getShopName())) ->setTo(array('amazon@iplogic.co.jp' => 'amazon')) ->setBody($body); $app->mail($message); $app['swiftmailer.spooltransport']->getSpool()->flushQueue($app['swiftmailer.transport']); } } 