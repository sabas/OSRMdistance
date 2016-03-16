Instructions from OSRM wiki.

COMPILING

From terminal, download first sources

```
https://github.com/Project-OSRM/osrm-backend.git
```

Download required dependencies (Ubuntu and derivatives)

https://github.com/DennisOSRM/Project-OSRM/wiki/Building-on-Ubuntu

Then compile issuing following commands one at a time

```
cd osrm-backend
mkdir -p build
cd build
cmake ..
make
```


QUICKSTART

Before processing add a symbolic link to the routing profile

```
ln -s ../profiles/car.lua profile.lua
```
Name the file as xxx.osm.pbf
```
./osrm-extract sardegna.osm.pbf
```
(on an Intel i5 roughly 30 sec per 15 MB file)

```
./osrm-contract sardegna.osrm
```
(50 sec)

If you run through browser, remember to change the max_execution_time in php.ini if you're going to process long lists of locations.

Launch the server in a seperate terminal 

```
./osrm-routed sardegna.osrm
```

Now launch the script as per README.md file
