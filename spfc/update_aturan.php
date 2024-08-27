
<?php
//proses tampil data 
$idaturan=$_GET['id'];

$sql = "SELECT basis_aturan.idaturan,basis_aturan.idpenyakit,penyakit.nmpenyakit 
        FROM basis_aturan INNER JOIN penyakit 
        ON basis_aturan.idpenyakit=penyakit.idpenyakit WHERE idaturan='$idaturan'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();



//proses update
if(isset($_POST['update'])){
    $idgejala=$_POST['idgejala'];

    //proses simpan detai basis aturan
    if($idgejala!=Null){
    $jumlah = count($idgejala);
    $i=0;
        while ($i< $jumlah) {
            $idgejalane = $idgejala[$i];
            $sql = "INSERT INTO detail_basis_aturan VALUES ('$idaturan', '$idgejalane')";
            mysqli_query($conn, $sql);
            $i++;
        }
        header("Location:?page=aturan");
        }
    }

?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Update Data Basis Aturan</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                           <label for="">Nama Penyakit</label>
                           <input type="text" class="form-control" value="<?php echo $row['nmpenyakit']; ?>" name="nmpenyakit" readonly>
                        </div>
                        
                        <!-- Tabel gejala -->
                        <div class="from-group">
                            <label for="">Pilih gejala-gejala berikut :</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="50px"></th>
                                        <th width="80px">No.</th>
                                        <th width="500px">Nama Gejala</th>
                                        <th width="50px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 1;
                                        $sql = "SELECT * FROM gejala ORDER BY nmgejala ASC";
                                        $result = $conn->query($sql);
                                        while($row = $result->fetch_assoc()) {

                                            $idgejala=$row['idgejala'];

                                            //cek detail tb_basis_aturan
                                            $sql2 = "SELECT * FROM detail_basis_aturan WHERE idaturan='$idaturan' AND idgejala='$idgejala'";
                                            $result2 = $conn->query($sql2);
                                            if ($result2->num_rows > 0) {
                                                // jika data ditemuka maka tampilan datanya
                                    ?>
                                    <tr>
                                        <td align="center"><input type="checkbox" class="check-item" disabled="disabled"></td>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['nmgejala']; ?></td>
                                        <td align="center">
                                            <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=aturan&action=hapus_gejala&id=<?php echo $idaturan?>&idgejala=<?php echo $idgejala ?>">
                                                <i class="fas fa-window-close"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                        }else{
                                               // jika data tidak ditemukan maka tampilkan data kosong
                                    ?>
                                        <tr>
                                            <td align="center"><input type="checkbox" class="check-item" name="<?php echo 'idgejala[]'; ?>" value="<?php echo $row['idgejala']; ?>"></td>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $row['nmgejala']; ?></td>
                                            <td align="center">
                                                <i class="fas fa-window-close"></i>
                                            </a>
                                        </td>

                                        </tr>

                                    <?php
                                        }
                                    }
                                        $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <input class="btn btn-primary" type="submit" name="update" value="Update">
                        <a class="btn btn-danger" href="?page=aturan">Batal</a>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>