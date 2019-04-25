<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version201801081318 extends AbstractMigration
{

    public function up(Schema $schema)
    {
        $this->createLineLoginIntegrationTable($schema);
        $this->createLineLoginIntegrationSettingTable($schema);
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('plg_line_login_integration');
        $schema->dropTable('plg_line_login_integration_setting');
    }

    protected function createLineLoginIntegrationTable(Schema $schema)
    {
        $table = $schema->createTable("plg_line_login_integration");

        $table->addColumn('customer_id', 'integer');

        $table->addColumn('line_user_id', 'text', array(
            'notnull' => true
        ));

        $table->setPrimaryKey(array('customer_id'));
    }

    protected function createLineLoginIntegrationSettingTable(Schema $schema)
    {
        $table = $schema->createTable("plg_line_login_integration_setting");

        $table->addColumn('id', 'integer');
        $table->setPrimaryKey(array('id'));

        $table->addColumn('line_channel_id', 'text', array(
            'notnull' => false
        ));
        $table->addColumn('line_channel_secret', 'text', array(
            'notnull' => false
        ));
    }
}
