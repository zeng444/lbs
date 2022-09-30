<?php declare(strict_types=1);

namespace Janfish\LBS\Transform;

interface TransformInterface
{

    public function transform(float $lng, float $lat): array;

}