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

        <div class="col-md-3">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Card title 286 x 180</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>

  </div>

</div>


  
<?php else: ?>
  <?php $this->load->view('Vlogin') ?>
<?php endif ?>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>