<?php
/**
 * Template Name: Homepage
 */
?>

<?php
// Gets header.php
get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="page page_homepage width1">
    <div class="siteWidth">
        <h3>My Google Maps Demo</h3>
        <div id="map"></div>
        <script>

        var map = {};

        var MARKER_LIST = [];

        function loadMapMarkers(){ //Load all accepted map markers from database
            var datas = ""
            $.getJSON('/fetchmapmarkers/', function(data){ //Connect to templates/fetchmapmarkers.php to retrieve the json file of the map label data.
                for(var marker in data){
                    var marker = data[marker]
                    var pos = marker.position
                    var marker = new google.maps.Marker({
                      position: pos,
                      map: map,
                      title: marker.locationName
                    });
                }
            });

        }

        function initMap() { //Create map and start program
            var middlesbrough = {lat: 54.5742, lng: -1.2350};
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: middlesbrough
            });

            loadMapMarkers();
        }

        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key= AIzaSyAbYejTEjiv8cD8el_Bw-j4KVG-pb8VR5s&callback=initMap">
        </script>
    </div>
</div>

<?php endwhile; endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
