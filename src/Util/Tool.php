<?php declare(strict_types=1);

namespace Janfish\LBS\Util;


use Janfish\LBS\Constant\Earth;

/**
 * Author:Robert
 *
 * Class Tool
 * @package Janfish\LBS\Util
 */
class Tool
{

    /**
     * @param int $decimal
     * @param string $stander
     * @return array
     */
    public static function generateCoordinate(int $decimal = 6,string $stander = Earth::WGS84_COORDINATE_STANDER): array
    {
        $range = Earth::PRC_WGS84_COORDINATE_RANGE[$stander] ?: [
            'lng' => [-180, 180],
            'lat' => [-90, 90],
        ];
        $denominator = sprintf('1%s', str_repeat('0', $decimal));
        list($minLng, $maxLng) = array_map(static function ($item) use ($denominator) {
            return (int)bcmul((string)$item, $denominator);
        }, $range['lng']);
        list($minLat, $maxLat) = array_map(static function ($item) use ($denominator) {
            return (int)bcmul((string)$item, $denominator);
        }, $range['lat']);
        return array_map(static function ($item) use ($denominator, $decimal) {
            return (float)bcdiv((string)$item, $denominator, $decimal);
        }, [rand($minLng, $maxLng), rand($minLat, $maxLat)]);
    }


}