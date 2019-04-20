<script>

    import mapboxgl from 'mapbox-gl';

    export default {

        mounted() {

            mapboxgl.accessToken = "pk.eyJ1IjoibWljaGFlbC1uaWNvbGFlcyIsImEiOiJjanVvZzlyd2MxZmpxNDRsOHR3dXk0YmJpIn0._X_UFrdUNI8xuQiJtZz71A";

            /* Map: This represents the map on the page. */
            let map = new mapboxgl.Map({
                container: "map",
                style: "mapbox://styles/mapbox/streets-v11",
                zoom: 16,
                center: [4.8605, 50.4664]
            });

            let this_ref = this

            map.on("load", function () {

                function createGeoJSONCircle(center, radiusInKm, points) {
                    if (!points) points = 64;

                    var coords = {
                        latitude: center[1],
                        longitude: center[0]
                    };

                    var km = radiusInKm;

                    var ret = [];
                    var distanceX = km / (111.320 * Math.cos(coords.latitude * Math.PI / 180));
                    var distanceY = km / 110.574;

                    var theta, x, y;
                    for (var i = 0; i < points; i++) {
                        theta = (i / points) * (2 * Math.PI);
                        x = distanceX * Math.cos(theta);
                        y = distanceY * Math.sin(theta);

                        ret.push([coords.longitude + x, coords.latitude + y]);
                    }
                    ret.push(ret[0]);

                    return {
                        "type": "geojson",
                        "data": {
                            "type": "FeatureCollection",
                            "features": [{
                                "type": "Feature",
                                "geometry": {
                                    "type": "Polygon",
                                    "coordinates": [ret]
                                }
                            }]
                        }
                    };
                }

                function add_marker(color, radius, latitude, longitude, radiusColor, toggleRadius) {
                    var position = {lng: longitude, lat: latitude};
                    var marker = new mapboxgl.Marker({color: color})
                        .setLngLat(position)
                        .addTo(map);
                    if (toggleRadius) {
                        map.addSource("polygon", createGeoJSONCircle([position.lng, position.lat], radius));

                        map.addLayer({
                            "id": "polygon",
                            "type": "fill",
                            "source": "polygon",
                            "layout": {},
                            "paint": {
                                "fill-color": radiusColor,
                                "fill-opacity": 0.2
                            }
                        });
                    }
                }


                /*
                * color : hexa code
                *lat and long : format example : 50.4555   4.5555
                *radius in km
                *radiusColor in plain letters : 'blue', 'red', 'yellow', ...
                *toggleRadius : boolean, true if you want the circle
                */


                //user's starting position
                add_marker('#FF0000', 0.05, 50.4664, 4.8605, 'purple', false);

                //mock bar promo
                add_marker('#0000FF', 0.05, 50.4661, 4.8609, 'blue', true);

            });

        }

    }

</script>

<style>
    body { margin:0; padding:0; }
    #map { position:absolute; top:0; bottom:0; width:100%; }
</style>
