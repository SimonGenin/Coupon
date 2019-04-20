<script>

    import mapboxgl from 'mapbox-gl';

    export default {

        data() {
            return {
                search_string: "",
				existing_tags = ["bar", "snack", "sandwicherie"];
				synonyms = new Map();
				synonyms.set("bière", "bar");
				synonyms.set("bières", "bar");
				synonyms.set("vin", "bar");
				synonyms.set("café", "bar");
				synonyms.set("hot-dog", "snack");
				synonyms.set("burger", "snack");
				synonyms.set("sandwich", "sandwicherie");
				synonyms.set("salade", "sandwicherie");
            }
        },

        methods: {

            process() {

				tags_output = new Array();
                this.search_string = "Je cherche à boire une bière et manger un burger";
				search_string.split(" ").forEach(function(val){
					if(existing_tags.includes(val)){
						tags_output.push(val);
					} else if(synonyms.has(val)){
							tags_output.push(synonyms.get(val));
					}
				});

            }

        },

        mounted() {

            mapboxgl.accessToken = "pk.eyJ1IjoibWljaGFlbC1uaWNvbGFlcyIsImEiOiJjanVvZzlyd2MxZmpxNDRsOHR3dXk0YmJpIn0._X_UFrdUNI8xuQiJtZz71A";

            /* Map: This represents the map on the page. */
            var map = new mapboxgl.Map({
                container: "map",
                style: "mapbox://styles/michael-nicolaes/cjuot53fa8jwa1ftiratf0jh0",
                zoom: 16,
                center: [4.8605, 50.4664]
            });

            var incrId = 1;

            var mapTimeId = new Map();

            map.on("load", function () {

                /*
                * color : hexa code
                *lat and long : format example : 50.4555   4.5555
                *radius in km
                *radiusColor in plain letters : 'blue', 'red', 'yellow', ...
                *toggleRadius : boolean, true if you want the circle
                */

                map.addControl(new mapboxgl.GeolocateControl({
                    positionOptions: {
                        enableHighAccuracy: true
                    },
                    trackUserLocation: true
                }));

                var scale = new mapboxgl.ScaleControl({
                    maxWidth: 80,
                    unit: 'metric'
                });
                map.addControl(scale);

                function create_self(radius, latitude, longitude, radiusColor, toggleRadius) { // ADD FUNCTION
                    let color = '#00F';
                    var position = {lng: longitude, lat: latitude};
                    var marker = new mapboxgl.Marker({color: color})
                        .setLngLat(position)
                        .addTo(map);
                    if (toggleRadius) {
                        map.addSource("self", createGeoJSONCircle([position.lng, position.lat], radius));
                        console.log(listImages()[0]);
                        map.addLayer({
                            "id": "self",
                            "type": "fill",
                            "source": marker,
                            "layout": {},
                            "paint": {
                                "fill-color": radiusColor,
                                "fill-opacity": 0.2
                            }
                        });
                    }
                    return position;
                }

                function add_marker(radius, latitude, longitude, toggleRadius, title, premiumTitle, description, distance, endTime) { // MODIFY PARAMETER
                    var position = {lng: longitude, lat: latitude};
                    let popup = create_popup(position, title, premiumTitle, description, distance, endTime); // ADD
                    if (popup === "finished") {
                        return;
                    }
                    let time = calculTimeLeft(endTime);
                    let colorRadius;
                    let color;
                    if (time > 45) {
                        colorRadius = "green";
                        color = "#00FF00";
                    } else if (time > 20) {
                        colorRadius = "yellow";
                        color = "#FF0";
                    } else {
                        colorRadius = "red";
                        color = "#F00";
                    }

                    new mapboxgl.Marker({color: color})
                        .setLngLat(position)
                        .setPopup(popup) // ADD
                        .addTo(map);

                    if (toggleRadius) {
                        let id = "polygon" + incrId;
                        map.addSource(id, createGeoJSONCircle([position.lng, position.lat], radius));

                        map.addLayer({
                            "id": id,
                            "type": "fill",
                            "source": id,
                            "layout": {},
                            "paint": {
                                "fill-color": colorRadius,
                                "fill-opacity": 0.2
                            }
                        });
                    }

                    incrId++;
                }

// ADD FUNCTION
                function create_popup(position, title, premiumTitle, description, distance, endTime) { // thème personalisé peut être marrant (pas le time mais voilà quoi)
                    let timeLeft = calculTimeLeft(endTime);
                    if (timeLeft === 0) {
                        return "finished";
                    }
                    var html = "<h1>" + title + "</h1><h3>" + description + "</h3><p>L'établissement se situe à " + distance + " mètres. <br> Le coupon sera encore valable " + timeLeft + " minutes !</p>"	// title or premium title
                    var popup = new mapboxgl.Popup({offset: 25})
                        .setHTML(html);
                    return popup;
                }

                function calculTimeLeft(endTime) { // ADD FUNCTION
                    var now = new Date(Date.now()).getTime();
                    var end = endTime.getTime();
                    var millis = end - now;
                    let result = Math.floor((millis / 1000) / 60);
                    return result < 0 ? 0 : result;
                }

                var createGeoJSONCircle = function (center, radiusInKm, points) {
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
                };

//user's starting position
                create_self(0.05, 50.4664, 4.8605, 'purple', false); // MODIFY

//mock bar promo //MODIFY // ATTENTION, GMT CASSE LES COUILLES DU COUP METTRE 2H EN MOINS QUE CE QU'ON VEUT
                add_marker(0.05, 50.4661, 4.8609, true, "Maredsous blonde pour 1€", "osef", "Super match de foot fifa ! <br> Venez boire un verre en notre compagnie :D", "42", new Date(Date.UTC(2019, 3, 20, 10, 30, 30)));
                add_marker(0.1, 50.4668, 4.8615, true, "Chimay bleue pour 1€", "osef", "Super match de tennis ! <br> Venez boire un verre en notre compagnie :D", "42", new Date(Date.UTC(2019, 3, 20, 13, 15, 30)));

            });


        }

    }

</script>

<style>
    body {
        margin: 0;
        padding: 0;
    }

    #map {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
    }
</style>
