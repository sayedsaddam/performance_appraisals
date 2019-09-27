<?php 
/*
* Filename: head.php
* Filepath: views / components / head.php
* Author: Saddam
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900|Open+Sans:400,700,800|Roboto:400,700,900" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/select2/dist/css/select2.min.css'); ?>">
	<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
	<script src="<?php echo base_url('assets/DataTables/js/jquery.dataTables.min'); ?>"></script>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php if($this->session->userdata('admin_cnic')){ echo base_url('admin_dashboard'); }else{ ?>javascript:void(0);<?php } ?>">Performance Appraisals</a>
    </div>
    <?php $ucpo_session = $this->session->userdata('ucpo_cnic'); ?>
    <?php $tcsp_session = $this->session->userdata('tcsp_cnic'); ?>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if($tcsp_session OR $ucpo_session): ?> class="disabled" <?php endif; ?>>
          <a href="<?php if(!$tcsp_session){ echo base_url('performance_evaluation/get_previous'); } ?>">UCPO Evaluation</a>
        </li>
        <li <?php if($ucpo_session OR $tcsp_session): ?> class="disabled" <?php endif; ?>>
          <a href="<?php if(!$ucpo_session){ echo base_url('performance_evaluation/tcsp_previous'); } ?>">TCSP Evaluation</a>
        </li>
        <?php if($this->session->userdata('admin_cnic')): ?>
          <li>
          <a href="<?php echo base_url('admin_dashboard'); ?>">Summary</a>
        </li>
      <?php endif; ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if($this->session->userdata('peo_cnic') OR $this->session->userdata('ac_cnic') OR $this->session->userdata('ucpo_cnic') OR $this->session->userdata('tcsp_cnic') OR $this->session->userdata('admin_cnic')): ?>
          <li>
            <a href="<?php echo base_url('Perf_login/change_password'); ?>">Change Password</a>
          </li>
          <li>
            <a href="<?php echo base_url('Perf_login/logout'); ?>">Logout <span class="glyphicon glyphicon-log-out"></span></a>
          </li>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
