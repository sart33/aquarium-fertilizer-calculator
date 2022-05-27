<?php


namespace App\Controller;




use App\Model\Aquarium;
use App\Service\AquariumData;
use App\Service\Charts;
use App\Service\DeleteDb;
use App\Service\Fertilizer;
use App\Service\FinalConcentration;
use App\Service\ReadDb;
use App\Service\Update;
use App\Service\User;
use App\Service\Create;

class AquariumController extends AbstractController
{
    /**
     * @var Aquarium|object
     */
    private object $aquarium;

    /**
     * @var AquariumData|object
     */
    private object $aquariumData;

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
     * @var int|string
     */
    private string $startDate;

    /**
     * @var FinalConcentration|object
     */
    private object $finalConcentration;

    /**
     * @var Fertilizer|object
     */
    private object $fertilizer;

    /**
     * AquariumController constructor.
     * @param Aquarium $aquarium
     * @param AquariumData $aquariumData
     * @param DeleteDb $deleteDb
     * @param Charts $charts
     * @param ReadDb $readDb
     * @param Update $update
     * @param Create $create
     * @param FinalConcentration $finalConcentration
     * @param User $user
     * @param Fertilizer $fertilizer
     */
    public function __construct(Aquarium $aquarium, AquariumData $aquariumData, DeleteDb $deleteDb, Charts $charts,
        ReadDb $readDb, Update $update, Create $create, FinalConcentration $finalConcentration, User $user,
        Fertilizer $fertilizer)
    {
         $this->aquarium = $aquarium;
         $this->aquariumData = $aquariumData;
         $this->finalConcentration = $finalConcentration;
         $this->user = $user;
         $this->create = $create;
         $this->readDb = $readDb;
         $this->update = $update;
         $this->charts = $charts;
         $this->fertilizer = $fertilizer;
         $this->deleteDb = $deleteDb;
         $this->startDate = START_DATE;

    }

    /**
     * @param $getParams
     * @param null $id
     * @param null $title
     * @throws \Exception
     */
    public function indexAction($getParams, $id = null, $title = null) {

        if($this->user->authTry() === true) {

        if(isset($getParams)) {
            if(!is_array($getParams)) {
                $tempVariable = (int)$getParams;
                if(is_array($id)) {
                    $getParams = $id;
                    $id = $tempVariable;
                }  else {
                    $id = $tempVariable;
                    $getParams = null;
                    $tableName = $this->aquarium->getTableName();
                    $params = $this->readDb->findAll($tableName, $id);
                    if (isset($title)) {
                        $params['title'] = $title;
                    }
                    return Parent::render('index', compact('params'));
                }
            }
            if(isset($getParams['sort'])) {
                $field = $getParams['sort'];
                if(isset($getParams['order'])) {
                    $asc = $getParams['order'];
                    $tableName = $this->aquarium->getTableName();
                    $params = $this->readDb->findAllWithGetParam($tableName, $field, $asc, $id);
                    $params = array_merge($params, $getParams);
                    if(isset($title)) {
                        $params['title'] = $title;
                    }
                } else {
                    $tableName = $this->aquarium->getTableName();
                    $params = $this->readDb->findAllWithGetParam($tableName, $field, 'desc', $id);
                    $params = array_merge($params, $getParams);
                    if(isset($title)) {
                        $params['title'] = $title;
                    }

                }
            }
        } else {
            $tableName = $this->aquarium->getTableName();
            $params = $this->readDb->findAll($tableName, $id);
            if(isset($title)) {
                $params['title'] = $title;
            }
        }
        return Parent::render('index', compact('params'));

    } else {
            header("HTTP/1.1 403 Forbidden");
            return Parent::render('403');

            echo 'Авторизируйтесть для доступа к даной странице';
        }
    }


    /**
     * @throws \Exception
     */
    public function createAction() {

        if($this->user->authTry() === true) {

            $form = 'aquarium-daily-form';
            $params['micro'] = $this->fertilizer->getListMicro();
            $params['fe'] = $this->fertilizer->getListFe();
            $params['form'] = $form;
        return Parent::render('create', compact('params'));

        } else {
        header("HTTP/1.1 403 Forbidden");
        echo 'Авторизируйтесть для доступа к даной странице';
        }
    }


