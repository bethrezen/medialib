<?php

use yii\db\Schema;
use yii\db\Migration;

class m150512_144127_init_pictures extends Migration
{
    public function up()
    {
        $this->createTable(
            '{{%medialib_picture}}',
            [
                'id' => Schema::TYPE_PK,
				'folder' => Schema::TYPE_STRING."(16) NOT NULL",
				'name' => Schema::TYPE_STRING."(32) NOT NULL",
				'filetype' => "enum('jpeg','png','gif') NOT NULL",
				'sizex' => Schema::TYPE_INTEGER." NOT NULL",
				'sizey' => Schema::TYPE_INTEGER." NOT NULL",
				'createtime' => Schema::TYPE_INTEGER." NOT NULL",
				'updatetime' => Schema::TYPE_INTEGER." NOT NULL",
				'comment' => Schema::TYPE_STRING."(250) DEFAULT NULL",
            ]
        );
		$this->createIndex('medialib_picture', '{{%medialib_picture}}', 'folder,name,filetype', true);
    }

    public function down()
    {
		$this->dropTable('{{%medialib_picture}}');

		return true;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
