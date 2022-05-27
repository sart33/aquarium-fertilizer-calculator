<?php

namespace App\Controller;

use App\Model\Ads;
use App\Model\Aquarium;
use App\Service\Charts;
use App\Service\Create;
use App\Service\DeleteDb;
use App\Service\ReadDb;
use App\Service\Update;
use App\Service\User;
use App\Service\UserMethods;

class AdsController extends AbstractController
{

    /**
     * @var Ads|object
     */
    private object $ads;

    /**
     * @var User|object
     */
    private object $user;

    /**
     * @var ReadDb|object
     */
    private object $readDb;

    /**
     * @var Create|object
     */
    private object $create;

    /**
     * @var Charts|object
     */
    private object $charts;

    /**
     * @var Update|object
     */
    private object $update;

    /**
     * @var DeleteDb|object
     */
    private object $deleteDb;


    /**
     * AdsController constructor.
     * @param Ads $ads
     * @param DeleteDb $deleteDb
     * @param Charts $charts
     * @param ReadDb $readDb
     * @param Update $update
     * @param Create $create
     * @param User $user
     */
    public function __construct(Ads $ads, DeleteDb $deleteDb, Charts $charts, ReadDb $readDb, Update $update,
                                Create $create, User $user)
    {
        $this->ads = $ads;
        $this->user = $user;
        $this->create = $create;
        $this->readDb = $readDb;
        $this->update = $update;
        $this->charts = $charts;
        $this->deleteDb = $deleteDb;

    }

    /**
     * @param $getParams
     * @param null $id
     * @param null $title
     * @throws \Exception
     */
    public function indexAction($getParams, $id = null,  $title = null)
    {
        if ($this->user->authTry() === true) {
            $tableName = $this->ads->getTableName();
            if (isset($getParams)) {
                if (!is_array($getParams)) {
                    $tempVariable = (int)$getParams;
                    if (is_array($id)) {
                        $getParams = $id;
                        $id = $tempVariable;
                    } else {
                        $id = $tempVariable;
                        $getParams = null;
                        $params = [];
//                        $this->readDb->findAll($tableName, $id);
                        if (isset($title)) {
                            $params['title'] = $title;
                        }
                        return Parent::render('index', compact('params'));
                    }
                }
                if (isset($getParams['sort'])) {
                    $field = $getParams['sort'];
                    if (isset($getParams['order'])) {
                        $asc = $getParams['order'];
                        $params = [];
//                        $this->readDb->findAllWithGetParam($tableName, $field, $asc, $id);
                        $params = array_merge($params, $getParams);
                        if (isset($title)) {
                            $params['title'] = $title;
                        }
                    } else {
//                        $params = $this->readDb->findAllWithGetParam($tableName, $field, 'desc', $id);
                        $params = [];
                        $params = array_merge($params, $getParams);
                        if (isset($title)) {
                            $params['title'] = $title;
                        }

                    }
                }
            } else {
//                $params = $this->readDb->findAll($tableName, $id);
                $params = [];
                if (isset($title)) {
                    $params['title'] = $title;
                }
            }
            return Parent::render('index', compact('params'));

        }
    }

    public function twoSevenAction($getParams, $id = null,  $title = null)
    {
        if ($this->user->authTry() === true) {

//                        $params = $this->readDb->findAllWithGetParam($tableName, $field, 'desc', $id);
                        $params = [];
                        if (isset($title)) {
                            $params['title'] = $title;
                        }


            } else {
//                $params = $this->readDb->findAll($tableName, $id);
                $params = [];
                if (isset($title)) {
                    $params['title'] = $title;
                }
            }
            return Parent::render('two-seven', compact('params'));

        }


    /**
     * @param $id
     * @throws \Exception
     */
    public function viewAction($id) {

        $params = $this->ads->findOne($id);

        return Parent::render('view', compact('params'));

    }








    public function createAction() {
        if($this->user->authTry() === true) {
        $form = 'create-form';
        return Parent::render('create', compact('form'));

        } else {
            header("HTTP/1.1 403 Forbidden");
            echo 'Авторизируйтесть для доступа к даной странице';
        }

    }








    public function storeAction() {
        if($this->user->authTry() === true) {
        $img = null;
        $param = $_POST;
        if(isset($_FILES['images'])) {
        $img = $_FILES['images'];
        }
        $params = $this->ads->create($param, $img);

        return Parent::render('store', compact('params'));

        } else {
            header("HTTP/1.1 403 Forbidden");
            echo 'Авторизируйтесть для доступа к даной странице';
        }
    }









    public function notFound() {


        return Parent::render('404');

    }

}