<?php


namespace App\Test;


use App\Service\ClassNameToDbTableMethods;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\matches;

class ClassNameToDbTableMethodsTest extends TestCase
{
    private $classNameToTable;

    protected function setUp(): void
    {
        $this->classNameToTable = new ClassNameToDbTableMethods();
    }

    protected function tearDown(): void
    {
        $this->classNameToTable = NULL;
    }

    public function getValidClassNameToTableName(): array {
        return [
            ['App\Model\Aquarium'],
            ['App\Model\User'],
            ['App\Model\UserFromRussia'],
            ['App\Model\UserFromRussia'],
            ['App\Model\MyVeryVeryVeryBigTankBigBig'],

        ];
    }

    /**
     * @test
     * @dataProvider getValidClassNameToTableName
     */

    public function detect_an_valid_classNameToTableName_method($className)
    {
        $result = $this->classNameToTable->classNameToTablename($className);
        $this->assertRegExp('/^[a-z]{1,16}[_]{0,1}[a-z]{0,16}[_]{0,1}[a-z]{0,16}[_]{0,1}[a-z]{0,16}[_]{0,1}[a-z]{0,16}[_]{0,1}[a-z]{0,16}[_]{0,1}[a-z]{0,16}[_]{0,1}[a-z]{0,16}[_]{0,1}$/', $result);
    }


    public function getInvalidClassNameToTableName(): array {
        return [
            ['App\Model\aquarium'],
            ['App\Model\aquariuM'],
            ['App\Model\aQuarium'],
            ['App\Model\uSER'],
            ['App\Model\USER'],
            ['App\Model\USERFromRussia'],
            ['App\Model\UserFromRussiA'],
            ['App\Model\MyVeryVeryVeryBigTankBigBiG'],
            ['App\Model\\']

        ];
    }

    /**
     * @test
     * @dataProvider getInvalidClassNameToTableName
     */

    public function detect_an_invalid_classNameToTableName_method($className)
    {
        $this->expectException(\OutOfRangeException::class);
        $this->classNameToTable->classNameToTablename($className);
    }



    public function getEmptyClassNameToTableName(): array {
        return [
            [''],

        ];
    }

    /**
     * @test
     * @dataProvider getEmptyClassNameToTableName
     */

    public function detect_an_empty_classNameToTableName_method($className)
    {
        $this->expectException(\LogicException::class);
        $this->classNameToTable->classNameToTablename($className);
    }

}