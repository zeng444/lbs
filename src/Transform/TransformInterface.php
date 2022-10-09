<?php declare(strict_types=1);

namespace Janfish\LBS\Transform;

/**
 *
 */
interface TransformInterface
{

    /**
     * @param float $lng
     * @param float $lat
     * @return array
     */
    public function transform(float $lng, float $lat): array;

}