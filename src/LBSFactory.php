<?php declare(strict_types=1);

namespace Janfish\LBS;

use Janfish\LBS\Azimuth\Angle;
use Janfish\LBS\Constant\Earth;
use Janfish\LBS\Constant\Math;
use Janfish\LBS\Exception\LBSException;
use Janfish\LBS\Geohash\Encode;
use Janfish\LBS\Geohash\Neighbor;

/**
 * Author:Robert
 *
 * Class LBSFactory
 * @package
 */
class LBSFactory
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

    /**
     * GeoHash
     * @param float $lng
     * @param float $lat
     * @param int $len
     * @return string
     * @throws LBSException
     */
    public static function getGeoHash(float $lng, float $lat, int $len = 12): string
    {
        return (new Encode(['len' => $len]))->encode($lng, $lat);
    }

    /**
     * 周边区域计算
     * @param string $hash
     * @return Neighbor
     */
    public static function getGeoHashNeighbor(string $hash): Neighbor
    {
        return new Neighbor($hash);
    }

    /**
     * @param float $lng
     * @param float $lat
     * @param string $from
     * @param string $to
     * @return array
     * @throws LBSException
     */
    public function transform(float $lng, float $lat, string $from = Earth::WGS84_COORDINATE_STANDER, string $to = Earth::GCJ02_COORDINATE_STANDER): array
    {
        $class = sprintf('\Janfish\LBS\Transform\%sTo%s', $from, $to);
        if (!class_exists($class)) {
            throw new LBSException('transform class not exist');
        }
        return (new $class)->transform($lng, $lat);
    }

}