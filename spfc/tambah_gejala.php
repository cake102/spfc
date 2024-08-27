<!-- letakkan proses tambah data disini -->
<?php

if(isset($_POST['simpan'])){
    $nmgejala=$_POST['nmgejala'];
	
   
	//proses simpan
        $sql = "INSERT INTO gejala VALUES (null,'$nmgejala')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=gejala");
        }
    }

?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>JUDUL</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Gejala</label>
                        <input type="text" class="form-control" name="nmgejala" maxlength="" required>
                    </div>

                <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                <a class="btn btn-danger" href="?page=gejala">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>