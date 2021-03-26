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