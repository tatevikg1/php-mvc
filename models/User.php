<?php

namespace app\models;

use app\core\Model;

class User extends Model
{
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $confirm;

    public function register()
    {

        $user = 'INSERT INTO users ( firstname,   lastname,  email,  password)
                            VALUES($firstname,	$lastname, $email, $password)';

                            var_dump($user);
        return 'user';
    }

    // this will return array
    public function rules():array
    {
        return[
            'firstname' => [self::REQUIRED, [self::MAX,   'max' => 30]],
            'lastname'  => [self::REQUIRED, [self::MAX,   'max' => 30]],
            'email'     => [self::REQUIRED,  self::EMAIL],
            'password'  => [self::REQUIRED, [self::MIN,   'min' => 8]],
            'confirm'   => [self::REQUIRED, [self::MATCH, 'match' => 'password']],
        ];
    }


}
