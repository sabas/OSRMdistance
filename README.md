OSRMdistance
============

Generate distance tables via a local OSRM ( http://project-osrm.org/ ) server.

Checkout demo results on http://sabas.github.io/OSRMdistance/

Usage
-----

See QUICKSTART.md for brief notes on compilation and configuration of OSRM server, which is required to be running before launching the script.

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
localhost/osrmdistance.php?in=in.csv&out=out.csv
```

Via command line, pass the input name as first argument and output name ad second.

```
php osrmdistance.php in.csv out.csv
```

osrmsinglepoint.php accepts a third parameter, formed as a row of the input csv, and calculates distance between the node described by this third input and those in the csv source.

```
php osrmsinglepoint.php in.csv out.csv "node;lat;lon"
```

osrmnearest.php tries to transform the source csv to the nearest points in the routing graph.

```
php osrmnearest.php in.csv out.csv
```

extractData.php takes an osm file and extracts the triples for each node in the file (for instance you can extract a set of nodes via overpass-turbo, load the query in JOSM and from there save the osm file)

```
php extractData.php in.osm out.csv
```
