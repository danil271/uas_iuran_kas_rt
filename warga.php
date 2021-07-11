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
            $edit = mysqli_query($koneksi, " UPDATE warga set
                                            nik = '$_POST[tnik]',
                                             nama= '$_POST[tnama]',
                                             kelamin= '$_POST[tkelamin]',
                                             alamat= '$_POST[talamat]',
                                             norumah= '$_POST[tnorumah]',
                                             statusrt= '$_POST[tstatusrt]'
                                            WHERE id = '$_GET[id]'
                                          ");
            if($edit)  //jika edit sukses
            {
                echo "<script>
                alert('edit data suksess!');
                document.location='warga.php';
                </script>";
            }  
            else
            {
                echo "<script>
                alert('edit data suksess!');
                document.location='warga.php';
                </script>";
            }                              
        }
        else
        {
            //data akan disimpan baru
            $simpan = mysqli_query($koneksi, "INSERT INTO warga (Id, Nik, Nama, Kelamin, Alamat, NoRumah, status_rt )
                                          VALUES ('$_POST[tid]',
                                                '$_POST[tnik]',
                                                '$_POST[tnama]',
                                                '$_POST[tkelamin]',
                                                '$_POST[talamat]',
                                                '$_POST[tnorumah]',
                                                '$_POST[tstatusrt]')
        
                                          ");
            if($simpan)  //jika simpan sukses
            {
                echo "<script>
                alert('simpan data suksess!!');
                document.location='warga.php';
                </script>";
            }  
            else
            {
                echo "<script>
                alert('simpan data suksess!');
                document.location='warga.php';
                </script>";
            }                                 
        }


        $simpan = mysqli_query($koneksi, "INSERT INTO iuran (Id, Nik, Nama, Kelamin, Alamat, NoRumah, status_rt)
                                          VALUES ('$_POST[tid]',
                                                '$_POST[tnik]',
                                                '$_POST[tnama]',
                                                '$_POST[tkelamin]',
                                                '$_POST[talamat]',
                                                '$_POST[tnorumah]',
                                                '$_POST[tstatusrt]')
                                                
        
                                          ");
      if($simpan)  //jika simpan sukses
      {
          echo "<script>
          alert('simpan data suksess!!');
          document.location='warga.php';
          </script>";
      }  
      else
      {
        echo "<script>
        alert('simpan data suksess!');
        document.location='warga.php';
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
            $tampil = mysqli_query($koneksi,"SELECT * FROM warga where Id = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                //jika data ditemukan, maka data ditampung kedalam variabel
                $vid = $data['Id'];
                $vnik = $data['Nik'];
                $vnama = $data['Nama'];
                $vkelamin = $data['Kelamin'];
                $valamat = $data['Alamat'];
                $vnorumah = $data['No Rumah'];
                $vstatusrt = $data['Status_rt'];
            }   
        }
        else if ($_GET['hal'] == "hapus")
        {
            //persiapan hapus data
            $hapus = mysqli_query($koneksi, "DELETE FROM warga WHERE Id = '$_GET[id]' ");
            if($hapus){
                echo "<script>
                alert('hapus data suksess!!');
                document.location='warga.php';
                </script>"; 
            }
        }
    }

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>warga rt</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">	
	
	<h1 class="text-center">DANIL BAHRI TANJUNG</h1>
    <h2 class="text-center">DATA WARGA IURAN KAS RT</h2>

<!--awal card from-->
<div class="card mt-3">
  <div class="card-header bg-primary text-white">
    from data warga rt
  </div>
  <div class="card-body">
  	<form method="post" action="">
  		<div class="form-group">
  			<label>Nik</label>
  			<input type="text" name="tnik" value="<?=@$vnik?>" class="form-control" placeholder="input nik anda disini" required="">	
  		</div>
  		<div class="form-group">
  			<label>Nama</label>
  			<input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" placeholder="input nama anda disini" required="">	
  		</div>
	   		<div class="form-groub">
	   		<label>Kelamin</label>
	   		<select class="form-control" name="kelamin">
	   			<option value="<?=@$vkelamin?>"><?=@$vkelamin?></option>
	   			<option value="L">L</option>
	   			<option value="P">P</option>
	   		</select>
	   	</div>
  		<div class="form-group">
  			<label>Alamat</label>
  			<input type="text" name="talamat" value="<?=@$valamat?>" class="form-control" placeholder="input alamat anda disini" required="">	
  		</div>
  		<div class="form-group">
  			<label>No Rumah</label>
  			<input type="text" name="tnorumah" value="<?=@$vnorumah?>" class="form-control" placeholder="input no rumah anda disini" required="">	
  		</div>
  		<div class="form-group">
  			<label>Status_rt</label>
  			<input type="text" name="tstatusrt" value="<?=@$vstatusrt?>" class="form-control" placeholder="input status anda disini" required="">	
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
    data warga rt
  </div>
  <div class="card-body">

  	<table class="table table-bordered table-striped">
  		<tr>
  			<th>Id</th>
  			<th>Nik</th>
  			<th>Nama</th>
  			<th>Kelamin</th>
  			<th>Alamat</th>
  			<th>No Rumah</th>
  			<th>Status_rt</th>
            <th>Aksi</th>
  		</tr>
          <?php
                $no = 1;
                $tampil = mysqli_query($koneksi, "SELECT * from warga order by Id desc");
                while($data = mysqli_fetch_array($tampil)) :
          ?>
  		<tr>
  			<td><?=$no++;?></td>
  			<td><?=$data['Nik']?></td>
  			<td><?=$data['Nama']?></td>
  			<td><?=$data['Kelamin']?></td>
  			<td><?=$data['Alamat']?></td>
  			<td><?=$data['No Rumah']?></td>
  			<td><?=$data['Status_rt']?></td>
              <td>
              <a href="warga.php?hal=edit&id=<?=$data['Id']?>" class="btn btn-warning"> Edit </a>
              <a href="warga.php?hal=hapus&id=<?=$data['Id']?>" onclick="return confirm('apakah yakin ingik menghapus data ini?')" class="btn btn-danger"> Hapus </a>
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
