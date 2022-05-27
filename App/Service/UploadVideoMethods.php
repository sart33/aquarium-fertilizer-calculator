<?php


namespace App\Service;


final class UploadVideoMethods implements UploadVideo
{
    /**
     * @param $video
     * @param null $limit
     * @return array|mixed
     */
    public function multiUploadVideo($video, $limit = null)
    {

        $filename = '';
        if (!empty($video)) {
            $videoName = [];
            if ($limit[1] !== null && is_numeric($limit[1])) {
                $count = $limit[1];
            } else {
                $count = count($video['name']);
            }
            for ($i = 0; $i < $count; $i++) {

                if (isset($video['error'][$i])) {
                    if ($video['error'][$i] === 0) {
                        $file = $video['name'][$i];
//                        $file = str_replace('jpeg', 'jpg', $file);
                        $fileArr = explode('.', $file);
                        $fileHash = md5(uniqid());
                        $ext = $fileArr[1];
                        $fileName = $fileHash . '.' . $fileArr[1];
                        if ($i === 0) $nameInArr = 'video_one';
                        elseif ($i === 1) $nameInArr = 'video_two';
                        elseif ($i === 2) $nameInArr = 'video_three';
                        elseif ($i === 3) $nameInArr = 'video_four';
                        elseif ($i === 4) $nameInArr = 'video_five';
                        $videoName[$nameInArr] = $fileName;

                        move_uploaded_file($video['tmp_name'][$i], dirname(__DIR__, 2) . '/public/video/' . $fileName);
                    }
                } else {
//                    $videoName = null;
                }
            }
            return $videoName;
        }
    }

}