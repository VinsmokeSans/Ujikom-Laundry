<!DOCTYPE html>
<html>
<head>
  <title> Beranda </title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body>

<?php if ($this->session->has_userdata('username')): ?>


<div class="container">

    <div class="row">
    <?php foreach($data as $d) :?>
      <div class="col-md-4">
          <div class="card">
              <h5 class="card-header">Paket : <?= $d['harga_paket'] ?></h5>
              <div class="card-body">
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <input type="number" class="form-control mb-4" name="">
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
          </div>
      </div>
    <?php endforeach ?>
    </div>

</div>


  
<?php else: ?>
  <?php $this->load->view('Vlogin') ?>
<?php endif ?>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>