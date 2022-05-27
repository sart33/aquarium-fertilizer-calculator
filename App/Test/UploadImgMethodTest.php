<?php
namespace App\Test;

use App\Service\ImageSave;
use App\Service\ImageTransform;
use App\Service\UploadImg;
use App\Service\UploadImgMethods;

class UploadImgMethodTest extends \PHPUnit\Framework\TestCase
{
    private $uploadImgMethod;

//    protected function setUp(): void
//    {
//        $this->uploadImg = new UploadImgMethods();
//    }

    protected function tearDown(): void
    {
        $this->uploadImgMethod = NULL;
    }

    public function getValidUploadImgMethod(): array {
        return [
            [[
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
            ], [1, 4]],
            [[
                'name' => [
                        0 => '222.jpg',
                        1 => 'hh.jpg',
                        2 => 'hh.jpg',
                        3 => 'hhf.jpg',
                    ],
                'type' => [
                        0 => 'image/jpeg',
                        1 => 'image/jpeg',
                        2 => 'image/jpeg',
                        3 => 'image/jpeg',
                    ],
                'tmp_name' => [
                        0 => '/tmp/phpbzVbsf',
                        1 => '/tmp/phpTbbPPt',
                        2 => '/tmp/phpTbbFFt',
                        3 => '/tmp/phpGfnbFFt',
                    ],
                'error' => [
                        0 => 0,
                        1 => 0,
                        2 => 0,
                        3 => 0,
                    ],
                'size' => [
                        0 => 32806,
                        1 => 34843,
                        2 => 33243,
                        3 => 30224,
                    ],
            ], [1, 4]]



        ];
    }

    /**
     * @test
     * @dataProvider getValidUploadImgMethod
     */

    public function detect_an_valid_uploadImg_method($img, $limit)
    {
        $stub = $this->createMock(ImageTransform::class);
        $stub->method('imageFullScale')->willReturn('imageObjFull');
        $stub->method('imageThumbScale')->willReturn('imageObjThumb');
        $stubTwo = $this->createMock(ImageSave::class);
        $stubTwo->method('imageFullSave')->willReturn(true);
        $stubTwo->method('imageThumbSave')->willReturn(true);
        $uploadImgMethodsObj = new UploadImgMethods($stub, $stubTwo);
        $result = $uploadImgMethodsObj->multiUploadImg($img, $limit);
        $this->assertRegExp('#^[[:xdigit:]]{32}.jpg$#', $result['img_one']);
        if(isset($result['img_two'])) {
            $this->assertRegExp('#^[[:xdigit:]]{32}.jpg$#', $result['img_two']);
        }
        if(isset($result['img_three'])) {
            $this->assertRegExp('#^[[:xdigit:]]{32}.jpg$#', $result['img_three']);
        }
        if(isset($result['img_four'])) {
            $this->assertRegExp('#^[[:xdigit:]]{32}.jpg$#', $result['img_four']);
        }
    }
}