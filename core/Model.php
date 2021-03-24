<?php

declare(strict_types=1);

namespace app\core;

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


    /**
     * loads the $data to model properties
     * @param mixed $data
    */
    public function load($data)
    {
        foreach ($data as $key => $input) {
            // property_exists is a php function that will check the model properties($this)
            // and will return true if there is a match with $key from data
            if (property_exists($this, $key)){
                $this->{$key} = $input;
            }
        }
    }

    // this abstract method is implemented in the model that extends from this Model
    abstract public function rules():array;

    /**
     * Validates loaded data
     * @return bool 
    */
    public function validate(): bool
    {
        foreach ($this->rules() as $attribute => $rules) {
            $loadedInput = $this->{$attribute};

            foreach ($rules as $rule) {
                $ruleName = $rule;

                if (is_array($rule)){
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::REQUIRED && !$loadedInput) {
                    $this->addError($attribute, self::REQUIRED);
                }
                // The filter_var() function filters a variable with the specified filter.
                // (it will return true if the variable is email)
                if ($ruleName === self::EMAIL && !filter_var($loadedInput, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::EMAIL);
                }
                // pass the $rule to take the min value from it, and place it in the error text
                if ($ruleName === self::MIN && strlen($loadedInput) < $rule['min']) {
                    $this->addError($attribute, self::MIN, $rule);
                }
                if ($ruleName === self::MAX && strlen($loadedInput) > $rule['max']) {
                    $this->addError($attribute, self::MAX, $rule);
                }
                // $rule['match'] will give the string "password" and $this->password will give the $password
                if ($ruleName === self::MATCH && $loadedInput !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::MATCH, $rule);
                }
                if ($ruleName === self::UNIQUE) {
                    $tableName = $rule['table'];
                    $statement = Application::$app->PDO->prepare("SELECT * FROM $tableName WHERE $attribute = :$attribute");
                    $statement->bindValue(":$attribute", $loadedInput);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record) {
                        $this->addError($attribute, self::UNIQUE, ['field' => $attribute]);
                    }
                }
            }
        }
        // if the errors is empty the validation is passed(it will return true)
        return empty($this->errors);
    }

    /**
     * Adds errors to model's errors array 
     * @param mixed $attribute
     * @param mixed $ruleName
     * @param mixed $param
     * @return void
    */
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


    /**
     * Contains error messages for validation rules
     * @return string[]
    */
    public function errorMessages(): array
    {
        return [
            self::REQUIRED    => 'This field is required.',
            self::EMAIL       => 'This field must be a valid email address.',
            self::MIN         => 'Minimum length of this field must be {min} characters.',
            self::MAX         => 'Maximum  length of this field must be {max} characters.',
            self::MATCH       => 'This field must be the same as {match}',
            self::UNIQUE      => 'Record with this {field} already exists',
            self::DOESNTEXIST => 'Record does not exist',
            self::PASSWORDVERIFY=> 'Wrong password',
        ];
    }

    /**
     * Checks if there is an error for the given attribute
     * @param string $attribute
     * @return bool
    */
    public function hasError(string $attribute): bool
    {
        return (bool)$this->errors[$attribute];
    }

    /**
     * @param string $attribute
     * @return string|bool
    */
    public function getFirstError(string $attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}
