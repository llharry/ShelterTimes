<?php
/**
 * Template Name: Edit Markers
 */
?>
<?php
// Gets header.php
get_header(); ?>
<?php /*get posts*/
if (have_posts()) {
    while (have_posts()) {the_post();
?>
<div class="page_default">
    <div class="titleBar">
        <div class="siteWidth">
            <h1><?php the_title() ?></h1>
        </div>
    </div>
    <div class="siteWidth">
        <div class="width1 pageContent">
            <script>
            $.getJSON('/fetchrq_markers/', function(data){ //Connect to templates/fetchmapmarkers.php to retrieve the json file of the map label data.
                function rejectItem(){
                    var id = $(this).parent("div").prop("id");
                    $.post("/acceptrejectmarkers/",
                    {
                        action: "REJECT",
                        ID: id
                    },
                    function(data,status){

                    });
                }
                for(var key in data){
                    var marker = data[key]

                    var listContainer = $("<div>", {id: marker.id, "class": "listContainer width1"});
                    var list = $("<ul>", { "class": "markerItem width2"});

                    $("#RQ_MARKERSContainer").append(listContainer);//add container to the RQ markers section
                    listContainer.append(list); //add list to container

                    list.append("<li>ID: " + marker.id + "</li>")
                    list.append("<li>Location Name: " + marker.locationName + "</li>");
                    list.append("<li>Position: [Lat: " + marker.position.lat + ", Long: " + marker.position.lng + "]</li>");
                    list.append("<li>Owner: " + marker.ownerName + "</li>");
                    list.append("<li>Phone Number: " + marker.phone + "</li>");
                    list.append("<li>Opening Times: " + marker.openingTimes + "</li>");
                    list.append("<li>Volunteering Times: " + marker.volunteerOpeningTimes + "</li>");

                    var acceptButton = $("<button>",{"class":"acceptButton width4", "text":"Accept"})

                    var rejectButton = $("<button>",{"class":"rejectButton width4", "text":"Reject"})
                    rejectButton.click(function(){
                        var id = $(this).parent("div").prop("id");
                        $.post("/acceptrejectmarkers/",
                        {
                            action: "REJECT",
                            ID: id
                        },
                        function(data,status){

                        });

                    })

                    //add buttons to container
                    listContainer.append(acceptButton);
                    listContainer.append(rejectButton);

                }
            });
            </script>
            <div class="width1">
                <h1>Requested Markers</h1>
            </div>
            <div id="RQ_MARKERSContainer" class="width1">
            </div>
        </div>
    </div>
</div>
<?php                     }
                } ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
