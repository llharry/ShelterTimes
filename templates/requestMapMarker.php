<?php
/**
 * Template Name: Request Map Marker Page
 */
?>

<?php
require_once(get_template_directory() . '/captcha/autoload.php');
$privatekey = "your_private_key";


 ?>
 <div class="errors">
<?php if($_POST){
    $error_string = "";

    ////////////////////
    // Error Catching //
    ////////////////////

    // Captcha
    //TODO: Fix this at some point.

    //function isValid()
    //{
    //    try {
//
    //        $url = 'https://www.google.com/recaptcha/api/siteverify';
    //        $data = ['secret'   => '6LcsxxIUAAAAAGk8jjau6adYKFhAkbJriSy-B2l4',
    //                 'response' => $_POST['g-recaptcha-response'],
    //                 'remoteip' => $_SERVER['REMOTE_ADDR']];
//
    //        $options = [
    //            'http' => [
    //                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
    //                'method'  => 'POST',
    //                'content' => http_build_query($data)
    //            ]
    //        ];
//
    //        $context  = stream_context_create($options);
    //        $result = file_get_contents($url, false, $context);
    //        return json_decode($result)->success;
    //    }
    //    catch (Exception $e) {
    //        return null;
    //    }
    //}
    //if(isValid()){
//
    //} else {
    //    $error_string = $error_string . "recaptcha error";
    //}

    // /Captcha

    if($error_string == ""){
        $servername = "localhost";
        $username   = "root";
        $password   = "root";
        $dbname     = "shelterTimes";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            echo "dieeeeeeeeeed";
            die("Connection failed: " . $conn->connect_error);
        }

        $lat                    = $conn->real_escape_string($_POST['lat']);
        $lng                    = $conn->real_escape_string($_POST['lng']);
        $phone                  = $conn->real_escape_string($_POST['phone']);
        $ownerName              = $conn->real_escape_string($_POST['ownerName']);
        $locationName           = $conn->real_escape_string($_POST['locationName']);
        $openingTimes           = $conn->real_escape_string($_POST['openingTimes']);
        $volunteerOpeningTimes  = $conn->real_escape_string($_POST['volunteerOpeningTimes']);

        $sql = "INSERT INTO rq_markers (`Lat`, `Lng`, `Phone`, `OwnerName`, `LocationName`, `OpeningTimes`, `VolunteerOpeningTimes`) VALUES ('$lat','$lng','$phone','$ownerName','$locationName','$openingTimes','$volunteerOpeningTimes')";
        if ($conn->query($sql) === TRUE) {
            echo "Request added";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo $error_string;
    }
}?>
</div>



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
        <div class="width3_2 pageContent">
            <?php the_content();?>
            <div class="mapLabelForm">
                <form method="post">
                    <p>
                        <input type="text" name="lat" id="lat" placeholder="lat">
                    </p>
                    <p>
                        <input type="text" name="lng" id="lng" placeholder="lng">
                    </p>
                    <p>
                        <input type="text" name="phone" id="phone" placeholder="phone">
                    </p>
                    <p>
                        <input type="text" name="ownerName" id="ownerName" placeholder="ownerName">
                    </p>
                    <p>
                        <input type="text" name="locationName" id="locationName" placeholder="locationName">
                    </p>
                    <p>
                        <input type="text" name="openingTimes" id="openingTimes" placeholder="openingTimes">
                    </p>
                    <p>
                        <input type="text" name="volunteerOpeningTimes" id="volunteerOpeningTimes" placeholder="volunteerOpeningTimes">
                    </p>
                    <div class="g-recaptcha" data-sitekey="6LcsxxIUAAAAAGk8jjau6adYKFhAkbJriSy-B2l4"></div>
                    <p>
                        <input type="submit" value="Submit">
                    </p>
                </form>
            </div>
        </div>
        <div class="width3 pageSidebar">
            <?php if ( is_active_sidebar( 'page_sidebar' ) ) : ?>
            <div class="width1 widget-area" role="complementary">
                <?php dynamic_sidebar( 'page_sidebar' ); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php                     }
                } ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
