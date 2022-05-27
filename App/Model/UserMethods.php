<?php


namespace App\Model;


interface UserMethods

{
    /**
     * @param $param
     * @return mixed
     */
    public function login($param);

    /**
     * @return mixed
     */
    public function logout();

    /**
     * @param $param
     * @return mixed
     */
    public function register($param);

    /**
     * @param $param
     * @return mixed
     */
    public function verification($param);

    /**
     * @param $id
     * @param $login
     * @return mixed
     */
    public function rememberMe($id, $login);

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id);

    /**
     * @param $id
     * @return mixed
     */
    public function account($id);

    /**
     * @return bool
     */
    public function authTry():bool;

}