<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<title> Admin Laundry | Outlet </title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatable/datatablecss.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatable/datatablecss.min.css') ?>">

    <script type="text/javascript" src="<?php echo base_url('assets/datatable/datatable.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/datatable/datatable.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/datatable/datatable.bootstrap4.min.js') ?>"></script>
</head>
<body>

<?php if ($this->session->has_userdata('username')): ?>
	<div class="row">
		<div class="col-md-12">
			<?php $this->load->view('AdminVHeader') ?>
		</div>
	</div>
	
	<?php if (!empty($this->session->flashdata('status'))): ?>
		<div class="alert alert-warning">
			<?= $this->session->flashdata('status') ?>
		</div>
	<?php endif ?>
	
	<div class="container">
		<div class="row mt-3">
			<div class="col-md-12">
				<table id="tabelmember" class="table table-striped table-bordered" style="width:100%">
				<thead align="center" class="thead-dark">
					<tr>
						<th>ID Outlet</th>
						<th>Nama Outlet</th>
						<th>Alamat</th>
						<th>No Telp</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				foreach ($data as $d) :?>
					<tr align="center">
						
						<td><?= $d['id_outlet'] ?></td>
						<td><?= $d['nm_outlet'] ?></td>
						<td><?= $d['alamat_outlet'] ?></td>
						<td><?= $d['tlp_outlet'] ?></td>
						<td align="center">
							<a href="<?php echo site_url('App_controler/AdminCEditOutlet/'.$d['id_outlet']) ?>" class="btn btn-outline-success">Edit </a>
							<a href="<?php echo site_url('App_controler/AdminCHapusOutlet/'.$d['id_outlet']) ?>" class="btn btn-outline-success" onclick="return confirm('Yakin ingin menghapus')"> Hapus</a>
						</td>
					</tr>
				<?php endforeach ?>
				</tbody>
				</table>
			</div>
		</div>
	</div>


	  <script>   
	        $(document).ready(function() {
	            $('#tabelmember').DataTable();
	        } );
 	   </script> 


	<div class="row">
		<div class="container col-primary">
			<a href="<?php echo site_url('App_controler/AdminCTambahOutlet') ?>" class="btn btn-primary"> Tambah Outlet</a>
		</div>
	</div>
<?php else: ?>
	<?php $this->load->view('Vlogin') ?>
<?php endif ?>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>