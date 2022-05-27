<?php


namespace App\Model;


use App\Config\Routes;
use App\Db\DbConnection;
use phpDocumentor\Reflection\Types\Parent_;

class Aquarium
{


    /**
     * @var string
     */
    private string $tableName;


    /**
     * Aquarium constructor.
     */
    public function __construct()
    {
        $this->tableName = 'aquarium';
    }

    /**
     * @return string
     */
    public function getTableName() {
        return $this->tableName;
    }

    /**
     * @return array
     */
    public function getValidate()
    {
        return [
            'id' => [1, 4, '#^[0-9]{1,4}$#ui'],

            'temperature' => [1, 4, '#^[0-9]{1,2}\.*?[0-9]{0,1}$|^null$#ui'],

            'daylight_hours' => [1, 5, '#^[0-9]{1,2}\.*?[0-9]{0,2}$#ui'],
            'brightness' => [4, 6, '#^[0-9]{4,6}$#ui'],
            'colorful_temperature' => [4, 5, '#^[0-9]{4,5}$#ui'],

            'feed' => [3, 100, '#^[A-Za-zА-Яа-я0-9,\s]{3,100}$#ui'],
            'feed_quantity' => [3, 5, '#^[0-9]{3,5}$#ui'],

            'added_no3' => [1, 4, '#^[0-9]{1,2}\.*?[0-9]{0,1}$#ui'],
            'added_micro' => [1, 4, '#^[0-9]{1,2}\.*?[0-9]{0,1}$#ui'],
            'added_po4' => [1, 4, '#^[0-9]{1,2}\.*?[0-9]{0,1}$#ui'],
            'added_k' => [1, 5, '#^[0-9]{1,3}\.*?[0-9]{0,1}$#ui'],
            'added_fe' => [1, 4, '#^[0-9]{1,2}\.*?[0-9]{0,1}$#ui'],

            'water_change' => [1, 4, '#^[0-9]{1,3}\.*?[0-9]{0,1}$#ui'],

            'added_cidex' => [1, 5, '#^[0-9]{1,3}\.*?[0-9]{0,1}$|^null$#ui'],

            'test_co2' => [1, 5, '#^[0-9]{1,3}\.*?[0-9]{0,1}$#ui'],
            'test_no3' => [1, 5, '#^[0-9]{1,3}\.*?[0-9]{0,1}$|^null$#ui'],
            'test_po4' => [1, 4, '#^[0-9]{1,2}\.*?[0-9]{0,1}$|^null$#ui'],
            'test_ph' => [1, 4, '#^[0-9]{1,2}\.*?[0-9]{0,1}$|^null$#ui'],
            'test_kh' => [1, 4, '#^[0-9]{1,2}\.*?[0-9]{0,1}$|^null$#ui'],
            'test_gh' => [1, 4, '#^[0-9]{1,2}\.*?[0-9]{0,1}$|^null$#ui'],
            'test_k' => [1, 5, '#^[0-9]{1,3}\.*?[0-9]{0,1}$|^null$#ui'],

            'description' => [5, 5000],

            'img' => [1, 4],
            'img_one' => [4, 36 , '#^[[:xdigit:]]{32}.jpg$|^[[:xdigit:]]{32}.png|^null$#ui'],
            'img_two' => [4, 36 , '#^[[:xdigit:]]{32}.jpg$|^[[:xdigit:]]{32}.png|^null$#ui'],
            'img_three' => [4, 36 , '#^[[:xdigit:]]{32}.jpg$|^[[:xdigit:]]{32}.png|^null$#ui'],
            'img_four' => [4, 36 , '#^[[:xdigit:]]{32}.jpg$|^[[:xdigit:]]{32}.png|^null$#ui'],
            'img_five' => [4, 36 , '#^[[:xdigit:]]{32}.jpg$|^[[:xdigit:]]{32}.png|^null$#ui'],

            'video' => [0, 4],
            'video_one' => [4, 36 , '#^[[:xdigit:]]{32}.mkv$|^[[:xdigit:]]{32}.mp4|^null$#ui'],
            'video_two' => [4, 36 , '#^[[:xdigit:]]{32}.mkv$|^[[:xdigit:]]{32}.mp4|^null$#ui'],
            'video_three' => [4, 36 , '#^[[:xdigit:]]{32}.mkv$|^[[:xdigit:]]{32}.mp4|^null$#ui'],
            'video_four' => [4, 36 , '#^[[:xdigit:]]{32}.mkv$|^[[:xdigit:]]{32}.mp4|^null$#ui'],
            'video_five' => [4, 36 , '#^[[:xdigit:]]{32}.mkv$|^[[:xdigit:]]{32}.mp4|^null$#ui'],

            'user_id' => [1, 3, '#^[0-9]{1,3}$#ui']

        ];
    }


    /**
     * @return array
     */
    static public function aquariumMenu(): array {

        $aquariumMenu = [];

        $links = Routes::routingTable();

        foreach ($links as $key => $link) {
            if (preg_match('#^(aquarium@)([[:upper:]]{0,1})#ui', $link[0]) === 1) {
                if(!empty($link[3])) {
                    $aquariumMenu[$link[3]] = $key;
                }
            }

        }

        $menuItem = array_key_first($aquariumMenu);
        $page = array_shift($aquariumMenu);
        $aquariumFirst[$menuItem] = $page;
        return compact('aquariumFirst', 'aquariumMenu');
    }



}