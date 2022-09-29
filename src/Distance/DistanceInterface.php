<?php declare(strict_types=1);


namespace Janfish\LBS\Distance;

interface DistanceInterface
{
    /**
     * @param float $lng1
     * @param float $lat1
     * @param float $lng2
     * @param float $lat2
     * @return float
     */
    public function getDistance(float $lng1, float $lat1, float $lng2, float $lat2): float;
}