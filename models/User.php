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
                VALUES ('".$this->firstname."',
                        '".$this->lastname."',
                        '".$this->email."',
                        '".$this->password."')";

        // preparing to execute the sqlite statement
        $create = DB::prepare($statment);
        // executing the statement
        $create->execute();

        // get all users
        // $users = DB::query("SELECT * FROM users;");
        // while ($user = $users->fetch()) {
        //     var_dump($user['firstname']);
        // }

        // get the newly created user id
        $user = DB::lastInsertId();

        return $user;
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
