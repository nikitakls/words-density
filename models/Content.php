<?php

namespace app\models;

/**
 * This is the model class for table "content".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $content
 *
 * @property User $user
 */
class Content extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'content';
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'      => 'ID',
			'user_id' => 'User ID',
			'content' => 'Content',
		];
	}

	public static function create( $content, $userID ) {
		$model          = new static();
		$model->content = $content;
		$model->user_id = $userID;

		return $model;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser() {
		return $this->hasOne( User::className(), [ 'id' => 'user_id' ] );
	}
}
