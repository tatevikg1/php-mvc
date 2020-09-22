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
        $statment = "INSERT INTO users (firstname, lastname, email, password)
                VALUES (:firstname, :lastname, :email, :password)";

        $create = self::prepare($statment);
        $create->execute(array(
            ':firsnam'  => $this->firstname,
            ':lastname' => $this->lastname,
            ':email'    => $this->email,
            ':password' => $this->password
        ));



        // $statment = "INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
        //
        // $create = self::prepare($statment)->execute([
        //     $this->firstname,
        //     $this->lastname,
        //     $this->email,
        //     $this->password
        // ]);

        if($create === false){
            $msg = 'Error creating the user.';
        }else{
            $msg = "The new user is created";
        }

        $getUsers = Application::$app->PDO->query("SELECT * FROM users")->fetchAll();

        var_dump($create);
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
