<?php


namespace App\Service;


use App\Db\DbConnection;

final class CreateMethods implements Create
{

    /**
     * @var ClassNameToDbTable|object
     */
    private object $classNameToDbTable;

    /**
     * @var Validate|object
     */
    private object $validate;

    /**
     * @var InsertDb|object
     */
    private object $insertDb;

    /**
     * @var Concentration|object
     */
    private object $concentration;

    /**
     * @var User|object
     */
    private object $user;


    /**
     * CreateMethods constructor.
     * @param InsertDb $insertDb
     * @param ClassNameToDbTable $classNameToDbTable
     * @param Validate $validate
     * @param Concentration $concentration
     * @param User $user
     */
    public function __construct(InsertDb $insertDb, ClassNameToDbTable $classNameToDbTable,
                                Validate $validate, Concentration $concentration, User $user)
    {
        $this->classNameToDbTable = $classNameToDbTable;
        $this->concentration = $concentration;
        $this->validate = $validate;
        $this->insertDb = $insertDb;
        $this->user = $user;

    }

    /**
     * @param string $tableName
     * @param $param
     * @param null $img
     * @param null $video
     * @return bool
     */
    public function create(string $tableName, $param, $img = null, $video = null): bool {
//        $className = 'App\\Model\\' . $model;
//        $tableName =  $this->classNameToDbTable->classNameToTableName($className);
        $fromFormValid = $this->validate->validate($tableName, $param, $img, $video);
        if($tableName === 'aquarium') {
            $fromFormValid = $this->concentration->concentration($fromFormValid);
        }
        $fromFormValid['user_id'] = $this->user->getUserId();
        $res = $this->insertDb->insertData($fromFormValid, $tableName);
        if ($res !== null) {
            return true;
        } else {
            throw new \LogicException('Update data into db - Error!');
        }
    }

}