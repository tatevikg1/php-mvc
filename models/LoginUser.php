<?php

namespace app\models;

use app\core\Model;
use app\core\DB;
use app\core\Application;
/**
 *
 */
class LoginUser extends Model
{
    public $email;
    public $password;


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
        
        return true;
    }

    public function rules():array
    {
        return [
            'email'     => [self::REQUIRED,  self::EMAIL],
            'password'  => [self::REQUIRED, [self::MIN,   'min' => 8]],
        ];
    }

}
