<?php

/******************************************
PRAKTIKUM RPL
SUDIRMAN NUR PUTRA
1900457
******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

// MENAMBAH DATA
if(isset($_POST['add'])) {
	// MENGALIHKAN PROSES
	$otask->Tambah($_POST);
	// kembali ke index.php
	header("Location: index.php");
}
// UPDATE DATA
if (isset($_GET['id_status'])) {
	// MENGALIHKAN PROSES
	$otask->ubah($_GET);
	// kembali ke index.php
	header("Location: index.php");
}
// HAPUS DATA
if (isset($_GET['id_hapus'])) {
	// MENGALIHKAN PROSES
	$otask->hapus($_GET);
	// kembali ke index.php
	header("Location: index.php");
}

// Memanggil method getTask di kelas Task
$otask->getTask();

// Proses mengisi tabel dengan data
$data = null;
$no = 1;
$tgl = date("0000-00-00");
while (list($id, $nik, $nama, $jk, $kategori, $alamat, $tgl_vaksin1, $tgl_vaksin2) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if ($tgl == $tgl_vaksin2) {
		$status = "Belum Selesai";
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $nik . "</td>
		<td>" . $nama . "</td>
		<td>" . $jk . "</td>
		<td>" . $kategori . "</td>
		<td>" . $alamat . "</td>
		<td>" . $tgl_vaksin1 . "</td>
		<td>" . $tgl_vaksin2 . "</td>
		<td>". $status ."</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Vaksin 2</a></button>
		</td>

		</tr>";
		$no++;
	}else {
		$status = "Sudah Selesai";
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $nik . "</td>
		<td>" . $nama . "</td>
		<td>" . $jk . "</td>
		<td>" . $kategori . "</td>
		<td>" . $alamat . "</td>
		<td>" . $tgl_vaksin1 . "</td>
		<td>" . $tgl_vaksin2 . "</td>
		<td>". $status ."</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}
		

	// if($tstatus == "Sudah"){
	// 	$data .= "<tr>
	// 	<td>" . $no . "</td>
	// 	<td>" . $tname . "</td>
	// 	<td>" . $tdetails . "</td>
	// 	<td>" . $tsubject . "</td>
	// 	<td>" . $tpriority . "</td>
	// 	<td>" . $tdeadline . "</td>
	// 	<td>" . $tstatus . "</td>
	// 	<td>
	// 	<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
	// 	</td>
	// 	</tr>";
	// 	$no++;
	// }

	// // Tampilan jika status task nya belum dikerjakan
	// else{
	// 	$data .= "<tr>
	// 	<td>" . $no . "</td>
	// 	<td>" . $tname . "</td>
	// 	<td>" . $tdetails . "</td>
	// 	<td>" . $tsubject . "</td>
	// 	<td>" . $tpriority . "</td>
	// 	<td>" . $tdeadline . "</td>
	// 	<td>" . $tstatus . "</td>
	// 	<td>
	// 	<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
	// 	<button class='btn btn-success' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
	// 	</td>
	// 	</tr>";
	// 	$no++;
	// }
}

// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();