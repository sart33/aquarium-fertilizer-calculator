<?php

namespace App\Model;

use App\Db\DbConnection;

class Ads
{
    /**
     * @var string
     */
    private string $tableName;


    /**
     * Ads constructor.
     */
    public function __construct() {
        $this->tableName = 'ads';
    }

    /**
     * @return string
     */
    public function getTableName() {
        return $this->tableName;
    }

    /**
     * @return \int[][]
     */
    public function getValidate() {
        return [
            'title' => [3, 200],
            'body' => [5, 1000],
            'price' => [1, 8],
            'img' => [1, 3]
            ];
    }

    /**
     * @param $properties
     */
    public function getAdsList($properties)
    {

    }

}