<?php 
require('function.php');
if(isset($_POST['nama'])){
	define('DB','db.txt');
	if(!file_exists(DB)){
		saveTxt(DB,"2022|nama|jenis|harga|".PHP_EOL,'a');
	}
	$id = $_GET['id'];
	$nama = $_POST['nama'];
	$jenis = $_POST['jenis'];
	$harga = $_POST['harga'];
	$foto = $_FILES['foto']['name'];
	$temp = $_FILES['foto']['tmp_name'];
	$dataLast = edit($_GET['id']);

	if(move_uploaded_file($temp,'foto/'.$foto)){
		$content = str_replace($dataLast,"$id|$nama|$jenis|$harga|$foto",file_get_contents(DB));
		saveTxt(DB,$content,'w');
		header('location:index.php');
	}else {
		$content = str_replace($dataLast,"$id|$nama|$jenis|$harga|$foto",file_get_contents(DB));
		saveTxt(DB,$content,'w');
	}
	
	//header('location:index.php');
	//exit;
	
}

if(!empty($_GET['id'])){
	$loadEdit = edit($_GET['id']);
	$explEdit = explode('|',$loadEdit);
	$nama = $explEdit[1];
	$jenis = $explEdit[2];
	$harga = $explEdit[3];
	$foto = $explEdit[4];
	
}

function edit($id){
	$db = 'db.txt';
	$loadDB = @file($db, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	foreach ($loadDB as $data){
		$exp = explode('|',$data);
		$myid = $exp[0];
		if($myid==$id){
			$out = $data;
			break;
		}else{
			$out = null;
		}
		
	}
	
return $out;
}
?>

<html>
<head>
<title>Update Data</title>
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
	<center><h1>Update Barang</h1></center>
	<?php require('menu.php');?>
	<form enctype="multipart/form-data" action="#" method="POST">
		<section class="base">
			<div>
				<label>- Nama Barang</label>
				<input name="nama" type="text" value="<?=$nama;?>"><br/>
			</div>
			<br></br>
			<div>
				<label>- Jenis Barang</label>
				<input name="jenis" type="text" value="<?=$jenis;?>"><br/>
			</div>
			<br></br>
			<div>
				<label>- Harga Barang</label>
				<input name="harga" type="text" value="<?=$harga;?>"><br/>
			</div>
			<br></br>
			<div>
				<label>- Foto Barang</label>
				<input name="foto" type="file"><br/>
				<img src="foto/<?=$foto;?>" style="width: 150px" alt="">
			</div>
			<br></br>
			<div>
				<button type="submit">Perubahan Barang</button>
			</div>
		</section>
	</form>	
</body>
</html>