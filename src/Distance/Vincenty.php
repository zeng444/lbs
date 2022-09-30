<?php declare(strict_types=1);

namespace Janfish\LBS\Distance;

use Janfish\LBS\Constant\Earth;
use Janfish\LBS\Util\Math;
use Janfish\LBS\Constant\Math as MathConstant;

/**
 * Author:Robert
 *
 * Class Vincenty
 * @package Janfish\LBS\Distance
 */
class Vincenty implements DistanceInterface
{

    /**
     * @param float $lng1
     * @param float $lat1
     * @param float $lng2
     * @param float $lat2
     * @return float
     */
    public function getDistance(float $lng1, float $lat1, float $lng2, float $lat2): float
    {
        $L = Math::rad2deg($lng1 - $lng2);
        $U1 = atan((1 - Earth::EARTH_OBLATENESS) * tan(Math::rad2deg($lat1)));
        $U2 = atan((1 - Earth::EARTH_OBLATENESS) * tan(Math::rad2deg($lat2)));
        $sinU1 = sin($U1);
        $cosU1 = cos($U1);
        $sinU2 = sin($U2);
        $cosU2 = cos($U2);
        $lambda = $L;
        $lambdaP = MathConstant::PI;
        $cosSqAlpha = 0;
        $sinSigma = 0;
        $cos2SigmaM = 0;
        $cosSigma = 0;
        $sigma = 0;
        $circleCount = 40;
        //迭代循环
        while (abs($lambda - $lambdaP) > 1e-12 && --$circleCount > 0) {
            $sinLambda = sin($lambda);
            $cosLambda = cos($lambda);
            $sinSigma = sqrt(($cosU2 * $sinLambda) * ($cosU2 * $sinLambda) +
                ($cosU1 * $sinU2 - $sinU1 * $cosU2 * $cosLambda) * ($cosU1 * $sinU2 - $sinU1 * $cosU2 * $cosLambda));
            if ($sinSigma == 0) {
                return 0;  // co-incident points
            }
            $cosSigma = $sinU1 * $sinU2 + $cosU1 * $cosU2 * $cosLambda;
            $sigma = atan2($sinSigma, $cosSigma);
            $alpha = asin($cosU1 * $cosU2 * $sinLambda / $sinSigma);
            $cosSqAlpha = cos($alpha) * cos($alpha);
            $cos2SigmaM = $cosSigma - 2 * $sinU1 * $sinU2 / $cosSqAlpha;
            $C = Earth::EARTH_OBLATENESS / 16 * $cosSqAlpha * (4 + Earth::EARTH_OBLATENESS * (4 - 3 * $cosSqAlpha));
            $lambdaP = $lambda;
            $lambda = $L + (1 - $C) * Earth::EARTH_OBLATENESS * sin($alpha) *
                ($sigma + $C * $sinSigma * ($cos2SigmaM + $C * $cosSigma * (-1 + 2 * $cos2SigmaM * $cos2SigmaM)));
        }
        if ($circleCount == 0) {
            return 0;  // formula failed to converge
        }
        $uSq = $cosSqAlpha * (Earth::EARTH_RADIUS * Earth::EARTH_RADIUS - Earth::EARTH_SHORT_RADIUS * Earth::EARTH_SHORT_RADIUS) / (Earth::EARTH_SHORT_RADIUS * Earth::EARTH_SHORT_RADIUS);
        $A = 1 + $uSq / 16384 * (4096 + $uSq * (-768 + $uSq * (320 - 175 * $uSq)));
        $B = $uSq / 1024 * (256 + $uSq * (-128 + $uSq * (74 - 47 * $uSq)));
        $deltaSigma = $B * $sinSigma * ($cos2SigmaM + $B / 4 * ($cosSigma * (-1 + 2 * $cos2SigmaM * $cos2SigmaM) -
                    $B / 6 * $cos2SigmaM * (-3 + 4 * $sinSigma * $sinSigma) * (-3 + 4 * $cos2SigmaM * $cos2SigmaM)));

        return Earth::EARTH_SHORT_RADIUS * $A * ($sigma - $deltaSigma);


    }


}