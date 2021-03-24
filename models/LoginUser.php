<?php

namespace app\models;

use app\core\Model;
use app\core\DB;
use app\core\Session;

/**
 * @var string $email
 * @var string $password
 * @method bool authenticate()
 * @method array rules()
*/
class LoginUser extends Model
{
    public $email;
    public $password ;

    /**
     * Chack user data against db records, if the user is found sets session data for the user
     * @return bool
    */
    public function authenticate()
    {
        // get the user with that email address
        $statment = DB::prepare("SELECT * FROM users WHERE email=:email ");
        $statment->bindValue(":email", $this->email);
        $statment->execute();
        $user = $statment->fetchObject();

        if(!$user){
            $this->addError('email', self::DOESNTEXIST, ['field' => 'email']);
            return false;
        }
        if(!password_verify($this->password, $user->password)){
            $this->addError('password', self::PASSWORDVERIFY, ['field' => 'password']);
            return false;
        }

        Session::set('user', $user);

        return true;
    }

    /**
     * Validation rules for login user
    */
    public function rules():array
    {
        return [
            'email'     => [self::REQUIRED,  self::EMAIL],
            'password'  => [self::REQUIRED, [self::MIN,   'min' => 8]],
        ];
    }

}
