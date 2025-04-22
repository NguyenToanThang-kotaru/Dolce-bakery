<?php
include '../config.php';
$result = $conn->query("SELECT * FROM provinces");

while($row = $result->fetch_assoc()){
    echo "<option value='".$row['id']."'>".$row['name']."</option>";
}
?>
