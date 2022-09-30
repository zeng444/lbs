### LBS

#### 生成测试坐标

```
list($lng, $lat) = Tool::generateCoordinate();
list($lng2, $lat2) = Tool::generateCoordinate();
```

#### 距离

- Vincenty算法

```
use Janfish\LBS\LBS;
use Janfish\LBS\Constant\Math;

LBS::getDistance($lng, $lat, $lng2, $lat2, Math::VINCENTY_DISTANCE);
```

- Haversine算法

```
use Janfish\LBS\LBS;
use Janfish\LBS\Constant\Math;

LBS::getDistance($lng, $lat, $lng2, $lat2, Math::HAVERSINE_DISTANCE);
```

#### 方位角

```
use Janfish\LBS\LBS;

LBS::getAngle($lng, $lat, $lng2, $lat2);
```

#### 坐标Geohash

```
use Janfish\LBS\LBS;

LBS::getGeoHash($lng, $lat, 16);
```

#### 坐标Geohash

- 周边区域hash

```
use Janfish\LBS\LBS;

(LBS::getGeoHashNeighbor($geoHash))->getSurround();
```

- 指定方位区域hash

```
use Janfish\LBS\LBS;

(LBS::getGeoHashNeighbor($hash))->getNouth();
(LBS::getGeoHashNeighbor($hash))->getEast();
(LBS::getGeoHashNeighbor($hash))->getWest();
(LBS::getGeoHashNeighbor($hash))->getSouth();

(LBS::getGeoHashNeighbor($hash))->getNorthEast();
(LBS::getGeoHashNeighbor($hash))->getNorthWest();
(LBS::getGeoHashNeighbor($hash))->getSouthEast();
(LBS::getGeoHashNeighbor($hash))->getSouthWest();
```