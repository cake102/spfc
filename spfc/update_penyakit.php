<!-- letakkan proses update data disini -->
<?php 

$idpenyakit=$_GET['id'];

if(isset($_POST['update'])){
    $nmpenyakit=$_POST['nmpenyakit'];
    $ket=$_POST['ket'];

    // proses update
    $sql = "UPDATE penyakit SET nmpenyakit='$nmpenyakit', keterangan='$ket' WHERE idpenyakit='$idpenyakit'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=penyakit");
    }
}



$sql = "SELECT * FROM penyakit WHERE idpenyakit='$idpenyakit'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Update</strong></div>
                    <div class="card-body">

                <div class="form-group">
                <label for="">Nama Penyakit</label>
                <input type="text" class="form-control" value="" name="nmpenyakit" value="<?php echo $row['nmpenyakit'] ?>" maxlength="50" required>
                    </div>
                    <div class="form-group">
                <label for="">Keterangan</label>
                <input type="text" class="form-control" value="" name="ket" value="<?php echo $row['keterangan'] ?>" maxlength="200" required>
                    </div>

                <input class="btn btn-primary" type="submit" name="update" value="Update">
                <a class="btn btn-danger" href="?page=penyakit">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>