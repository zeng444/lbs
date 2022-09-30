<?php declare(strict_types=1);

namespace Janfish\LBS\Geohash;

use Janfish\LBS\Exception\LBSException;

/**
 * Author:Robert
 * https://blog.csdn.net/usher_ou/article/details/122716877
 *
 * Class hash
 * @package Janfish\LBS\Geo
 */
class Encode
{

    private $lngBinary;

    private $latBinary;

    private $len = 6;

    private const MAX_HASH_LENGTH = 22;

    private const GROUP_LEN = 5;

    private const BASE32_DICT = '0123456789bcdefghjkmnpqrstuvwxyz';

    /**
     * @param array $options
     * @throws LBSException
     */
    public function __construct(array $options = [])
    {
        if (isset($options['len'])) {
            $this->setLength($options['len']);
        }
    }

    /**
     * @param int $len
     * @return void
     * @throws LBSException
     */
    public function setLength(int $len)
    {
        if ($len > self::MAX_HASH_LENGTH) {
            throw new LBSException('geo hash length is maxed');
        }
        $this->len = $len;
    }

    /**
     * 第一步取得分组和二进制
     * 第二步取得Hash码
     * @param float $lng
     * @param float $lat
     * @return string
     */
    public function encode(float $lng, float $lat): string
    {
        return $this->getHash($this->getBinary($lng, $lat));
    }


    /**
     * @param string $string
     * @return string
     */
    public function base32encode(string $string): string
    {
        return self::BASE32_DICT[bindec($string)];
    }


    /**
     * @param string $binary
     * @return string
     */
    private function getHash(string $binary): string
    {
        $hash = '';
        for ($i = 0; $i < strlen($binary); $i += self::GROUP_LEN) {
            $hash .= $this->base32encode(substr($binary, $i, self::GROUP_LEN));
        }
        return $hash;
    }


    /**
     * @param float $lng
     * @param float $lat
     * @return string
     */
    private function getBinary(float $lng, float $lat): string
    {
        $this->lngBinary = $this->groupArea($lng, -180, 180);
        $this->latBinary = $this->groupArea($lat, -90, 90);
        $hash = '';
        for ($index = 0; $index < strlen($this->lngBinary); $index++) {
            $hash .= $this->lngBinary[$index] . $this->latBinary [$index];
        }
        return $hash;
    }

    /**
     * @param float $number
     * @param float $min
     * @param float $max
     * @return string
     */
    private function groupArea(float $number, float $min, float $max): string
    {
        $hashBin = '';
        $area = [$min, $max];
        $len = self::GROUP_LEN * ceil($this->len / 2);
        while (strlen($hashBin) < $len) {
            $mid = ($area[0] + $area[1]) / 2;
            if ($number > $mid) {
                $hashBin .= '1';
                $area = [$mid, $area[1]];
            } else {
                $hashBin .= '0';
                $area = [$area[0], $mid];
            }
        }
        return $hashBin;
    }

}