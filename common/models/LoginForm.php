<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    // public $username;
    public $email;
    public $password;
    public $rememberMe = true;
    public $verifyCode;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            // [
            //     'username', 
            //     'match', 'pattern' => '/^[a-zA-Z0-9]+$/', 
            //     'message' => 'Input invalid. Only alphanumeric characters (a-z, A-Z, 0-9) are allowed.'
            // ],

            ['email', 'trim'],
            ['email', 'email'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],

            // password is validated by validatePassword()
            ['password', 'validatePassword'],

            ['verifyCode', 'captcha', 'captchaAction' => 'site/captcha', 'caseSensitive' => false],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            // $user = $this->getUser();
            $user = $this->getUserByEmail();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            // return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            return Yii::$app->user->login($this->getUserByEmail(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    protected function getUserByEmail()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
