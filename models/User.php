<?php

namespace app\models;

use app\core\Model;
use app\core\DB;

/**
 * @var string $firstname
 * @var string $lastname
 * @var string $email
 * @var string $password
 * @var string $confirm
 * @method bool register()
 * @method array rules()
*/
class User extends Model
{
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $confirm;

    /**
     * Creates a DB record with the loaded data
     * @return bool
    */
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

        return true;
    }

    /**
     * This will return array of rules for User model
     * @return array
    */ 
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
