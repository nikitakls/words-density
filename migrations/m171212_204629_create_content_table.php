<?php

use yii\db\Migration;

/**
 * Handles the creation of table `content`.
 */
class m171212_204629_create_content_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%content}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'content' => $this->text(),
        ]);

        $this->createIndex('{{%idx-content-user_id}}', '{{%content}}', 'user_id');
        $this->addForeignKey('{{%fk-content-user_id}}', '{{%content}}', 'user_id', '{{%user}}', 'id', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%content}}');
    }
}
