<?php
namespace App\Test;

use App\Service\ClassNameToDbTable;
use App\Service\Concentration;
use App\Service\CreateMethods;
use App\Service\InsertDb;
use App\Service\User;
use App\Service\Validate;

class CreateMethodsTest extends \PHPUnit\Framework\TestCase
{

    private $createMethods;

//    protected function setUp(): void
//    {
//        $this->createMethods = new CreateMethods($stubFive, $stub,);
//    }

    protected function tearDown(): void
    {
        $this->createMethods = NULL;
    }

    public function getValidCreateMethods()
    {


        return [[
            'App\Model\Aquarium', [
            'token' => 'd9336b536d2144785417cde5bd63ec50321e25edfa7e560bd94eb6a8cb47dbeb',
            'AquariumDailyForm' =>
                [
                    'description' => '88888888888888888',
                    'temperature' => '27.0',
                    'daylight_hours' => '8.20',
                    'feed' => 'Тетра Дискус',
                    'feed_quantity' => '1500',
                    'added_micro' => '6',
                    'added_fe' => '6',
                    'added_no3' => '5',
                    'added_po4' => '2',
                    'added_k' => '0',
                    'added_co2' => '20',
                    'water_change' => '0',
                    'added_cidex' => 'null',
                    'test_no3' => 'null',
                    'test_po4' => 'null',
                    'test_ph' => 'null',
                    'test_kh' => 'null',
                    'test_gh' => 'null',
                    'test_k' => 'null',
                ],
        ], [
                'name' =>
                    [
                        0 => '222.jpg',
                        1 => 'hh.jpg',
                    ],
                'type' =>
                    [
                        0 => 'image/jpeg',
                        1 => 'image/jpeg',
                    ],
                'tmp_name' =>
                    [
                        0 => '/tmp/phpbzVbsf',
                        1 => '/tmp/phpTbbPPt',
                    ],
                'error' =>
                    [
                        0 => 0,
                        1 => 0,
                    ],
                'size' =>
                    [
                        0 => 32806,
                        1 => 34843,
                    ],
            ], null]];
    }

    /**
     * @test
     * @dataProvider getValidCreateMethods
     */


    public function detect_an_valid_create_method($model, $param, $img = null, $video = null) {
        $stub = $this->createMock(ClassNameToDbTable::class);
        $stub->method('classNameToTableName')->willReturn('aquarium');
        $stubTwo = $this->createMock(Validate::class);
        $stubTwo->method('validate')->willReturn([
            'description' => '88888888888888888',
            'temperature' => '27.0',
            'daylight_hours' => '8.20',
            'feed' => 'Тетра Дискус',
            'feed_quantity' => '1500',
            'added_micro' => '6',
            'added_fe' => '6',
            'added_no3' => '5',
            'added_po4' => '2',
            'added_k' => '0',
            'added_co2' => '20',
            'water_change' => '0',
            'added_cidex' => 'null',
            'test_no3' => 'null',
            'test_po4' => 'null',
            'test_ph' => 'null',
            'test_kh' => 'null',
            'test_gh' => 'null',
            'test_k' => 'null',
        ]);
        $stubThree = $this->createMock(Concentration::class);
        $stubThree->method('concentration')->willReturn([ 'description' => '88888888888888888',
            'temperature' => '27.0',
            'daylight_hours' => '8.20',
            'feed' => 'Тетра Дискус',
            'feed_quantity' => '1500',
            'added_micro' => '6',
            'added_fe' => '6',
            'added_no3' => '5',
            'added_po4' => '2',
            'added_k' => '0',
            'added_co2' => '20',
            'water_change' => '0',
            'added_cidex' => 'null',
            'test_no3' => 'null',
            'test_po4' => 'null',
            'test_ph' => 'null',
            'test_kh' => 'null',
            'test_gh' => 'null',
            'test_k' => 'null',
            'img_one' => 'a5f090671498b2dfd9dda03efa83e31d.jpg',
            'img_two' => '860d3d004f8698fddea9b77d1f56fe70.jpg',
            'added_con_no3' => 3.8461538461538463,
            'added_con_po4' => 0.7692307692307693,
            'added_con_k' => 2.7424317617866008,
            'added_con_fe' => 0.1776923076923077,
            'added_con_mg' => 0.04015384615384615,
            'added_con_mn' => 0.01615384615384615,
            'added_con_cu' => 0.0022153846153846156,
            'added_con_mo' => 0.0016153846153846155,
            'added_con_b' => 0.0016153846153846155,
            'added_con_zn' => 0.0007384615384615385,
            'added_con_glutaraldehyde' => 0]);

        $stubFour = $this->createMock(User::class);
        $stubFour->method('getUserId')->willReturn([ 'description' => '88888888888888888',
            'temperature' => '27.0',
            'daylight_hours' => '8.20',
            'feed' => 'Тетра Дискус',
            'feed_quantity' => '1500',
            'added_micro' => '6',
            'added_fe' => '6',
            'added_no3' => '5',
            'added_po4' => '2',
            'added_k' => '0',
            'added_co2' => '20',
            'water_change' => '0',
            'added_cidex' => 'null',
            'test_no3' => 'null',
            'test_po4' => 'null',
            'test_ph' => 'null',
            'test_kh' => 'null',
            'test_gh' => 'null',
            'test_k' => 'null',
            'img_one' => 'a5f090671498b2dfd9dda03efa83e31d.jpg',
            'img_two' => '860d3d004f8698fddea9b77d1f56fe70.jpg',
            'added_con_no3' => 3.8461538461538463,
            'added_con_po4' => 0.7692307692307693,
            'added_con_k' => 2.7424317617866008,
            'added_con_fe' => 0.1776923076923077,
            'added_con_mg' => 0.04015384615384615,
            'added_con_mn' => 0.01615384615384615,
            'added_con_cu' => 0.0022153846153846156,
            'added_con_mo' => 0.0016153846153846155,
            'added_con_b' => 0.0016153846153846155,
            'added_con_zn' => 0.0007384615384615385,
            'added_con_glutaraldehyde' => 0,
            'user_id' => 1]);
        $stubFive = $this->createMock(InsertDb::class);
        $stubFive->method('insertData')->willReturn([0 => []]);

        $createMethodsObj = new CreateMethods($stubFive, $stub, $stubTwo, $stubThree, $stubFour);
        $result = $createMethodsObj->create($model, $param, $img, $video);
        $this->assertTrue($result);



    }
}