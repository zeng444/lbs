<?php declare(strict_types=1);

namespace Janfish\LBS\Constants;

class Earth
{

    /**
     * 地球赤道半径，长半径
     */
    public const EARTH_RADIUS = 6378137.0;


    /**
     *地球赤道半径，短半径
     */
    public const EARTH_SHORT_RADIUS = 6356752.314245;

    /**
     * 地球扁率 1/298.257223563
     */
    public const EARTH_OBLATENESS = 0.0033528106647474805;

    /**
     * 大地坐标系
     */
    public const WGC84_COORDINATE_STANDER = 'WGC84';

    /**
     *
     */
    public const PRC_WGC84_COORDINATE_RANGE = [
        self::WGC84_COORDINATE_STANDER => [
            'lng' => [73.66, 135.05],
            'lat' => [3.86, 53.55],
        ]
    ];

}