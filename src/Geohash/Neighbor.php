<?php declare(strict_types=1);

namespace Janfish\LBS\Geohash;

/**
 * Author:Robert
 *
 * Class Neighbor
 * https://github.com/lyokato/libgeohash/blob/master/src/geohash.c
 * @package Janfish\LBS\Geo
 */
class Neighbor
{


    private $hash;

    /**
     * BASE32编码
     * @var string
     */
    private const BASE32_DICT = "0123456789bcdefghjkmnpqrstuvwxyz";

    /**
     * 北方
     * @var
     */
    private $north;

    /**
     * 东边
     * @var
     */
    private $east;

    /**
     * 西边
     * @var
     */
    private $west;

    /**
     * 南边
     * @var
     */
    private $south;

    /**
     * 东北
     * @var
     */
    private $northEast;

    /**
     * 西北
     * @var
     */
    private $northWest;

    /**
     * 东南
     * @var
     */
    private $southEast;

    /**
     * 西南
     * @var
     */
    private $southWest;

    private const NORTH_DIRECTION = 'NORTH';
    private const EAST_DIRECTION = 'EAST';
    private const WEST_DIRECTION = 'WEST';
    private const SOUTH_DIRECTION = 'SOUTH';
    /**
     * 索引0和1对应偶数位和奇数位置速查表
     */
    private const BORDERS_TABLE = [
        self::NORTH_DIRECTION => [
            "prxz",
            "bcfguvyz"
        ],
        self::EAST_DIRECTION => [
            "bcfguvyz",
            "prxz"
        ],
        self::WEST_DIRECTION => [
            "0145hjnp",
            "028b",
        ],
        self::SOUTH_DIRECTION => [
            "028b",
            "0145hjnp"
        ],
    ];
    /**
     * 索引0和1对应偶数位和奇数位置速查表
     */
    private const NEIGHBORS_TABLE = [
        self::NORTH_DIRECTION => [
            "p0r21436x8zb9dcf5h7kjnmqesgutwvy",
            "bc01fg45238967deuvhjyznpkmstqrwx"
        ],
        self::EAST_DIRECTION => [
            "bc01fg45238967deuvhjyznpkmstqrwx",
            "p0r21436x8zb9dcf5h7kjnmqesgutwvy"
        ],
        self::WEST_DIRECTION => [
            "238967debc01fg45kmstqrwxuvhjyznp",
            "14365h7k9dcfesgujnmqp0r2twvyx8zb",
        ],
        self::SOUTH_DIRECTION => [
            "14365h7k9dcfesgujnmqp0r2twvyx8zb",
            "238967debc01fg45kmstqrwxuvhjyznp"
        ],
    ];

    /**
     * @param string $hash
     */
    public function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getNorth(): string
    {
        if (!$this->north) {
            $this->north = $this->calculateAdjacent($this->hash, self::NORTH_DIRECTION);
        }
        return $this->north;
    }

    /**
     * @return string
     */
    public function getEast(): string
    {
        if (!$this->east) {
            $this->east = $this->calculateAdjacent($this->hash, self::EAST_DIRECTION);
        }
        return $this->east;
    }

    /**
     * @return string
     */
    public function getWest(): string
    {
        if (!$this->west) {
            $this->west = $this->calculateAdjacent($this->hash, self::WEST_DIRECTION);
        }
        return $this->west;
    }

    /**
     * @return string
     */
    public function getSouth(): string
    {
        if (!$this->south) {
            $this->south = $this->calculateAdjacent($this->hash, self::SOUTH_DIRECTION);
        }
        return $this->south;
    }

    /**
     * @return string
     */
    public function getNorthEast(): string
    {
        if (!$this->northEast) {
            $this->northEast = $this->calculateAdjacent($this->getNorth(), self::EAST_DIRECTION);
        }
        return $this->northEast;
    }

    /**
     * @return string
     */
    public function getNorthWest(): string
    {
        if (!$this->northWest) {
            $this->northWest = $this->calculateAdjacent($this->getNorth(), self::WEST_DIRECTION);
        }
        return $this->northWest;
    }

    /**
     * @return string
     */
    public function getSouthEast(): string
    {
        if (!$this->southEast) {
            $this->southEast = $this->calculateAdjacent($this->getSouth(), self::EAST_DIRECTION);
        }
        return $this->southEast;
    }

    /**
     * @return string
     */
    public function getSouthWest(): string
    {
        if (!$this->southWest) {
            $this->southWest = $this->calculateAdjacent($this->getSouth(), self::WEST_DIRECTION);
        }
        return $this->southWest;
    }

    /**
     * @return array
     */
    public function getSurround(): array
    {
        return [
            $this->getNorth(),
            $this->getEast(),
            $this->getWest(),
            $this->getSouth(),
            $this->getNorthEast(),
            $this->getNorthWest(),
            $this->getSouthEast(),
            $this->getSouthWest(),
        ];
    }

    /**
     * @param string $hash
     * @param string $direction
     * @return string
     */
    private function calculateAdjacent(string $hash, string $direction): string
    {
        $hash = strtolower($hash);
        $lastChr = $hash[strlen($hash) - 1];
        $type = (strlen($hash) % 2) ? '1' : '0';
        $base = substr($hash, 0, strlen($hash) - 1);
        if (str_contains(self::BORDERS_TABLE[$direction][$type], $lastChr)) {
            $base = $this->calculateAdjacent($base, $direction);
        }
        return $base . self::BASE32_DICT[strpos(self::NEIGHBORS_TABLE[$direction][$type], $lastChr)];
    }


}