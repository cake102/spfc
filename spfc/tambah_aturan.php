<?php

if(isset($_POST['simpan'])){

    $nmpenyakit = $_POST['nmpenyakit'];
    
    // validasi
    $sql = "SELECT basis_aturan.idaturan, basis_aturan.idpenyakit, penyakit.nmpenyakit 
            FROM basis_aturan 
            INNER JOIN penyakit 
            ON basis_aturan.idpenyakit = penyakit.idpenyakit 
            WHERE nmpenyakit = '$nmpenyakit'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Data basis aturan penyakit tersebut sudah ada</strong>
        </div>
        <?php
    } else {
        // mengambil data penyakit
        $sql = "SELECT * FROM penyakit WHERE nmpenyakit = '$nmpenyakit'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $idpenyakit = $row['idpenyakit'];
        
        // proses simpan
        $sql = "INSERT INTO basis_aturan VALUES (Null, '$idpenyakit')";
        mysqli_query($conn, $sql);
        
        // mendapatkan idaturan yang baru saja disimpan
        $idaturan = mysqli_insert_id($conn);

        // mengambil idgejala
        $idgejala = $_POST['idgejala'];
        
        // proses simpan detail basis aturan
        $jumlah = count($idgejala);
        for ($i = 0; $i < $jumlah; $i++) {
            $idgejalane = $idgejala[$i];
            $sql = "INSERT INTO detail_basis_aturan VALUES ('$idaturan', '$idgejalane')";
            mysqli_query($conn, $sql);
        }
        header("Location:?page=aturan");
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST" name="form"onsubmit="return validasiform()">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Tambah Data Basis Aturan</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                           <label for="">Nama Penyakit</label>
                            <select class="form-control chosen" data-placeholder="Pilih Nama Penyakit" name="nmpenyakit">
                                <option value=""></option>
                                <?php
                                    $sql = "SELECT * FROM penyakit ORDER BY nmpenyakit ASC";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row['nmpenyakit']; ?>"><?php echo $row['nmpenyakit']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 1;
                                        $sql = "SELECT * FROM gejala ORDER BY nmgejala ASC";
                                        $result = $conn->query($sql);
                                        while($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" class="check-item" name="<?php echo 'idgejala[]'; ?>" value="<?php echo $row['idgejala']; ?>"></td>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['nmgejala']; ?></td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                        <a class="btn btn-danger" href="?page=aturan">Batal</a>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function validasiform()
    {
        // validasi nama penyakit
        var nmpenyakit = document.forms["form"]["nmpenyakit"].value;

        if (nmpenyakit==""){
            alert("Pilih nama penyakit");
            return false;
        }

    //validasi gejala yang belum dipilih
    var checkbox=document.getElementsByName('<?php echo 'idgejala[]'; ?>');

    var isChecked=false;
    
    for(var i=0;i<checkbox,length;i++){
        if(checkbox[i].checked){
            isChecked=true;
            break;
        }

    }
    //jika belum ada yang di check
    if(!isChecked){
        alert("Pilih Paling tidak satu gejala !!");
        return false;
    }

    return true;
    }
</script>