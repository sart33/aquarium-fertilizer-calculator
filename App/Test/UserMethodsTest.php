<?php


namespace App\Test;

use App\Db\DbConnection;
use App\Service\User;
use App\Service\UserMethods;
//use App\Model\ValidateMethods;
use App\Service\Validate;
use PHPUnit\Framework\TestCase;

class UserMethodsTest extends TestCase
{
    private $user;

//    protected function setUp():void {
//        $this->user = new UserMethods();
//    }


    protected function tearDown():void {
        $this->user = NULL;
    }

    public function getValidRegister(): array {
        return [
            ['token' => '2158475b877446df7ef5ae6278ec0e357a2cd26ad0cda30b72a7cd4b231240ef',
                'SignupForm' => [
                'login' => 'Gleb99',
                'password' => 'KRqx54JmPRZAidc',
                'password-confirm' => 'KRqx54JmPRZAidc',
                'email' => 'test2@gmail.com',
                'agree' => '1'
                ]

            ]
        ];

    }
    /**
     * @test
     * @dataProvider getValidRegister
     */
    public function detect_an_valid_register_method($param) {
        $result = $this->user->register($param);
        $this->isTrue($result['registration']);
//        $this->assertIsNumeric(0, $result['totalPages']);
//        $this->assertIsNumeric(0, $result['paginate']);


    }

    public function getValidUserId() {
        return [
            ['SartXY'],
            [''],
        ];

    }
    /**
     * @test
     * @dataProvider getValidUserId
     */
    public function detect_an_an_valid_UserId_method($login) {
        $arr = [
            '0' => ['id' => 1]
            ];
        $stub = $this->createMock(Validate::class);
        $stub->method('validate')->willReturn('SartXY');
        $stubTwo = $this->createMock(DbConnection::class);
        $stubTwo->method('inquireIntoDb')->willReturn($arr);
        $userMethodsObj = new UserMethods($stub, $stubTwo);
        $result = $userMethodsObj->getUserId($login);
        $this->assertIsInt($result);



    }
}