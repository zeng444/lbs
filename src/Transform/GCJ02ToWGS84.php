<?php declare(strict_types=1);

namespace Janfish\LBS\Transform;

use Janfish\LBS\Constant\Earth;
use Janfish\LBS\Constant\Math;

/**
 * Author:Robert
 *
 * Class GCJ02ToWGS84
 * @package Janfish\LBS\Transform
 */
class GCJ02ToWGS84 implements TransformInterface
{

    /**
     * @param float $lng
     * @param float $lat
     * @return array
     */
    public function transform(float $lng, float $lat): array
    {
        $dlat = self::transformlat($lng - 105.0, $lat - 35.0);
        $dlng = self::transformlng($lng - 105.0, $lat - 35.0);
        $radlat = $lat / 180.0 * Math::PI;
        $magic = sin($radlat);
        $magic = 1 - Earth::EE * $magic * $magic;
        $sqrtmagic = sqrt($magic);
        $dlat = ($dlat * 180.0) / ((Earth::EARTH_RADIUS * (1 - Earth::EE)) / ($magic * $sqrtmagic) * Math::PI);
        $dlng = ($dlng * 180.0) / (Earth::EARTH_RADIUS / $sqrtmagic * cos($radlat) * Math::PI);
        $mglat = $lat + $dlat;
        $mglng = $lng + $dlng;
        return [$lng * 2 - $mglng, $lat * 2 - $mglat];
    }


    /**
     * @param $lng
     * @param $lat
     * @return float|int
     */
    private function transformlat($lng, $lat): float
    {
        $ret = -100.0 + 2.0 * $lng + 3.0 * $lat + 0.2 * $lat * $lat + 0.1 * $lng * $lat + 0.2 * sqrt(abs($lng));
        $ret += (20.0 * sin(6.0 * $lng * Math::PI) + 20.0 * sin(2.0 * $lng * Math::PI)) * 2.0 / 3.0;
        $ret += (20.0 * sin($lat * Math::PI) + 40.0 * sin($lat / 3.0 * Math::PI)) * 2.0 / 3.0;
        $ret += (160.0 * sin($lat / 12.0 * Math::PI) + 320 * sin($lat * Math::PI / 30.0)) * 2.0 / 3.0;
        return $ret;
    }

    /**
     * @param $lng
     * @param $lat
     * @return float|int
     */
    private function transformlng($lng, $lat): float
    {
        $ret = 300.0 + $lng + 2.0 * $lat + 0.1 * $lng * $lng + 0.1 * $lng * $lat + 0.1 * sqrt(abs($lng));
        $ret += (20.0 * sin(6.0 * $lng * Math::PI) + 20.0 * sin(2.0 * $lng * Math::PI)) * 2.0 / 3.0;
        $ret += (20.0 * sin($lng * Math::PI) + 40.0 * sin($lng / 3.0 * Math::PI)) * 2.0 / 3.0;
        $ret += (150.0 * sin($lng / 12.0 * Math::PI) + 300.0 * sin($lng / 30.0 * Math::PI)) * 2.0 / 3.0;
        return $ret;
    }
}