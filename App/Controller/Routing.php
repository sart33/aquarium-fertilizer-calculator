<?php

namespace App\Controller;

use App\Config\Routes;
use App\Service\AquariumData;
use App\Service\AquariumDataMethods;
use App\Service\AquariumUpdateMethods;
use App\Service\Fertilizer;
use App\Service\FertilizerMethods;
use App\Service\FinalConcentration;
use App\Service\FinalConcentrationMethods;
use App\Service\ImageSave;
use App\Service\ImageSaveMethods;
use App\Service\ImageTransform;
use App\Service\ImageTransformMethods;
use App\Service\Light;
use App\Service\LightMethods;
use App\Service\Test;
use App\Service\TestMethods;
use App\Service\UpdateDbMethods;
use App\Service\User;
use App\Service\AquariumChartsMethods;
use App\Service\AquariumConcentrationMethods;
use App\Service\AquariumCreateMethods;
use App\Service\Charts;
use App\Service\ClassNameToDbTable;
use App\Service\ClassNameToDbTableMethods;
use App\Service\Concentration;
use App\Service\Create;
use App\Service\DbTableColumnsKey;
use App\Service\DbTableColumnsKeyMethods;
use App\Service\DeleteDb;
use App\Service\DeleteDbMethods;
use App\Service\DeleteImg;
use App\Service\DeleteImgMethods;
use App\Service\DeleteVideo;
use App\Service\DeleteVideoMethods;
use App\Service\InsertDb;
use App\Service\InsertDbMethods;
use App\Service\Paginate;
use App\Service\PaginateMethods;
use App\Service\ReadDb;
use App\Service\ReadDbMethods;
use App\Service\UpdateDb;
use App\Service\Update;
use App\Service\UpdateMethods;
use App\Service\UploadImg;
use App\Service\UploadImgMethods;
use App\Service\UploadVideo;
use App\Service\UploadVideoMethods;
use App\Service\UserMethods;
use App\Service\Validate;
use App\Service\ValidateMethods;
use App\Service\ViberSender;
use App\Service\ViberSenderMethods;
use Illuminate\Container\Container;

class Routing {

    /**
     * @var Routes|object
     */
    private object $routes;

    /**
     * Routing constructor.
     * @param Routes $routes
     */
    public function __construct(Routes $routes) {
        $this->routes = $routes;

    }


