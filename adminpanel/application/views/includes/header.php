<!DOCTYPE html> 
<html lang="en-US">
<head>
  <title>Jlive</title>
  <meta charset="utf-8">
  <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="navbar navbar-fixed-top">
	  <div class="navbar-inner">
	    <div class="container">
	      <a class="brand">J-LIVE</a>
	      <ul class="nav">
			 <li <?php if($this->uri->segment(2) == 'places'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/places">Places</a>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">System <b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            <li>
	              <a href="<?php echo base_url(); ?>logout">Logout</a>
	            </li>
	          </ul>
	        </li>
	      </ul>
	    </div>
	  </div>
	</div>	
