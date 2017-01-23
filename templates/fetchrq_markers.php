<?php
/**
 * Template Name: API - Requested Map Markers Page
 */
?>
<?php
$servername = "localhost";
$username   = "root";
$password   = "root";
$dbname     = "shelterTimes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `rq_markers`";
$result = $conn->query($sql);

function echoIfNotLast($count,$max,$str){
    if($count == $max){
        return false;
    }
    else {
        echo $str;
    }
}

//Begin json.
echo '{';
if ($result->num_rows > 0) {
    // out
    $rowCount = 0;
    while($row = $result->fetch_assoc()) {
        $rowCount = $rowCount + 1;
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        ?>

    "<?php echo $row["ID"]?>":{
        "id":"<?php echo $row["ID"]?>",
        "locationName":"<?php echo $row["LocationName"]?>",
        "position":{
            "lat": <?php echo $row["Lat"] ?>,
            "lng": <?php echo $row["Lng"] ?>
        },
        "ownerName":"<?php echo $row["OwnerName"] ?>",
        "phone":"<?php echo $row["Phone"] ?>",
        "openingTimes":"<?php echo $row["OpeningTimes"] ?>",
        "volunteerOpeningTimes":"<?php echo $row["VolunteerOpeningTimes"] ?>"
    }<?php echoIfNotLast($rowCount,$result->num_rows, ',') ?>
        <?php
    }
} else {
    echo "error : no results";
}
$conn->close();

//Finish json:
echo '}';


?>
