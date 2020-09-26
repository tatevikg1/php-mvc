<?php

namespace app\models;

use app\core\Model;
use app\core\Application;
use app\core\DB;

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
                VALUES (:firstname, :lastname, :email, :password)";

        $createUser = DB::prepare($statment);
        // bind the values to the statment
        $createUser->bindValue(":firstname", $this->firstname);
        $createUser->bindValue(":lastname",  $this->lastname);
        $createUser->bindValue(":email",     $this->email);
        $createUser->bindValue(":password",  $this->password);

        // executing the statement
        $createUser->execute();

        // // get all users
        // $users = DB::query("SELECT * FROM users;");
        // while ($user = $users->fetch()) {
        //     var_dump($user['firstname']);
        // }

        // // get the newly created user id
        // $user = DB::lastInsertId();
        // var_dump($user);

        return true;
    }

    // this will return array of rules
    public function rules():array
    {
        return[
            'firstname' => [self::REQUIRED, [self::MAX,   'max' => 30]],
            'lastname'  => [self::REQUIRED, [self::MAX,   'max' => 30]],
            'email'     => [self::REQUIRED,  self::EMAIL, [self::UNIQUE, 'table' => 'users']],
            'password'  => [self::REQUIRED, [self::MIN,   'min' => 8]],
            'confirm'   => [self::REQUIRED, [self::MATCH, 'match' => 'password']],
        ];
    }

}