    /**
     * @return mixed|void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function routing()
    {
        $url = $_SERVER['REQUEST_URI'];
        $result = $this->parse($url);

        if (is_array($result)) {
            if (isset($result['className']) && isset($result['action'])) {
                if (!empty($result['param'])) {
                    if (!empty($result['getParam'])) {
                        if (!empty($result['title'])) {
                            return $this->createRoute($result['className'], $result['action'], $result['param'], $result['getParam'], $result['title']);
                        } else {
                            return $this->createRoute($result['className'], $result['action'], $result['param'], $result['getParam']);
                        }
                    } else {
                        if (!empty($result['title'])) {
                            return $this->createRoute($result['className'], $result['action'], $result['param'], $result['title']);
                        } else {
                            return $this->createRoute($result['className'], $result['action'], $result['param']);
                        }
                    }
                } else {
                    if (!empty($result['getParam'])) {
                        if (!empty($result['title'])) {
                            return $this->createRoute($result['className'], $result['action'], $result['getParam'], $result['title']);
                        } else {
                            return $this->createRoute($result['className'], $result['action'], $result['getParam']);
                        }
                    } else {
                        if (!empty($result['title'])) {
                            return $this->createRoute($result['className'], $result['action'], $result['title']);
                        } else {
                            return $this->createRoute($result['className'], $result['action']);
                        }
                    }
                }
            }
        } else {
            if ($result === false) {
                return $this->errorMessage();
            }
        }
    }


    /**
     * @param $className
     * @param $action
     * @param null $param
     * @param null $getParam
     * @param null $title
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function createRoute($className, $action, $param = null, $getParam = null, $title = null) {
        if(is_string($param) && !is_numeric($param)) {
            $title = $param;
            $param = null;
        }
        if(is_string($getParam) && !is_numeric($getParam)) {
            $title = $getParam;
            $getParam = null;
        }
        if(is_string($getParam) && is_numeric($getParam)) {
            $tempVariable = (int)$getParam;
            if (is_array($param)) {
                $getParams = $param;
                $param = $tempVariable;
            }
        }

        $classNameArr = explode('\\', $className);
        $nameClass = end($classNameArr);
//        preg_match('#^(.+)Controller$#', $nameClass, $matches);
        preg_match('#^(.+)Methods$#', $nameClass, $matches);

//        if(isset($matches[1])) {
//            $serviceName = '\\' . $classNameArr[0] . '\\Service\\' . $matches[1];
//            $serviceUser = '\\' . $classNameArr[0] . '\\Service\User';
//            $service = (new $serviceName());
//            $user = (new $serviceUser());
//            if($serviceName === $serviceName) {
//                return (new $className($user))->$action($param, $getParam, $title);
//            }
//            return (new $className($service, $user))->$action($param, $getParam, $title);
//
//        } else {


        $container = Container::getInstance();
        $container->bind(Validate::class, ValidateMethods::class);
        $container->bind(User::class, UserMethods::class);
        $container->bind(Concentration::class, AquariumConcentrationMethods::class);
        $container->bind(Test::class, TestMethods::class);
        $container->bind(Light::class, LightMethods::class);
        $container->bind(UploadImg::class, UploadImgMethods::class);
        $container->bind(UploadVideo::class, UploadVideoMethods::class);
        $container->bind(DbTableColumnsKey::class, DbTableColumnsKeyMethods::class);
        $container->bind(ClassNameToDbTable::class, ClassNameToDbTableMethods::class);
        $container->bind(DeleteImg::class, DeleteImgMethods::class);
        $container->bind(DeleteVideo::class, DeleteVideoMethods::class);
        $container->bind(DeleteDb::class, DeleteDbMethods::class);
        $container->bind(Paginate::class, PaginateMethods::class);
        $container->bind(InsertDb::class, InsertDbMethods::class);
        $container->bind(ReadDb::class, ReadDbMethods::class);
        $container->bind(Charts::class, AquariumChartsMethods::class);
        $container->bind(Update::class, AquariumUpdateMethods::class);
        $container->bind(UpdateDb::class, UpdateDbMethods::class);
        $container->bind(Create::class, AquariumCreateMethods::class);
        $container->bind(ImageTransform::class, ImageTransformMethods::class);
        $container->bind(ImageSave::class, ImageSaveMethods::class);
        $container->bind(FinalConcentration::class, FinalConcentrationMethods::class);
        $container->bind(Fertilizer::class, FertilizerMethods::class);
        $container->bind(AquariumData::class, AquariumDataMethods::class);
        $container->bind(ViberSender::class, ViberSenderMethods::class);
        $Obj = $container->make($className);
        return $Obj->$action($param, $getParam, $title);

//        }
    }

    /**
     * @param $url
     * @return array|false
     */
    public function parse($url) {
        $param = '';
        $getParam = [];
        $urlPath = false;
        $admin = false;
        $url = rtrim($url, '/');

        if(strpos($url, 'admin') === 1) {
            $admin = true;
            $url = preg_replace('#^/admin#', '', $url);
            $url = rtrim($url, '/');
        }

        if(!empty($url)) {

            if (strpos($url, '?') !== false) {

                $urlGetArr = explode('?', $url);
                $url = $urlGetArr[0];
                if(isset($urlGetArr[1])) {
                    $getParams = $urlGetArr[1];
                    $getParamArr = explode('&', $getParams);
                    if(!empty($getParamArr[0]) && strpos($getParamArr[0], '=') !== false) {
                        $getParamNameValueArr = explode('=', $getParamArr[0]);
                        if(!empty($getParamNameValueArr[0] && !empty($getParamNameValueArr[1]))) {
                            $getParam[$getParamNameValueArr[0]] = $getParamNameValueArr[1];
                        }
                    }
                    if(!empty($getParamArr[1]) && strpos($getParamArr[1], '=') !== false) {
                        $getParamNameValueArrTwo = explode('=', $getParamArr[1]);
                        if(!empty($getParamNameValueArrTwo[0] && !empty($getParamNameValueArrTwo[1]))) {
                            $getParam[$getParamNameValueArrTwo[0]] = $getParamNameValueArrTwo[1];
                        }
                    }
                }
            }
            if (strpos($url, '/') !== false) {
                $urlArr = explode('/', $url);
                array_shift($urlArr);
                if($admin === true) {
                    $urlPath = 'admin/' . $urlArr[0];
                } else {
                    $urlPath = $urlArr[0];
                }
                array_shift($urlArr);
                foreach ($urlArr as $urlFrag) {
                    if(is_numeric($urlFrag)) {
                        $param = $urlFrag;
                    } else {
                        $urlPath .= '/' . $urlFrag;
                        $urlPath = rtrim($urlPath, '/');
                    }
                }
            }
        } else {
            if($admin === true) {
                $urlPath = 'admin';
            } else {
                $urlPath = '';
            }
        }
           if (isset($this->routes::routingTable()[$urlPath])) {
               $path = $this->routes::routingTable()[$urlPath];
               $infoArr = explode('@', $path[0]);
               $class = ucfirst($infoArr[0]) . 'Controller';
               if($admin) {
                   $className = __NAMESPACE__ . '\\Admin\\' . $class;
               } else {
               $className = __NAMESPACE__ . '\\' . $class;
               }
               $action = $infoArr[1] . 'Action';

               if(!empty($param)) {
                   if(!empty($path[1]) && ($path[1] === 'param')) {
                       if(!empty($path[2]) && ($path[2] === '?')) {
                           if(!empty($path[3]) && is_string($path[3])) {
                               $title = $path[3];
                           return compact('className', 'action', 'getParam', 'param', 'title');
                           } else {
                               return compact('className', 'action', 'getParam', 'param');
                           }
                       } else {
                           if (!empty($path[3]) && is_string($path[3])) {
                               $title = $path[3];
                               return compact('className', 'action', 'param', 'title');
                           } else {
                               return compact('className', 'action', 'param');
                           }
                       }
                   } else {
                       return false;
                   }
               } else {
                   if (!empty($path[1]) && ($path[1] === 'param')) {
                       return false;
                   } else {
                       if (!empty($path[2]) && ($path[2] === '?')) {
                           if (!empty($path[3]) && is_string($path[3])) {
                               $title = $path[3];
                               return compact('className', 'action', 'getParam', 'title');
                           } else {
                               return compact('className', 'action', 'getParam');
                           }
                       } else {
                           if (!empty($path[3]) && is_string($path[3])) {
                               $title = $path[3];
                               return compact('className', 'action', 'title');
                           } else {
                               return compact('className', 'action');
                           }
                       }
                   }
               }
            } else {
               return false;
           }

    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function errorMessage() {
        header('HTTP/1.1 404 Not Found');
        $this->createRoute('App\Controller\AquariumController', 'notFound', null, null, '404');

    }

}