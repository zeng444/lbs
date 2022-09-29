<?php declare(strict_types=1);

namespace Janfish\LBS\Util;

use Janfish\LBS\Constants\Math as MathConstant;

/**
 * Author:Robert
 *
 * Class Math
 * @package Janfish\LBS\Geo
 */
class Math
{

    /**
     * 根据提供的角度值，将其转化为弧度
     * @param float $angle
     * @return float
     */
    public static function rad2deg(float $angle): float
    {
//        return rad2deg($angle);
        return $angle * MathConstant::PI / 180;
    }

    /**
     * @param float $degree
     * @return float
     */
    public static function deg2Rad(float $degree): float
    {
//        return deg2rad($degree);
        return $degree / 180 * MathConstant::PI;
//        return $angle * MathConstant::PI / 180;
    }

}