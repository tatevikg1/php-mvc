<?php

namespace app\core;


// Model is abstract to avoid creating an instance of models
// its functions is only for classes that extend from it
abstract class Model
{
    // this array will gather all errors
    public $errors = [];

    public const REQUIRED       = 'required';
    public const EMAIL          = 'email';
    public const MIN            = 'min';
    public const MAX            = 'max';
    public const MATCH          = 'match';
    public const UNIQUE         = 'unique';
    public const DOESNTEXIST    = 'doesntexist';
    public const PASSWORDVERIFY = 'passwordverify';


    public function load($data)
    {
        foreach ($data as $key => $input) {
            // property_exists is a php function that will checks the model proparties($this)
            // and will return true if there is a match with $key from data
            if(property_exists($this, $key)){
                $this->{$key} = $input;
            }
        }

    }

    // this abstract method is implimented in the model that extends from this Model
    abstract public function rules():array;

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $loadedInput = $this->{$attribute};

            foreach ($rules as $rule) {
                $ruleName = $rule;

                if (is_array($rule)){
                    $ruleName = $rule[0];
                }

                if($ruleName === self::REQUIRED && !$loadedInput){
                    $this->addError($attribute, self::REQUIRED);
                }
                // The filter_var() function filters a variable with the specified filter.
                // (it will return true if the variable is email)
                if($ruleName === self::EMAIL && !filter_var($loadedInput, FILTER_VALIDATE_EMAIL)){
                    $this->addError($attribute, self::EMAIL);
                }
                // pass the $rule to take the min value from it, and place it in the error text
                if($ruleName === self::MIN && strlen($loadedInput) < $rule['min']){
                    $this->addError($attribute, self::MIN, $rule);
                }
                if($ruleName === self::MAX && strlen($loadedInput) > $rule['max']){
                    $this->addError($attribute, self::MAX, $rule);
                }
                // $rule['match'] will give the string "password" and $this->password will give the $password
                if($ruleName === self::MATCH && $loadedInput !== $this->{$rule['match']}){
                    $this->addError($attribute, self::MATCH, $rule);
                }
                if($ruleName === self::UNIQUE){
                    $tableName = $rule['table'];
                    $statment = Application::$app->PDO->prepare("SELECT * FROM $tableName WHERE $attribute = :$attribute");
                    $statment->bindValue(":$attribute", $loadedInput);
                    $statment->execute();
                    $record = $statment->fetchObject();
                    if($record){
                        $this->addError($attribute, self::UNIQUE, ['field' => $attribute]);
                    }
                }

            }
        }
        // if the errors is empty the validation is passed(it will return true)
        return empty($this->errors);
    }

    public function addError($attribute, $ruleName, $param = [])
    {
        $message = $this->errorMessages()[$ruleName] ?? '';
        foreach ($param as $key => $value) {
            // for example: $key is 'min', the $value will be '8'(as in rules) , so the string {min}
            // will be replaced with 8(the value from rule)
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }


    public function errorMessages()
    {
        return [
            self::REQUIRED    => 'This field is required.',
            self::EMAIL       => 'This field must be a valid email address.',
            self::MIN         => 'Mininmun length of this field must be {min} characters.',
            self::MAX         => 'Maximum  length of this field must be {max} characters.',
            self::MATCH       => 'This field must be the same as {match}',
            self::UNIQUE      => 'Record with this {field} already existes',
            self::DOESNTEXIST => 'Record does not exist',
            self::PASSWORDVERIFY=> 'Wrong password',
        ];
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ? true :false;
    }

    public function getFirtsError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }


    // public function validate()
    // {
    //     if (empty($_POST["firstname"])) {
    //         $nameErr = "Name is required";
    //     } else {
    //         $firstname = test_input($_POST["firstname"]);
    //     }
    //
    //     if (empty($_POST["email"])) {
    //         $emailErr = "Email is required";
    //     } else {
    //         $email = test_input($_POST["email"]);
    //     }
    //
    // }
    //
    // function test_input($input)
    // {
    //     $input = trim($input);
    //     $input = stripslashes($input);
    //     $input = htmlspecialchars($input);
    //     return $input;
    // }
}
