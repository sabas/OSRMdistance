Instructions from OSRM wiki.

COMPILING

From terminal, download first sources

```
git clone https://github.com/DennisOSRM/Project-OSRM.git
```

Download required dependencies (Ubuntu and derivatives)

https://github.com/DennisOSRM/Project-OSRM/wiki/Building-on-Ubuntu

Then compile issuing following commands one at a time (make -j 2 means you'll compile using 2 cores)

```
cd Project-OSRM
mkdir -p build
cd build
cmake ..
make -j 2
```


QUICKSTART

Before processing add a symbolic link to the routing profile

```
ln -s ../profiles/car.lua profile.lua
```

```
./osrm-extract sardegna.osm.pbf
```
(on an Intel i5 roughly 30 sec per 15 MB file)

```
./osrm-prepare sardegna.osrm
```
(50 sec)

If you run through browser, remember to change the max_execution_time in php.ini if you're going to process long lists of locations.

Write the configuration file and save it as server.ini alongside the executables.

```
Threads = 8
IP = 0.0.0.0
Port = 5000

hsgrData=sardegna.osrm.hsgr
nodesData=sardegna.osrm.nodes
edgesData=sardegna.osrm.edges
ramIndex=sardegna.osrm.ramIndex
fileIndex=sardegna.osrm.fileIndex
namesData=sardegna.osrm.names
timestamp=sardegna.osrm.timestamp
```

Launch the server in a seperate terminal 

```
./osrm-routed
```

Now launch the script as per README.md file
