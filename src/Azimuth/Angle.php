<?php declare(strict_types=1);

namespace Janfish\LBS\Azimuth;

use Janfish\LBS\Util\Math;
use Janfish\LBS\Constant\Math as MathConstant;

/**
 * 方位角(从某点的指北方向线起，依顺时针方向到目标方向线之间的水平夹角)
 *
 * https://baike.baidu.com/item/%E6%96%B9%E4%BD%8D%E8%A7%92/493239?fr=aladdin#4
 * Author:Robert
 *
 * Class Angle
 * @package Janfish\LBS\Azimuth
 */
class Angle
{

    /**
     * 方位角度数
     * @param float $lng1
     * @param float $lat1
     * @param float $lng2
     * @param float $lat2
     * @return float
     */
    public function getAngle(float $lng1, float $lat1, float $lng2, float $lat2): float
    {
        $lat1 = Math::rad2deg($lat1);
        $lat2 = Math::rad2deg($lat2);
        $lng1 = Math::rad2deg($lng1);
        $lng2 = Math::rad2deg($lng2);
        $angle = sin($lat1) * sin($lat2) + cos($lat1)
            * cos($lat2) * cos($lng2 - $lng1);
        $angle = sqrt(1 - $angle * $angle);
        $angle = cos($lat2) * sin($lng2 - $lng1) / $angle;
        $angle = asin($angle) * 180 / MathConstant::PI;
        if (is_nan($angle)) {
            if ($lng1 < $lng2) {
                $angle = 90.0;
            } else {
                $angle = 270.0;
            }
            return $angle;
        }
        if (($lat1 < $lat2) && ($lng1 <= $lng2)) {
            $angle = $lng1 == $lng2 ? 0 : $angle;
        } elseif (($lat1 >= $lat2) && ($lng1 < $lng2)) {
            $angle = 180 - $angle;
        } elseif (($lat1 > $lat2) && ($lng1 >= $lng2)) {
            $angle = abs($angle) + 180;
        } else {
            $angle = $lat1 == $lat2 ? $angle : 360 - abs($angle);
        }
        return $angle;
    }


}