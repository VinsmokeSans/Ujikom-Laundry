<!doctype html> 
<html> 
<head> 
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="assets/css/bootstrap.css"> 
	<link rel="stylesheet" href="assets/loginstyle.css"> 
	<title>Skuy Nyeuseuh</title> 
<style type="text/css">
body {
    font-family: 'Varela Round', sans-serif;
  }
  .modal-login {    
    color: #636363;
    width: 350px;
  }
  .modal-login .modal-content {
    padding: 20px;
    border-radius: 5px;
    border: none;
  }
  .modal-login .modal-header {
    border-bottom: none;   
        position: relative;
        justify-content: center;
  }
  .modal-login h4 {
    text-align: center;
    font-size: 26px;
    margin: 30px 0 -15px;
  }
  .modal-login .form-control:focus {
    border-color: #70c5c0;
  }
  .modal-login .form-control, .modal-login .btn {
    min-height: 40px;
    border-radius: 3px; 
  }
  .modal-login .close {
        position: absolute;
    top: -5px;
    right: -5px;
  } 
  .modal-login .modal-footer {
    background: #ecf0f1;
    border-color: #dee4e7;
    text-align: center;
        justify-content: center;
    margin: 0 -20px -20px;
    border-radius: 5px;
    font-size: 13px;
  }
  .modal-login .modal-footer a {
    color: #999;
  }   
  .modal-login .avatar {
    position: absolute;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: -70px;
    width: 95px;
    height: 95px;
    border-radius: 50%;
    z-index: 9;
    background: white;
    padding: 15px;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
  }
  .modal-login .avatar img {
    width: 100%;
  }
  .modal-login.modal-dialog {
    margin-top: 80px;
  }
    .modal-login .btn {
        color: #fff;
        border-radius: 4px;
    background: #5fc6e9;
    text-decoration: none;
    transition: all 0.4s;
        line-height: normal;
        border: none;
    }
  .modal-login .btn:hover, .modal-login .btn:focus {
    background: #45aba6;
    outline: none;
  }
  .trigger-btn {
    display: inline-block;
    margin: 100px auto;
  }
</style>
</head>
<body> 


<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/image/login.jpg" class="d-block w-100" alt="..." >
      <div class="carousel-caption d-none d-md-block">
        <h1 style="font-family: TimesNewRoman;">SKUY NYEUSEUH</h1>
        <h4><a href="#myModal" data-toggle="modal"> LOGIN BOS !!!</a></h4>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/image/slide1.jpg" class="d-block w-100" alt="..." >
      <div class="carousel-caption d-none d-md-block">
        <h1 style="font-family: TimesNewRoman;">SKUY NYEUSEUH</h1>
        <h4><a href="#myModal" data-toggle="modal"> LOGIN BOS !!!</a></h4>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/image/slide3.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h1 class="text-dark" style="font-family: TimesNewRoman;">SKUY NYEUSEUH</h1>
        <h4><a href="#myModal"  data-toggle="modal"> LOGIN BOS !!!</a></h4>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<!-- Modal HTML -->
<div id="myModal" class="modal fade">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <div class="modal-header">
        <div class="avatar">
          <img src="assets/image/avatar.jpg" alt="avatar">
        </div> 
        <?= form_open('App_controler/CProsesLogin', ['method' => 'POST']) ?>     
        <h4 class="modal-title">Login Skuy Nyeuseuh</h4> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form action="/examples/actions/confirmation.php" method="post">
          <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" required="required">   
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required"> 
          </div>        
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Login</button>
          </div>
        </form>
      </div>

    </div>
  </div>
  <?php if (!empty($this->session->flashdata('error_login'))) :?>
    <div class="alert alert-warning">
        <p> Mohon maaf password atau username salah </p>
    </div> <?php endif ?>



    <?= form_close()?>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script src="assets/js/jquery.js"></script> 
	<script src="assets/js/popper.js"></script> 
	<script src="assets/js/bootstrap.js"></script>
</body> 
</html>