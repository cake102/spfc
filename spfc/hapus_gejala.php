<?php

$idgejala=$_GET['id'];

$sql = "DELETE FROM detail_basis_aturan WHERE idaturan='$idaturan' AND idgejala='$idgejala'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=gejala");
}
$conn->close();
?>