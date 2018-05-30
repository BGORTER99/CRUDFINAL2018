<?php
// This block allows our program to access the MySQL database.
// Stores your login information in PHP variables
    $mysqli_host = "localhost";
    $mysqli_username = "bgorter";
    $mysqli_password = "Ranger5078.";
    $mysqli_database = "swimming";
// Accesses the login information to connect to the MySQL server using your credentials and database
$dbserver = new mysqli($mysqli_host,$mysqli_username,$mysqli_password,$mysqli_database);
// This provides the error message that will appear if your credentials or database are invalid
if (!$dbserver) die("Unable to connect to MySQL: " . mysql_error());
mysqli_select_db ( $dbserver , "swimming")
	or die("Unable to select database: " . mysql_error());

echo <<<_SWIM
<html>
    <head>
        <body background="water.jpeg">
        <link href="final.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <script type="text/javascript">
var intX = 0;
function move(){
    var objDiv = document.getElementById('id1');
    if ( objDiv != null ) {
        objDiv.style.left = (intX -= 3).toString() + 'px';
        } //if
    if ( intX > 0 ) { setTimeout(move,20); }
return true;
}
</script>
        <title>Swimming Stats</title>
        <h1>Swimming Stats</h1>
        <form action="test.php" method="post" id="enterform">
            <h2>Date</h2>
            <input type="text" class="center" name='date'/>
            <br>
            <h2>Time</h2>
            <input type="text" class="center" name='time'/>
            <br>
            <h2>Stroke</h2>
            <input type="text" class="center" name='stroke'/>
            <br>
            <h2>Distance</h2>
            <input type="text" class="center" name='distance'/>
            <br>
            <input type='submit' name='enter' onclick="move()" value='ENTER' id='button'></input>
            <br>
            <input type='submit' name='edit' value='EDIT' id='button'></input>
            <br>
            <input type='submit' name='delete' value='DELETE' id='button'></input>
        </form>
        <div id="id1" class="divclass" style="left:0px; position:absolute; white-space:nowrap;">Date.....Time.....Stroke.....Distance</div>
        <br>
    </head>
</html>
_SWIM;

    $date = $_POST['date'];
    $time = $_POST['time'];
    $stroke = $_POST['stroke'];
    $distance = $_POST['distance'];

if ($_POST['enter']){
$sql = "INSERT INTO swimming VALUES ('$date', '$time', '$stroke', '$distance')";
mysqli_query($dbserver, $sql);
}

elseif ($_POST['delete']){
$sql= "DELETE FROM swimming WHERE date = '$date' and time = '$time' and stroke = '$stroke' and distance = '$distance' ";
mysqli_query($dbserver, $sql);
}

elseif ($_POST['edit']){
    $sql= "UPDATE swimming SET date='$date', time='$time' WHERE stroke='$stroke' and distance = '$distance'";
mysqli_query($dbserver, $sql);
}
{
$sql = "SELECT * FROM swimming";
$result = mysqli_query($dbserver, $sql);
    if ($result->num_rows > 0 ) {
        while($row = $result->fetch_assoc()) {
            echo
            $row["date"] . "....." . $row["time"] . "....." . $row["stroke"] . "....." . $row["distance"] . "<br>";
        }
    } else {
        echo "No Data";
    }
}
?>