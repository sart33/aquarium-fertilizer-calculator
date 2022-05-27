<?php


namespace App\Model;


class Test
{
    /**
     * @var string
     */
    private string $tableName;


    /**
     * Concentration constructor.
     */
    public function __construct()
    {
        $this->tableName = 'test';
    }

    /**
     * @return string
     */
    public function getTableName() {
        return $this->tableName;
    }

    /**
     * @return array[]
     */
    public function getValidate()
    {
        return [

            'test_no3' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$|^null$#ui'],
            'test_po4' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$|^null$#ui'],
            'test_ph' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$|^null$#ui'],
            'test_kh' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$|^null$#ui'],
            'test_gh' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$|^null$#ui'],
            'test_k' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$|^null$#ui'],
            'test_co2' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$#ui'],
            'temperature' => [1, 4, '#^[0-9]{1,2}\.*?[0-9]{0,1}$|^null$#ui'],
        ];
    }
}