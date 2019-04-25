<?php

namespace Plugin\LineLoginIntegration;

use Eccube\Plugin\AbstractPluginManager;
use Symfony\Component\Filesystem\Filesystem;

class PluginManager extends AbstractPluginManager
{

    /**
     * @var string コピー元リソースディレクトリ
     */
    private $origin;

    /**
     * @var string コピー先リソースディレクトリ
     */
    private $target;

    public function __construct()
    {
        // コピー元のディレクトリ
        $this->origin = __DIR__ . '/Resource/assets';
        // コピー先のディレクトリ
        $this->target = __DIR__ . '/../../../html/plugin/line_login_integration';
    }

    public function install($config, $app)
    {
        $this->migrationSchema($app, __DIR__ . '/Resource/doctrine/migration', $config['code']);

        $this->copyAssets();
    }

    public function uninstall($config, $app)
    {
        $this->migrationSchema($app, __DIR__ . '/Resource/doctrine/migration', $config['code'], 0);

        $this->removeAssets();
    }

    public function enable($config, $app)
    {
        // $this->install($config, $app);
    }

    public function disable($config, $app)
    {
        // $this->uninstall($config, $app);
    }

    public function update($config, $app)
    {
        $this->migrationSchema($app, __DIR__ . '/Resource/doctrine/migration', $config['code']);
    }

    /**
     * 画像ファイル等をコピー
     */
    private function copyAssets()
    {
        $file = new Filesystem();
        $file->mirror($this->origin, $this->target . '/assets');
    }

    /**
     * コピーした画像ファイルなどを削除
     */
    private function removeAssets()
    {
        $file = new Filesystem();
        $file->remove($this->target);
    }
}
