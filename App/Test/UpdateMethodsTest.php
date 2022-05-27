<?php
namespace App\Test;

use App\Service\UpdateDb;
use App\Service\UpdateDbMethods;
use App\Service\UpdateMethods;
use PHPUnit\Framework\TestCase;
use App\Service\ClassNameToDbTableMethods;
use App\Service\ClassNameToDbTable;
use App\Service\Concentration;
use App\Service\InsertDb;
use App\Service\User;
use App\Service\Validate;
class UpdateMethodsTest extends TestCase
{
    private $updateMethods;

//    protected function setUp(): void
//    {
//        $this->createMethods = new CreateMethods($stubFive, $stub,);
//    }

    protected function tearDown(): void
    {
        $this->updateMethods = NULL;
    }

    public function getValidUpdateMethods()
    {
        return [[
            'App\Model\Aquarium', [
                'token' => 'd9336b536d2144785417cde5bd63ec50321e25edfa7e560bd94eb6a8cb47dbeb',
                'AquariumDailyForm' =>
                    [
                        'id' => '100',
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
     * @dataProvider getValidUpdateMethods
     */



    public function detect_an_valid_update_methods($model, $param, $img = null, $video = null) {
        $stub = $this->createMock(ClassNameToDbTable::class);
        $stub->method('classNameToTableName')->willReturn('aquarium');
        $stubTwo = $this->createMock(Validate::class);
        $stubTwo->method('validate')->willReturn([
                'id' => '63',
                'description' => 'Ночью промыл аквариумный фильтр. Количество грязи в нем было непредставимое, рыже-коричневое все. Хоть запаха не было)). Вечером сегодня глянул на аквариум - вода стала намного чище. Рыб Тетра Дискусом кормили - очень умеренно. На переднем стекле две полосы зарастания ксенококусом, - вероятно туда попало либо микро, либо железо. Так же переднее стекло покрыто пушком вроде эдогониума, что наряду с маленькими (карликовыми) листьями на старых растениях и активным отмиранием старых - сигналит о недостатке азота, или фосфора. Поэтому на ночь налил немного и того и другого. Наблюдать за рыбами не было сегодня возможности, но новых проблем вроде нет. СО2 идет активно - хотя уже прошло больше двух суток (вероятно понижение температуры - замедлило процесс. ',
                'temperature' => '44.0',
                'daylight_hours' => '8.30',
                'feed' => 'Тетра Дискус',
                'feed_quantity' => '1500',
                'added_micro' => '6.0',
                'added_fe' => '6.0',
                'added_no3' => '5.0',
                'added_po4' => '2.0',
                'added_k' => '0.0',
                'added_co2' => '20',
                'water_change' => '10',
                'added_cidex' => 'null',
                'test_no3' => 'null',
                'test_po4' => 'null',
                'test_k' => 'null',
                'test_ph' => 'null',
                'test_kh' => 'null',
                'test_gh' => 'null',
                'img_one' => '440d1641da94ff0c6f12cc0493618aaf.jpg',
                'img_two' => 'ee5e014ca99a2cb7a23c8095aa5c6a64.jpg',
                'img_three' => 'null',
                'img_four' => 'null',
                'img_five' => 'null',
                'video_one' => 'null',
                'video_two' => 'null',
                'video_three' => 'null',
                'video_four' => 'null',
                'video_five' => 'null',
        ]);
        $stubThree = $this->createMock(Concentration::class);
        $stubThree->method('concentration')->willReturn([
            'id' => '63',
            'description' => 'Ночью промыл аквариумный фильтр. Количество грязи в нем было непредставимое, рыже-коричневое все. Хоть запаха не было)). Вечером сегодня глянул на аквариум - вода стала намного чище. Рыб Тетра Дискусом кормили - очень умеренно. На переднем стекле две полосы зарастания ксенококусом, - вероятно туда попало либо микро, либо железо. Так же переднее стекло покрыто пушком вроде эдогониума, что наряду с маленькими (карликовыми) листьями на старых растениях и активным отмиранием старых - сигналит о недостатке азота, или фосфора. Поэтому на ночь налил немного и того и другого. Наблюдать за рыбами не было сегодня возможности, но новых проблем вроде нет. СО2 идет активно - хотя уже прошло больше двух суток (вероятно понижение температуры - замедлило процесс. ',
            'temperature' => '44.0',
            'daylight_hours' => '8.30',
            'feed' => 'Тетра Дискус',
            'feed_quantity' => '1500',
            'added_micro' => '6.0',
            'added_fe' => '6.0',
            'added_no3' => '5.0',
            'added_po4' => '2.0',
            'added_k' => '0.0',
            'added_co2' => '20',
            'water_change' => '10',
            'added_cidex' => 'null',
            'test_no3' => 'null',
            'test_po4' => 'null',
            'test_k' => 'null',
            'test_ph' => 'null',
            'test_kh' => 'null',
            'test_gh' => 'null',
            'img_one' => '440d1641da94ff0c6f12cc0493618aaf.jpg',
            'img_two' => 'ee5e014ca99a2cb7a23c8095aa5c6a64.jpg',
            'img_three' => 'null',
            'img_four' => 'null',
            'img_five' => 'null',
            'video_one' => 'null',
            'video_two' => 'null',
            'video_three' => 'null',
            'video_four' => 'null',
            'video_five' => 'null',
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
        $stubFour->method('getUserId')->willReturn([
            'id' => '63',
            'description' => 'Ночью промыл аквариумный фильтр. Количество грязи в нем было непредставимое, рыже-коричневое все. Хоть запаха не было)). Вечером сегодня глянул на аквариум - вода стала намного чище. Рыб Тетра Дискусом кормили - очень умеренно. На переднем стекле две полосы зарастания ксенококусом, - вероятно туда попало либо микро, либо железо. Так же переднее стекло покрыто пушком вроде эдогониума, что наряду с маленькими (карликовыми) листьями на старых растениях и активным отмиранием старых - сигналит о недостатке азота, или фосфора. Поэтому на ночь налил немного и того и другого. Наблюдать за рыбами не было сегодня возможности, но новых проблем вроде нет. СО2 идет активно - хотя уже прошло больше двух суток (вероятно понижение температуры - замедлило процесс. ',
            'temperature' => '44.0',
            'daylight_hours' => '8.30',
            'feed' => 'Тетра Дискус',
            'feed_quantity' => '1500',
            'added_micro' => '6.0',
            'added_fe' => '6.0',
            'added_no3' => '5.0',
            'added_po4' => '2.0',
            'added_k' => '0.0',
            'added_co2' => '20',
            'water_change' => '10',
            'added_cidex' => 'null',
            'test_no3' => 'null',
            'test_po4' => 'null',
            'test_k' => 'null',
            'test_ph' => 'null',
            'test_kh' => 'null',
            'test_gh' => 'null',
            'img_one' => '440d1641da94ff0c6f12cc0493618aaf.jpg',
            'img_two' => 'ee5e014ca99a2cb7a23c8095aa5c6a64.jpg',
            'img_three' => 'null',
            'img_four' => 'null',
            'img_five' => 'null',
            'video_one' => 'null',
            'video_two' => 'null',
            'video_three' => 'null',
            'video_four' => 'null',
            'video_five' => 'null',
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
            'user_id' => 1
        ]);
        $stubFive = $this->createMock(UpdateDb::class);
        $stubFive->method('updateData')->willReturn('[0 => [],]');

        $updateMethodsObj = new UpdateMethods($stub, $stubTwo, $stubThree, $stubFour, $stubFive);
        $result = $updateMethodsObj->update($model, $param, $img, $video);
        $this->assertTrue($result);



    }
}