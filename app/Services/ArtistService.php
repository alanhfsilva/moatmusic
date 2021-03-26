<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ArtistService
{
    const URL = "https://moat.ai/api/task/";
    const HEADERS = [
        'Basic' => 'ZGV2ZWxvcGVyOlpHVjJaV3h2Y0dWeQ=='
    ];

    public static $list;

    /**
     * Call API for artist list.
     *
     * @return \Illuminate\Support\Facades\Http
     */
    public static function getList()
    {
        static::$list = Http::withHeaders(self::HEADERS)->get(self::URL, []);
        return new static;
    }

    /**
     * Get specific artist for given $id in a $list
     *
     * @return array
     */
    public static function getArtist($id)
    {
        $list = static::toArray();
        foreach($list as $key => $value) 
        {
            if($value['id'] == $id) {
                return $value;
            }
        }
        return false;
    }

    /**
     * Get $list in array format
     */
    public static function toArray()
    {
        $list = json_decode(static::$list->body(),true);
        $arr = [];
        foreach($list as $key => $value) 
        {
            $arr[] = $value[0];
        }
        usort($arr,function ($a,$b) {
            return strcmp($a['name'],$b['name']);
        });
        return $arr;
    }
    
    /**
     * Get $list value in json format
     */
    public static function toJson()
    {
        return json_encode(static::toArray());
    }
}