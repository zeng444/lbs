<?php declare(strict_types=1);

namespace Janfish\LBS\Distance;

use Janfish\LBS\Constant\Earth;

use Janfish\LBS\Util\Math;

/**
 * Author:Robert
 *
 * Class Haversine
 * @description https://zh.wikipedia.org/wiki/%E5%8D%8A%E6%AD%A3%E7%9F%A2%E5%85%AC%E5%BC%8F
 * @package Janfish\LBS\Distance
 */
class Haversine implements DistanceInterface
{

    /**
     * 计算角度形成的弧之间的三角函数侧边
     * @param float $lng1
     * @param float $lat1
     * @param float $lng2
     * @param float $lat2
     * @return float
     */
    public function getDistance(float $lng1, float $lat1, float $lng2, float $lat2): float
    {
        $radLng1 = Math::rad2deg($lng1);
        $radLat1 = Math::rad2deg($lat1);
        $radLng2 = Math::rad2deg($lng2);
        $radLat2 = Math::rad2deg($lat2);
        $a = ($radLat1 - $radLat2) / 2; //2点经度角度差
        $b = ($radLng1 - $radLng2) / 2;//2点纬度角度差
        //三角边长
        return asin(sqrt(sin($a) * sin($a) + cos($radLat1) * cos($radLat2) * sin($b) * sin($b))) * Earth::EARTH_RADIUS * 2;
    }


}