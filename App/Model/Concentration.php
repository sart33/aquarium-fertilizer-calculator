<?php


namespace App\Model;


class Concentration
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
        $this->tableName = 'concentration';
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

            'added_con_no3' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$#ui'],
            'added_con_k' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$#ui'],
            'added_po4' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$#ui'],
            'added_fe' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$#ui'],
            'added_con_mg' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$#ui'],
            'added_con_mn' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$#ui'],
            'added_con_cu' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$#ui'],
            'added_con_mo' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$#ui'],
            'added_con_b' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$#ui'],
            'added_con_zn' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$#ui'],
            'added_con_v' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$#ui'],
            'added_con_ni' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$#ui'],
            'added_con_co' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$#ui'],
            'added_con_glutaraldehyde' => [1, 6, '#^[0-9]{1,3}\.*?[0-9]{0,3}$#ui']
        ];
    }
}