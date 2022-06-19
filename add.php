<?php 
require('function.php');
if(isset($_POST['nama'])){
	define('DB','db.txt');
	if(!file_exists(DB)){
		saveTxt(DB,"2022|nama|jenis|harga|".PHP_EOL,'a');
	}
	$loadDB = @file(DB, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$total = explode("|",$loadDB[count($loadDB)-1]);
	$id = $total[0]+1;
	$nama = $_POST['nama'];
	$jenis = $_POST['jenis'];
	$harga = $_POST['harga'];
	$foto = $_FILES['foto']['name'];
	$temp = $_FILES['foto']['tmp_name'];
	if(move_uploaded_file($temp,'foto/'.$foto)){
		saveTxt(DB,"$id|$nama|$jenis|$harga|$foto".PHP_EOL,'a');
		header('location:index.php');
		exit;
	}
}
?>

<html>
<head>
<title>Tambah Barang</title>
</head>
	<style type="text/css">
		* {
			font-family: "Serif font";
		}
		h1 { 
			text-transform: uppercase;
			color: red;
		}
		.base {
			width: 400px;
			padding: 20px;
			margin-left: auto;
			margin-right: auto;
		}
		label {
			margin-top : 10px;
			float: left;
			text-align: left;
			width: 100%;
			background-color: #7FFFD4;
		}
		input {
			padding: 6px;
			width: 100%;
			box-sizing: border-box;
			background-color: #F0F8FF;
			border: 2px solid #ccc;
			outline-color: red;
		}
	</style>

<body>
	<center><h1>Tambah Barang</h1></center>
	<form enctype="multipart/form-data" action="#" method="POST">
		<section class="base">
			<div>
				<label>- Nama Barang</label>
				<input name="nama" type="text"><br/>
			</div>
			<br></br>
			<div>
				<label>- Jenis Barang</label>
				<input name="jenis" type="text"><br/>
			</div>
			<br></br>
			<div>
				<label>- Harga Barang</label>
				<input name="harga" tfotoype="text"><br/>
			</div>
			<br></br>
			<div>
				<label>- Foto Barang</label>
				<input name="foto" type="file"><br/>
			</div>
			<br></br>
			<div>
				<button type="submit">Simpan Perubahan</button>
			</div>
		</section>
	</form>	
</body>

</html>