    /**
     * @return bool
     */
    public function storeAction() {

        if($this->user->authTry() === true) {
        $param = $_POST;
        $img = $_FILES['images'] ?? null;
        $video = $_FILES['videos'] ?? null;
        $tableName = $this->aquarium->getTableName();
        $result =  $this->create->create($tableName, $param, $img, $video);
        if ($result === true) {

            header("Location: /");
            echo 'Информация успешно добавлена';
            return true;
        } else {
            header("Location: /create");
            echo 'Информация не добавлена';
            return false;
        }

//        return Parent::render('store', compact('params'));

    } else {
            header("HTTP/1.1 403 Forbidden");
            echo 'Авторизируйтесть для доступа к даной странице';
        }
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function viewAction(int $id)
    {

        if ($this->user->authTry() === true) {

            $allFinalParamArr = $this->aquariumData->getAquariumDate($id);
            $finalConcentrationArr = $this->finalConcentration->finalConcentration($id);
            $params = array_merge($allFinalParamArr, $finalConcentrationArr);

            return Parent::render('view', compact('params'));

        } else {

        header("HTTP/1.1 403 Forbidden");
        echo 'Авторизируйтесть для доступа к даной странице';

        }
    }
    /**
     * @param int $id
     * @throws \Exception
     */
//    public function viewAction(int $id) {
//
//        if($this->user->authTry() === true) {
//
//        $aquariumParamsArr = $this->readDb->findOne('Aquarium', $id, null);
//        $concentrationParamsArr = $this->readDb->findOne('Concentration', $aquariumParamsArr['id'], 'entry_id');
//        $testParamsArr = $this->readDb->findOne('Test', $aquariumParamsArr['id'], 'entry_id');
//        $lightParamsArr = $this->readDb->findOne('Light', $aquariumParamsArr['id'], 'entry_id');
//        $finalConcentrationArr = $this->finalConcentration->finalConcentration($id);
//        $params = array_merge($aquariumParamsArr, $concentrationParamsArr, $testParamsArr, $finalConcentrationArr, $lightParamsArr);
//        $params['id'] = $aquariumParamsArr['id'];
//        return Parent::render('view', compact('params'));
//
//        } else {
//        header("HTTP/1.1 403 Forbidden");
//        echo 'Авторизируйтесть для доступа к даной странице';
//        }
//    }


    /**
     * @throws \Exception
     */
    public function chartsAction() {

        if($this->user->authTry() === true) {

//            $params = (new Aquarium())->findOne($id);
            $params = $this->charts->charts();
//            $params = '';
            return Parent::render('charts', compact('params'));

        } else {
            header("HTTP/1.1 403 Forbidden");
            echo 'Авторизируйтесть для доступа к даной странице';
        }
    }


    /**
     * @throws \Exception
     */
    public function diaryAction() {

        if($this->user->authTry() === true) {

//            $params = (new Aquarium())->findOne($id);

//            $params = (new Aquarium())->charts();
            return Parent::render('diary', compact('params'));

        } else {
            header("HTTP/1.1 403 Forbidden");
            echo 'Авторизируйтесть для доступа к даной странице';
        }
    }


    /**
     * @param int $id
     * @throws \Exception
     */
    public function editAction(int $id) {

        if($this->user->authTry() === true) {

            $form = 'aquarium-daily-form';
            $params = $this->aquariumData->getAquariumDate($id);
            $params['micro'] = $this->fertilizer->getListMicro();
            $params['fe'] = $this->fertilizer->getListFe();
            $params['form'] = $form;

        return Parent::render('edit', compact('params'));

    } else {
        header("HTTP/1.1 403 Forbidden");
        echo 'Авторизируйтесть для доступа к даной странице';
        }
    }


    /**
     * @param int $id
     */
    public function updateAction(int $id) {
        if($this->user->authTry() === true) {
            $param = $_POST;
            $img = $_FILES['images'] ?? null;
            $video = $_FILES['videos'] ?? null;
            $tableName = $this->aquarium->getTableName();
            $res = $this->update->update($tableName, $param, $img, $video);

            if ($res === true)
            {
                header("Location: /view/" . $id);

            } else {
                throw new \LogicException('Update of material - failed!');

            }


        } else {
            header("HTTP/1.1 403 Forbidden");
            echo 'Авторизируйтесть для доступа к даной странице';
        }
    }


    /**
     * @param $id
     */
    public function deleteAction($id) {

        if($this->user->authTry() === true) {
            $res = $this->deleteDb->delete('Aquarium', $id);
            if ($res === true)
            {
                header("Location: /");

            } else {
                throw new \LogicException('Delete of material - failed!');
            }

        } else {
            header("HTTP/1.1 403 Forbidden");
            echo 'Авторизируйтесть для доступа к даной странице';
        }
    }

    public function addedInWeek($weekId) {

//        $allParamArr[$item] = $this->readDb->findOne($item, $allParamArr['Aquarium']['id'], 'entry_id');

    }

    public function thisWeek($weekId) {

    }

    public function byMonth() {

    }

    public function thisMonth($monthId) {

    }





//    public function taskAction()
//    {
//        $params = (new Task())->allTasks();
//        return Parent::render('task', compact('params'));
//
//    }

    /**
     * @throws \Exception
     */
    public function notFound() {


        return Parent::render('404');

    }
}