OSRMdistance
============

Generate distance tables via a local OSRM ( http://project-osrm.org/ ) server.

Usage
-----

Input must be a csv in the format (first row is the header)

```
node;lat;lon
```

Output is a csv in the format (included in first row)

```
from;to;status;distance;time
```
