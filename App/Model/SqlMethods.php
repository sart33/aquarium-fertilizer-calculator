<?php


namespace App\Model;


interface SqlMethods
{
    /**
     * @param int $id
     * @return mixed
     */
    public function findAll(int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function findOne(int $id);

    /**
     * @param $field
     * @param $asc
     * @param $id
     * @return mixed
     */
    public function findAllWithGetParam($field, $asc, $id);

    /**
     * @param $param
     * @param null $img
     * @param null $video
     * @return mixed
     */
    public function create($param, $img = null, $video = null);

    /**
     * @param $param
     * @param null $img
     * @param null $video
     * @return mixed
     */
    public function update($param, $img = null, $video = null);

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);
}