<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<title>Admin Laundry | Edit Pengguna </title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatable/datatablecss.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatable/datatablecss.min.css') ?>">
</head>
<body>

<?php if ($this->session->has_userdata('username')): ?>
	<div class="row">
		<div class="col-md-12">
			<?php $this->load->view('AdminVHeader') ?>
		</div>
	</div>
	<div class="row mt-5">
	<div class="container">
		<?= form_open('App_controler/AdminCProsesEditOutlet/'.$data['id_outlet'], ['method' => 'POST']) ?>
            <div class="form-group">
                <label>Nama Outlet</label>
                <input type="text" class="form-control" name="nm_outlet" required value="<?= $data['nm_outlet']?>">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" name="alamat_outlet" required value="<?= $data['alamat_outlet'] ?>">
            </div>           
            <div class="form-group">
                <label>Tlp/No Hp</label>
                <input type="text" class="form-control" name="tlp_outlet" required value="<?= $data['tlp_outlet'] ?>">
            </div>
            <input type="submit" class="btn btn-success" value="Rubah">
            
            
    	<?= form_close()?>
    </div>
	</div>
	
<?php else: ?>
	<?php $this->load->view('AdminVHome') ?>
<?php endif ?>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>