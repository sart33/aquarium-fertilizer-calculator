<?php


namespace App\Model;


class User
{
    /**
     * @var string
     */
    private string $tableName;


    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->tableName = 'user';
    }


    /**
     * @return string
     */
    public function getTableName() {
        return $this->tableName;
    }

    /**
     * @return array
     */
    public function getValidate()
    {
        return [
            'id' => [1, 6, '##^[0-9]{1,6}$#ui'],
            'login' => [3, 16, '#^[A-Za-zА-Яа-я0-9]{3,16}$#ui'],
            'email' => [6, 66, '#^\b(\w+?\b[\.|-]?\b\w*?\b@\w+?\.\b[a-z]{2,32}\b\.?[a-z]{0,32})$#ui'],
            'password' => [6, 32, '#^[^\s]{6,32}$#ui'],
            'verif-token' => [100, 100, '#^[[:xdigit:]]{100}$#ui'],
            'password-confirm' => [6, 32, '#^[^\s]{6,32}$#ui'],
            'remember' => [1, 1],
            'agree' => [1, 1],

        ];
    }
}