<?php

namespace app\models;

use app\core\Model;
use app\core\Application;
use app\core\Database;

class User extends Model
{
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $confirm;


    public function register()
    {
        // hash the password before saving
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        // sqlite statement with  parameters
        $statment = "INSERT INTO  users (firstname, lastname, email, password)
                VALUES ('".$this->firstname."',
                        '".$this->lastname."',
                        '".$this->email."',
                        '".$this->password."')";

        // preparing to execute the sqlite statement
        $create = self::prepare($statment);
        // executing the statement
        $create->execute();

        // get all users to check if the user was created
        $users = self::prepare("SELECT * FROM users");
        $users->fetchAll();
        if(count($users) > 0){
            foreach ($users as $user) {
                var_dump('hello');
            }
        }
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

    public static function prepare($sqlStatment)
    {
        return Application::$app->PDO->prepare($sqlStatment);
    }


}
