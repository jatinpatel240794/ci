<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">


<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
<script src="<?php echo base_url(); ?>js/jQuery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-multiselect.js"></script>

</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Demo Project</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      
      <ul class="nav navbar-nav navbar-right">
        <?php if(isset($userinfo)){?>
        <li><a href="#" style="float:left;">HI <?php echo $userinfo['displayName']; ?> !</a>
          <a href="<?php echo base_url(); ?>index.php/login/logout?id=<?php if(isset($userinfo['id']))echo $userinfo['id'];?>&username=<?php  if(isset($userinfo['username'])) echo $userinfo['username']; ?>"  style="float:right;"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
          <?php } ?>
      </ul>
    </div>
  </div>
</nav>