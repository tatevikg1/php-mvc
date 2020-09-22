<?php

namespace app\models;

use app\core\Model;
use app\core\Application;

class User extends Model
{
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $confirm;

    public function register()
    {
        $sql = "INSERT INTO users (firstname, lastname, email, password)
                VALUES ($this->firstname, $this->lastname, $this->email, $this->password)";

        Application::$app->PDO->query($sql);
        $user = Application::$app->PDO->query("SELECT * FROM users");

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
