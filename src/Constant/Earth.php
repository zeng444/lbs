<?php declare(strict_types=1);

namespace Janfish\LBS\Constant;

class Earth
{

    /**
     * 地球赤道半径，长半径
     */
    public const EARTH_RADIUS = 6378137.0;  // 老版克拉索夫斯基椭球测量值6378245

    /**
     *地球赤道半径，短半径
     */
    public const EARTH_SHORT_RADIUS = 6356752.314245; // 老版克拉索夫斯基椭球测量值6356863

    /**
     * 地球扁率 1/298.257223563
     */
    public const EARTH_OBLATENESS = 0.0033528106647474805;

    /**
     * 大地坐标系
     */
    public const WGS84_COORDINATE_STANDER = 'WGS84';

    /**
     * 国测局02坐标系
     */
    public const GCJ02_COORDINATE_STANDER = 'GCJ02';


    /**
     * 第一偏心率
     */
    public const EE = 0.00669342162296594323;

    /**
     *
     */
    public const PRC_WGS84_COORDINATE_RANGE = [
        self::WGS84_COORDINATE_STANDER => [
            'lng' => [73.66, 135.05],
            'lat' => [3.86, 53.55],
        ]
    ];

}