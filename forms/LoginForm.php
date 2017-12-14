<?php

namespace app\forms;

use app\models\UserIdentity;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property UserIdentity|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{

    public $username;
    public $password;
    public $rememberMe = true;
    public $content;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'content'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            ['content', 'string'],
        ];
    }

}
