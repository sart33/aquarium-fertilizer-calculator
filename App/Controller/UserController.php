<?php


namespace App\Controller;


use App\Service\UserMethods;

final class UserController extends AbstractController
{

    private $user;


    /**
     * UserController constructor.
     * @param UserMethods $user
     */
    public function __construct(UserMethods $user)
    {
        $this->user = $user;
    }

    /**
     * @param null $id
     * @throws \Exception
     */
    public function indexAction($id = null) {

        $param = 'indexAction';

        return Parent::render('index', compact('param'));

    }


    /**
     * @param null $login
     * @param null $password
     * @param null $title
     * @throws \Exception
     */
    public function loginAction($login = null, $password = null, $title = null) {

        if (!empty($_POST['LoginForm']['login']) && !empty($_POST['LoginForm']['password'])) {
            $param = $_POST;
            $result = $this->user->login($param);
            if($result === true) {
                header("location: /");
                echo 'You are successfully logged in';
            } else {
                throw new \LogicException('Login error. Try again');

                $form = 'login-form';
                return Parent::render('login', compact('form'));
            }

        } else {

            $form = 'login-form';
            return Parent::render('login', compact('form'));
        }
    }


    /**
     * @param $id
     */
    public function accountAction($id) {
        try {
            $params = $this->user->account($id);
            if($params !== false) {
                return Parent::render('account', compact('params'));
            } else {
                throw new \LogicException('SQL data Error!!!');
            }

        } catch (\Exception $e) {
            $messageException = "[" . date('Y-m-d H:i:s', time()) . "] Exception message: " . $e->getMessage() . " in file: " . $e->getFile() . " line number: " . $e->getLine() . PHP_EOL;
            file_put_contents(dirname(__DIR__) . '/Log/exception.txt', $messageException, FILE_APPEND | LOCK_EX);
            echo $e->getMessage();
        }
    }


    /**
     * @throws \Exception
     */
    public function registerAction() {

        if(isset($_POST['SignupForm']['login']) && isset($_POST['SignupForm']['email']) && isset($_POST['SignupForm']['password']) && ($_POST['SignupForm']['password'] === $_POST['SignupForm']['password-confirm'])) {
            $param = $_POST;
            try {

                $result = $this->user->register($param);
                if ($result['registration'] === true) {
                    echo $result['yes'];
                    return Parent::render('index', $result['yes']);
                }
            }
            catch (\Exception $e) {
                    $messageException = "[" . date('Y-m-d H:i:s', time()) . "] Exception message: " . $e->getMessage() . " in file: " . $e->getFile() . " line number: " . $e->getLine() . PHP_EOL;
                    file_put_contents(dirname(__DIR__) . '/Log/exception.txt', $messageException, FILE_APPEND | LOCK_EX);

                    echo $e->getMessage();
            }

        } else {

            $form = 'register-form';
            return Parent::render('register', compact('form'));
        }
    }


    /**
     * @param $getParam
     * @throws \Exception
     */
    public function verificationAction($getParam)
    {

        $result = $this->user->verification($getParam);
        if (!empty($result)) {

            $param['message'] = 'Ваш аккаунт успешно подтвержден';
            return Parent::render('index', compact('param'));

        } else {
            $param['message'] = 'Ошибка подтверждения аккаунта';
            return Parent::render('index', compact('param'));
        }
    }


    /**
     * @param $id
     * @throws \Exception
     */
    public function logoutAction($id) {
        if($this->user->authTry() === true) {

            $this->user->logout();
        } else {
            header("HTTP/1.1 403 Forbidden");
            echo 'Авторизируйтесть для доступа к даной странице';

        }
    }

}