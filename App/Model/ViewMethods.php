<?php


namespace App\Model;


interface ViewMethods
{
    /**
     * @param $tableName
     * @param $id
     * @param string $field
     * @param bool $asc
     * @return mixed
     */
    public function paginate($tableName, $id, $field = 'created_at', $asc = true);
}