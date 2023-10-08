<?php

namespace App\Models;

use Tatevik\Framework\DB;
use Tatevik\Framework\Model;
use Tatevik\Framework\Session;

/**
 * @var string $email
 * @var string $password
*/
class LoginUser extends Model
{
    public $email;
    public $password ;

    /**
     * Check user data against db records, if the user is found sets session data for the user
     * @return bool
    */
    public function authenticate(): bool
    {
        // get the user with that email address
        $statement = DB::prepare("SELECT * FROM users WHERE email=:email ");
        $statement->bindValue(":email", $this->email);
        $statement->execute();
        $user = $statement->fetchObject();

        if (!$user) {
            $this->addError('email', self::DOESNTEXIST, ['field' => 'email']);
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
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
