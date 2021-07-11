<?php
	//koneksi databse
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "data_311910391";

	$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

    //jika tombol simpan diklik
    if(isset($_POST['bsimpan']))
    {
        //pengujian apakah data akan di edit atau disimpan baru
        if($_GET['hal'] == "edit")
        {
            //data akan di edit
            $edit = mysqli_query($koneksi, " UPDATE iuran set
                                            id = '$_GET[tid]',
                                            keterangan = '$_POST[tketerangan]',
                                            tanggal = '$_POST[ttanggal]',
                                            bulan = '$_POST[tbulan]',
                                            tahun = '$_POST[ttahun]',
                                            jumlah = '$_POST[tjumlah]',
                                            wargaid = '$_POST[twargaid]'
                                            WHERE id = '$_GET[id]'
                                          ");
            if($edit)  //jika edit sukses
            {
                echo "<script>
                alert('edit data suksess!');
                document.location='index.php';
                </script>";
            }  
            else
            {
                echo "<script>
                alert('edit data suksess!!');
                document.location='index.php';
                </script>";
            }                              
        }
        else
        {
            //data akan disimpan baru
            $simpan = mysqli_query($koneksi, "INSERT INTO iuran (Keterangan, Tanggal, Bulan, Tahun, Jumlah, Warga_id)
                                          VALUES ('$_POST[tketerangan]',
                                                '$_POST[ttanggal]',
                                                '$_POST[tbulan]',
                                                '$_POST[ttahun]',
                                                '$_POST[tjumlah]',
                                                '$_POST[twargaid]')
        
                                          ");
            if($simpan)  //jika simpan sukses
            {
                echo "<script>
                alert('simpan data suksess!!');
                document.location='index.php';
                </script>";
            }  
            else
            {
                echo "<script>
                alert('simpan data suksess!!');
                document.location='index.php';
                </script>";
            }                                 
        }


        $simpan = mysqli_query($koneksi, "INSERT INTO iuran (Id, Keterangan, Tanggal, Bulan, Tahun, Jumlah, Warga_id)
                                          VALUES ('$_POST[tid]',
                                                '$_POST[tketerangan]',
                                                '$_POST[ttanggal]',
                                                '$_POST[tbulan]',
                                                '$_POST[ttahun]',
                                                '$_POST[tjumlah]',
                                                '$_POST[twargaid]')
        
                                          ");
      if($simpan)  //jika simpan sukses
      {
          echo "<script>
          alert('simpan data suksess!!');
          document.location='index.php';
          </script>";
      }  
      else
      {
        echo "<script>
        alert('simpan data suksess!!');
        document.location='index.php';
        </script>";
      }                                
    }

    //pengujian jika tombol edit / hapus diklik
    if(isset($_GET['hal']))
    {
        //pengujian jika edit data
        if($_GET['hal'] == "edit")
        {
            //tampilkan data yang akan di edit
            $tampil = mysqli_query($koneksi,"SELECT * FROM iuran where Id = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                //jika data ditemukan, maka data ditampung kedalam variabel
                $vid = $data['Id'];
                $vketerangan = $data['Keterangan'];
                $vtanggal = $data['Tanggal'];
                $vbulan = $data['Bulan'];
                $vtahun = $data['Tahun'];
                $vjumlah = $data['Jumlah'];
                $vwargaid = $data['Warga_id'];
            }   
        }
        else if ($_GET['hal'] == "hapus")
        {
            //persiapan hapus data
            $hapus = mysqli_query($koneksi, "DELETE FROM iuran WHERE Id = '$_GET[id]' ");
            if($hapus){
                echo "<script>
                alert('hapus data suksess!!');
                document.location='index.php';
                </script>"; 
            }
        }
    }

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>iuran rt</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">	
	
	<h1 class="text-center">DANIL BAHRI TANJUNG</h1>
    <h2 class="text-center">DATA IURAN KAS RT</h2>

<!--awal card from-->
<div class="card mt-3">
  <div class="card-header bg-primary text-white">
    from bayar iuran kas rt
  </div>
  <div class="card-body">
  	<form method="post" action="">
  		
  		<div class="form-group">
  			<label>Keterangan</label>
  			<input type="text" name="tketerangan" value="<?=@$vketerangan?>" class="form-control" placeholder="input keterangan anda disini" required="">	
  		</div>
  		<div class="form-group">
  			<label>Tanggal</label>
  			<input type="text" name="ttanggal" value="<?=@$vtanggal?>" class="form-control" placeholder="input tanggal anda disini" required="">	
  		</div>
  		<div class="form-group">
  			<label>Bulan</label>
  			<input type="text" name="tbulan" value="<?=@$vbulan?>" class="form-control" placeholder="input bulan anda disini" required="">	
  		</div>
  		<div class="form-group">
  			<label>Tahun</label>
  			<input type="text" name="ttahun" value="<?=@$vtahun?>" class="form-control" placeholder="input tahun anda disini" required="">	
  		</div>
  		<div class="form-group">
  			<label>Jumlah</label>
  			<input type="text" name="tjumlah" value="<?=@$vjumlah?>" class="form-control" placeholder="input jumlah anda disini" required="">	
  		</div>
  		<div class="form-group">
  			<label>Wargaid</label>
  			<input type="text" name="twargaid" value="<?=@$vwargaid?>" class="form-control" placeholder="input warga id anda disini" required="">	
  		</div>

  		<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
  		<button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>


  	</form>
  </div>
</div>
<!--akhir card form-->

<!--awal card table-->
<div class="card mt-3">
  <div class="card-header bg-success text-white">
    data iuran warga
  </div>
  <div class="card-body">

  	<table class="table table-bordered table-striped">
  		<tr>
  			<th>Id</th>
  			<th>Keterangan</th>
  			<th>Tanggal</th>
  			<th>Bulan</th>
  			<th>tahun</th>
  			<th>Jumlah</th>
  			<th>Wargaid</th>
              <th>Aksi</th>
  		</tr>
          <?php
                $no = 1;
                $tampil = mysqli_query($koneksi, "SELECT * from iuran order by id desc");
                while($data = mysqli_fetch_array($tampil)) :

          ?>
  		<tr>
  			<td><?=$no++;?></td>
  			<td><?=$data['Keterangan']?></td>
  			<td><?=$data['Tanggal']?></td>
  			<td><?=$data['Bulan']?></td>
  			<td><?=$data['Tahun']?></td>
  			<td><?=$data['Jumlah']?></td>
  			<td><?=$data['Warga_id']?></td>
              <td>
              <a href="index.php?hal=edit&id=<?=$data['Id']?>" class="btn btn-warning"> Edit </a>
              <a href="index.php?hal=hapus&id=<?=$data['Id']?>" onclick="return confirm('apakah yakin ingik menghapus data ini?')" class="btn btn-danger"> Hapus </a>
              </td>
  		</tr>
          <?php endwhile; //penutup perulangan?>
  	</table>
  	
  </div>
</div>
<!--akhir card table-->

</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
