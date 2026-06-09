<?php
include("../db.php");

$result=mysqli_query($conn,
"SELECT * FROM users");

while($row=mysqli_fetch_assoc($result)){
    echo $row['name']."<br>";
}
?>