<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirm_password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // ['username', 'trim'],
            // ['username', 'required'],
            // [
            //     'username', 
            //     'match', 'pattern' => '/^[a-zA-Z0-9]+$/', 
            //     'message' => 'Input invalid. Only alphanumeric characters (a-z, A-Z, 0-9) are allowed.'
            // ],
            // ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            // ['username', 'string', 'min' => 5, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email', 
                'unique', 'targetClass' => '\common\models\User', 
                'message' => 'This email address has already been taken.'
            ],

            ['password', 'required'],
            // ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            [
                'password', 
                'match', 'pattern' => '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', 
                'message' => 'Password must contain at least one alphabetical character, one digit, one special character, and be at least 8 characters long.'
            ],

            ['confirm_password', 'required'],
            ['confirm_password', 'string', 'min' => 8],
            [
                'confirm_password',
                'compare', 'compareAttribute' => 'password',
                'message' => 'Passwords do not match.'
            ],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->email; // dumping email
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        // sendEmail commented
        // return $user->save() && $this->sendEmail($user);
        return $user->save();
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmailYii($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

    protected function sendEmail($user)
    {
        $mail = new PHPMailer(true);
        $mail->isSendmail();

        try {
            //Set who the message is to be sent from
            $mail->setFrom('no-reply@pulokmukherjee.com', 'pulokmukherjee.com');
            //Set who the message is to be sent to
            $mail->addAddress($this->email);
            //Set the subject line
            $mail->Subject = 'Account Verification Mail';
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            // $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
            //Replace the plain text body with one created manually
            $mail->isHTML(true);
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

            $mail->send();
            return true;
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            Yii::$app->session->setFlash('error', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
