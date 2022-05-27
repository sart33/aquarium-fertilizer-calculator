<?php


namespace App\Model;


interface ValidateMethods
{
    /**
     * @return mixed
     */
    public function getValidate();

    /**
     * @param $param
     * @param $img
     * @param $video
     * @return mixed
     */
    public function validate($param, $img, $video);


}