<?php

use yii\db\Migration;

/**
 * Class m171212_164604_user
 */
class m171212_164604_create_user extends Migration {
	/**
	 * @inheritdoc
	 */
	public function safeUp() {
		$this->createTable( '{{%user}}', [
			'id'            => $this->primaryKey(),
			'username'      => $this->string()->notNull()->unique(),
			'password_hash' => $this->string()->notNull(),
			'auth_key' => $this->string()->notNull(),
		] );

	}

	/**
	 * @inheritdoc
	 */
	public function safeDown() {
		$this->dropTable( '{{%user}}' );
	}
}
