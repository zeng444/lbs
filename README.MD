### LBS

#### Generate coordinate

```
list($lng, $lat) = Tool::generateCoordinate();
list($lng2, $lat2) = Tool::generateCoordinate();
```

#### Distance

- Vincenty

```
use Janfish\LBS\LBS;
use Janfish\LBS\Constant\Math;

LBS::getDistance($lng, $lat, $lng2, $lat2, Math::VINCENTY_DISTANCE);
```

- Haversine

```
use Janfish\LBS\LBS;
use Janfish\LBS\Constant\Math;

LBS::getDistance($lng, $lat, $lng2, $lat2, Math::HAVERSINE_DISTANCE);
```

#### Angle

```
use Janfish\LBS\LBS;

LBS::getAngle($lng, $lat, $lng2, $lat2);
```

#### Geohash

```
use Janfish\LBS\LBS;

LBS::getGeoHash($lng, $lat, 16);
```

#### Geohash neighbors

- neighbors

```
use Janfish\LBS\LBS;

(LBS::getGeoHashNeighbor($geoHash))->getSurround();
```

- Specified direction

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