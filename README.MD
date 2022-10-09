### LBS

#### Generate coordinate

```

use Janfish\LBS\Util\Tool;

list($lng, $lat) = Tool::generateCoordinate();
list($lng2, $lat2) = Tool::generateCoordinate();
```

#### Distance

- Vincenty

```
use Janfish\LBS\LBSFactory;
use Janfish\LBS\Constant\Math;

LBSFactory::getDistance($lng, $lat, $lng2, $lat2, Math::VINCENTY_DISTANCE);
```

- Haversine

```
use Janfish\LBS\LBSFactory;
use Janfish\LBS\Constant\Math;

LBSFactory::getDistance($lng, $lat, $lng2, $lat2, Math::HAVERSINE_DISTANCE);
```

#### Angle

```
use Janfish\LBS\LBSFactory;

LBSFactory::getAngle($lng, $lat, $lng2, $lat2);
```
#### Transform


```
use Janfish\LBS\LBSFactory;
use Janfish\LBS\Constant\Earth;

$LBSFactory = new LBSFactory();
list($lng, $lat) = [103.980831, 30.584515];
list($lng, $lat) = $LBSFactory->transform($lng, $lat, Earth::WGS84_COORDINATE_STANDER, Earth::GCJ02_COORDINATE_STANDER);
list($lng, $lat) = $LBSFactory->transform($lng, $lat, Earth::GCJ02_COORDINATE_STANDER, Earth::WGS84_COORDINATE_STANDER);

```

#### Geohash

```
use Janfish\LBS\LBSFactory;

LBSFactory::getGeoHash($lng, $lat, 16);
```

#### Geohash neighbors

- neighbors

```
use Janfish\LBS\LBSFactory;

(LBSFactory::getGeoHashNeighbor($geoHash))->getSurround();
```

- Specified direction

```
use Janfish\LBS\LBSFactory;

(LBSFactory::getGeoHashNeighbor($hash))->getNouth();
(LBSFactory::getGeoHashNeighbor($hash))->getEast();
(LBSFactory::getGeoHashNeighbor($hash))->getWest();
(LBSFactory::getGeoHashNeighbor($hash))->getSouth();

(LBSFactory::getGeoHashNeighbor($hash))->getNorthEast();
(LBSFactory::getGeoHashNeighbor($hash))->getNorthWest();
(LBSFactory::getGeoHashNeighbor($hash))->getSouthEast();
(LBSFactory::getGeoHashNeighbor($hash))->getSouthWest();
```