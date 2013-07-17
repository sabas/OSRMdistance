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

Script can be called both via browser and via command line. 
Obviously it's assumed you have OSRM up and running on localhost:5000 (DON'T USE project-osrm API, IT'S FORBIDDEN! Compiling OSRM, at least onto a Debian-based distro, it's straightforward)

Via browser accepts two GET parameters:
 * in: the csv in input (place it in the same folder)
 * out: csv name for the output
 
```
localhost/osrm.php?in=in.csv&out=out.csv
```

Via command line, pass the input name as first argument and output name ad second.

```
php osrm.php in.csv out.csv
```
