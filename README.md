OSRMdistance
============

Generate distance tables via a local OSRM ( http://project-osrm.org/ ) server.

Checkout demo results on http://sabas.github.io/OSRMdistance/

Usage
-----

See QUICKSTART.md for brief notes on compilation and configuration of OSRM server.

Input must be a csv with this header included

```
node;lat;lon
```

Output is a csv in the format

```
from;to;status;distance;time
```

Script must be executed via command line while osrm-routed is running (assumed at localhost:5000).


OSRMdistance: pass the input file name as first argument and the output file name as second. Optionally pass TRUE as third parameter to save the route geometry as a column in the output

```
php OSRMdistance.php in.csv out.csv (TRUE)
```

OSRMsinglepoint.php accepts additional parameters: after input and output file, write "FROM" or "TO" then a node string in the input format. The computation takes all the nodes in input file and a single node: you choose as the third parameter FROM if the computation is from the node to the others,  TO if the computation is from the others to the node.

```
php osrmsinglepoint.php in.csv out.csv FROM "node;lat;lon"
```

OSRMnearest.php tries to transform the source csv to the nearest points in the routing graph.

```
php OSRMnearest.php in.csv out.csv
```

OSRMlegs.php gets as input node couples (header must be node1;lat1;lon1;node2;lat2;lon2) and append the result
```
php OSRMlegs.php in.csv out.csv
```

Input file
-------

The ```node``` column is a simple label: so it could be a number or a string.

OSRMextractData.php takes an osm file (created by JOSM for example) and extracts the triples for each node in the file

```
php OSRMextractData.php in.osm out.csv
```

Example: we need to compute a distance table between administrative centres in a region, we can use Overpass Turbo and this query

```
[out:csv("name",::lat,::lon;true)][timeout:30];
{{geocodeArea:Sardinia}}->.searchArea;
(rel(area.searchArea)->.relations);
(node(r.relations:"admin_centre"));
out meta;
```

In the resulting file we replace the tabs with semicolons, and we add the header in the first row.


