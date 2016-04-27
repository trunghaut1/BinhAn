<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
require('../opendb.php'); 
$sql = sprintf("select * from information");
$info = mysql_fetch_assoc(mysql_query($sql));
require('../closedb.php'); 
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php  echo $info['LongName']; ?></title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/animate.min.css" rel="stylesheet"> 
  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/lightbox.css" rel="stylesheet">
  <link href="../css/main.css" rel="stylesheet">
  <link id="css-preset" href="../css/presets/preset2.css" rel="stylesheet">
  <link href="../css/responsive.css" rel="stylesheet">

  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="../images/favicon.ico">
</head><!--/head-->

<body>

  <!--.preloader-->
  <!--<div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div> 
  <!--/.preloader-->
  
  <header id="home">
    <div class="main-nav">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../index.php">
            <h1><img class="img-responsive" src="../images/logo.png" alt="logo"></h1>
          </a>                    
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">                 
            <li class="scroll active"><a href="index.php">Quản trị</a></li>
            <li class="scroll"><a href="info.php">Thông tin</a></li>
            <li class="scroll"><a href="slider.php">Slide</a></li>
            <li class="scroll"><a href="service.php">Dịch vụ</a></li>
            <li class="scroll"><a href="team.php">Đội ngũ</a></li>
            <li class="scroll"><a href="news.php">Tin tức</a></li>
            <li class="scroll"><a href="user.php">Tài khoản</a></li>
            <?php if(isset($_SESSION['admin']))
            { ?>
            <li class="scroll"><a href="process.php?logout=1">Đăng xuất</a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div><!--/#main-nav-->
  </header><!--/#home-->
  <?php 
    if(isset($_SESSION['admin']))
    { ?>
  <section id="services">
    <div class="container">
      <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="100ms">
        <div class="row">
          <div class="text-center col-sm-8 col-sm-offset-2">
            <h2>Cấu hình thông tin Websites</h2>
          </div>
        </div> 
      </div>
      <div class="text-center our-services">
        <div class="row">
            <div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="100ms">
                <a href='info.php'>
                <div class="service-icon">
                  <i class="fa fa-info"></i>
                </div>
                <div class="service-info">
                  <h3>Thông tin cơ bản</h3>
                </div></a>
            </div>
            <div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="100ms">
                <a href="slider.php">
                <div class="service-icon">
                  <i class="fa fa-image"></i>
                </div>
                <div class="service-info">
                  <h3>Trình chiếu Slide</h3>
                </div></a>
            </div>
            <div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="100ms">
                <a href='service.php'>
                <div class="service-icon">
                  <i class="fa fa-star"></i>
                </div>
                <div class="service-info">
                  <h3>Thông tin dịch vụ</h3>
                </div></a>
            </div>
            
            <div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="100ms">
                <a href="team.php">
                <div class="service-icon">
                  <i class="fa fa-group"></i>
                </div>
                <div class="service-info">
                  <h3>Đội ngũ sáng lập</h3>
                </div>
                </a>
            </div>
            <div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="100ms">
                <a href="news.php">
                <div class="service-icon">
                  <i class="fa fa-newspaper-o"></i>
                </div>
                <div class="service-info">
                  <h3>Quản lý tin tức</h3>
                </div>
                </a>
              </div>
            <div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="100ms">
                <a href="user.php">
                <div class="service-icon">
                  <i class="fa fa-user"></i>
                </div>
                <div class="service-info">
                  <h3>Quản lý tài khoản</h3>
                </div>
                </a>
              </div>
        </div>
      </div>
    </div>
  </section><!--/#services-->
    <?php } else { ?>
  <section id="services">
      <div class="container">
          <div class="col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="100ms">
              <form id="frm_login" name="frm_login" action="#" method="post"  enctype="multipart/form-data">
                <div class="form-group text-center">
                    <h2>Đăng nhập</h2>
                </div>
                <div class="form-group">
                    <input id="username" name="username" type="text" required="required" class="form-control-admin" placeholder="Tên đăng nhập"/>
                    <div id="errID" class="noti-error">Tài khoản không tồn tại</div>
                </div>
                <div class="form-group">
                    <input id="password" name="password" required="required" type="password" class="form-control-admin" placeholder="Mật khẩu"/>
                    <div id="errPass" class="noti-error">Mật khẩu không đúng</div>
                </div>
                <div class="form-group">
                    <input name="btnLogin" type="submit" value="Đăng nhập" class="btn-submit"/>
                </div>
            </form>
          </div>
      </div>
  </section>
    <?php } ?>
<?php include_once('footer.php'); ?>
</body>
</html>