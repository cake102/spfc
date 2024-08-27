<?php

$iduser=$_GET['id'];

$sql = "DELETE FROM users WHERE iduser='$iduser'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=users");
}
$conn->close();
?>