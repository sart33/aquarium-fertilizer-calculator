<?php


namespace App\Service;


use App\Db\DbConnection;

final class DbTableColumnsKeyMethods implements DbTableColumnsKey
{

    /**
     * @var DbConnection|object
     */
    private object $dbConnection;

    /**
     * DbTableColumnsKeyMethods constructor.
     * @param DbConnection $dbConnection
     */
    public function __construct(DbConnection $dbConnection) {
        $this->dbConnection = $dbConnection;

    }

    /**
     * @param $table
     * @return array|false
     */
    public function showColumnsKey($table)
    {
        $tableColumns = [];
        $table_catalog = DB_NAME;
        $query = "select column_name, ordinal_position, column_default from information_schema.columns 
                where 
                table_catalog = '$table_catalog' and 
                table_schema = 'public' and
                table_name = '$table'";
        if (!empty($this->dbConnection->inquireIntoDb($query))) {
            $res = $this->dbConnection->inquireIntoDb($query);
            foreach ($res as $item) {
                if (preg_match('#^(nextval).+$#u', $item['column_default']) === 1) {
                    $tableColumns[$item['column_name']] = 'PRI';
                } else {
                    $tableColumns[$item['column_name']] = 'field.' . $item['ordinal_position'];
                }
            }
            return $tableColumns;
        } else {
            return false;
        }
    }
}