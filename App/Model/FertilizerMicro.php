<?php


namespace App\Model;


class FertilizerMicro
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
        $this->tableName = 'fertilizer_micro';
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

//            'daylight_hours' => [1, 5, '#^[0-9]{1,2}\.*?[0-9]{0,2}$#ui'],
//            'brightness' => [4, 6, '#^[0-9]{4,6}$#ui'],
//            'colorful_temperature' => [4, 5, '#^[0-9]{4,5}$#ui'],
        ];
    }
}