<?php 

/******************************************
PRAKTIKUM RPL
******************************************/

class Task extends DB{
	
	// Mengambil data
	function getTask(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM pasien";

		// Mengeksekusi query
		return $this->execute($query);
	}
	//menambahkan data
	function tambah($data){
		// menginisalisasi data inputan
		date_default_timezone_set('Asia/Bangkok');
		$nik = $data['nik'];
		$nama = $data['nama'];
		$jk = $data['jk'];
		$kategori = $data['kategori'];
		$alamat = $data['alamat'];
		$date = date('Y-m-d');
		// query mysql insert
		$query = "INSERT INTO pasien(nik, nama, jk, kategori, alamat, tgl_vaksin1) VALUES ('$nik','$nama', '$jk', '$kategori', '$alamat',  '$date')";
		// mengeksekusi query
		return $this->execute($query);
	}
	// update status
	function ubah($data){
		// menginisalisasi data inputan
		date_default_timezone_set('Asia/Bangkok');
		$tgl = date('Y-m-d');
		$id = $data['id_status'];
		// query mysql insert
		$query = "UPDATE pasien SET tgl_vaksin2 = '$tgl' WHERE id = $id";
		// mengeksekusi query
		return $this->execute($query);
	}
	// HAPUS DATA
	function hapus($data){
		// menginisalisasi data inputan
		$id = $data['id_hapus'];
		// query mysql insert
		$query = "DELETE FROM pasien WHERE id = $id";
		// mengeksekusi query
		return $this->execute($query);
	}

}



?>
