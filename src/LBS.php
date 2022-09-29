<?php declare(strict_types=1);

namespace Janfish\LBS;

use Janfish\LBS\Azimuth\Angle;
use Janfish\LBS\Constants\Math;
use Janfish\LBS\Exception\LBSException;

/**
 * Author:Robert
 *
 * Class LBS
 * @package
 */
class LBS
{

    public const DISTANCE_ALGO_CLASSES = [
        Math::HAVERSINE_DISTANCE => '\Janfish\LBS\Distance\Haversine',
        Math::VINCENTY_DISTANCE => '\Janfish\LBS\Distance\Vincenty',
    ];

    /**
     * 计算两点距离
     * @param float $lng1
     * @param float $lat1
     * @param float $lng2
     * @param float $lat2
     * @param string $algo
     * @return float
     * @throws LBSException
     */
    public static function getDistance(float $lng1, float $lat1, float $lng2, float $lat2, string $algo = Math::HAVERSINE_DISTANCE): float
    {
        if (!isset(self::DISTANCE_ALGO_CLASSES[$algo])) {
            throw new LBSException('lbs distance algo not exist');
        }
        $className = self::DISTANCE_ALGO_CLASSES[$algo];
        return (new $className)->getDistance($lng1, $lat1, $lng2, $lat2);
    }


    /**
     * 方位角
     * @param float $lng1
     * @param float $lat1
     * @param float $lng2
     * @param float $lat2
     * @return float
     */
    public static function getAngle(float $lng1, float $lat1, float $lng2, float $lat2): float
    {
        return (new Angle())->getAngle($lng1, $lat1, $lng2, $lat2);
    }


}