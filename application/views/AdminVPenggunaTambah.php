<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<title> Admin Laundry | Tambah Pengguna</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatable/datatablecss.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatable/datatablecss.min.css') ?>">
</head>
<body>
<div>
<?php if ($this->session->has_userdata('username')): ?>
	<div class="row">
		<div class="col-md-12">
			<?php $this->load->view('AdminVHeader') ?>
		</div>
	</div>

	<div class="row mt-5">
	<div class="container">
		<?= form_open('App_controler/AdminCProsesTambahPengguna', ['method' => 'POST']) ?>
            <div class="form-group">
                <label>Nama Pengguna</label>
                <input type="text" class="form-control" name="nm_user" required>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <label>ID Outlet</label>
                <input type="number" class="form-control" name="id_outlet" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select class="form-control" name="role" required>
                    <option>Admin</option>
                    <option>Kasir</option>
                    <option>Owner</option>
                </select>
            </div>
           
            
            <input type="submit" class="btn btn-success" value="Daftar">
    	<?= form_close()?>
    </div>
	</div>
</div>
<?php else: ?>
    <?php $this->load->view('AdminVHome') ?>
<?php endif ?>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>