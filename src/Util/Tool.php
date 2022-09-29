<?php declare(strict_types=1);

namespace Janfish\LBS\Util;


use Janfish\LBS\Constants\Earth;

/**
 * Author:Robert
 *
 * Class Tool
 * @package Janfish\LBS\Util
 */
class Tool
{

    /**
     * 生成指定范围的坐标
     * @param string $stander
     * @param int $decimal
     * @return array
     */
    public static function generateCoordinate(string $stander = Earth::WGC84_COORDINATE_STANDER, int $decimal = 6): array
    {
        $range = Earth::PRC_WGC84_COORDINATE_RANGE[$stander] ?: [
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