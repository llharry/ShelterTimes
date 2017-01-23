<?php
/**
 * Template Name: API - Accept/reject marker
 */
?>
<?php
    if($_POST){
    $servername = "localhost";
    $username   = "root";
    $password   = "root";
    $dbname     = "shelterTimes";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if($_POST["action"] == "REJECT"){
        $workingID = $_POST["ID"];


        $sql = "DELETE FROM `rq_markers` WHERE `id`='$workingID'";
        if ($conn->query($sql) === TRUE) {
            echo "SUCCESS";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    if($_POST["action"] == "ACCEPT"){
        $workingID = $_POST["ID"];


        $sql = "SELECT * FROM `rq_markers`";
        $result = $conn->query($sql);
    }

}
?>
