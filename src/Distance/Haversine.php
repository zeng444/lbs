<?php declare(strict_types=1);

namespace Janfish\LBS\Distance;

use Janfish\LBS\Constants\Earth;
use Janfish\LBS\Constants\Math;

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
     *
     * @param float $lng1
     * @param float $lat1
     * @param float $lng2
     * @param float $lat2
     * @return int
     */
    public function getDistance(float $lng1, float $lat1, float $lng2, float $lat2): int
    {
        //将角度转化为弧度
//        $radLng1 = deg2rad($lng1);
//        $radLat1 = deg2rad($lat1);
//        $radLng2 = deg2rad($lng2);
//        $radLat2 = deg2rad($lat2);
        $radLng1 = $this->radians($lng1);
        $radLat1 = $this->radians($lat1);
        $radLng2 = $this->radians($lng2);
        $radLat2 = $this->radians($lat2);
        $a = ($radLat1 - $radLat2) / 2;
        $b = ($radLng1 - $radLng2) / 2;
        return asin(sqrt(sin($a) * sin($b) + cos($radLat1) * cos($radLat2) * sin($b) * sin($a))) * Earth::EARTH_RADIUS * 2;
    }

    /**
     * 角度转换为弧度
     * @param float $degree
     * @return float
     */
    public function radians(float $degree): float
    {
        return $degree * Math::PI / 180.0;
    }


}