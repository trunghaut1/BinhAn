<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
if(!isset($_SESSION['admin']))
    header ('Location:index.php');
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
            <li class="scroll"><a href="index.php">Quản trị</a></li>
            <li class="scroll active"><a href="info.php">Thông tin</a></li>
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
  <section id="services">
    <div class="container">
        <div class="row">
          <div class="text-center col-sm-8 col-sm-offset-2 wow fadeInDown" data-wow-duration="1000ms">
            <h2>Chỉnh sửa thông tin</h2>
          </div>
        </div> 
          <form id="frm_info" name="frm_info" method="post" enctype="multipart/form-data" action="#">
              <?php 
              require('../opendb.php'); 
              $sql = sprintf('select * from information, googlemaps');
              $record = mysql_fetch_assoc(mysql_query($sql));
              $des = str_replace("<br/>", "", $record['Description']);
              require('../closedb.php'); 
              ?>
        <div class="row form-group">
              <div class="col-sm-2 form-center">Tên ngắn:</div>
              <div class='col-sm-10'>
                  <?php if(isset($_REQUEST['success'])) { ?><div class="noti-success wow fadeOut" data-wow-duration="1000ms" data-wow-delay="3000ms">Đã cập nhật thông tin!</div> <?php } ?>
                  <input name="txtShortName" required="required" type="text" class="form-control-admin" value="<?php echo $record['ShortName']; ?>"/>
              </div>
        </div>
              <div class="row form-group">
              <div class="col-sm-2 form-center">Tên đầy đủ:</div>
              <div class='col-sm-10'>
                  <input name="txtLongName" required="required" type="text" class="form-control-admin" value="<?php echo $record['LongName']; ?>"/>
              </div>
        </div>
          <div class="row form-group">
              <div class="col-sm-2 form-center">Mô tả công ty:</div>
              <div class='col-sm-10'>
                  <textarea id="txtDes" name="txtDes" required="required" class="form-control-admin textarea-des"><?php echo $des; ?></textarea>
              </div>
        </div>
              <div class="row form-group">
              <div class="col-sm-2 form-center">Địa chỉ Email:</div>
              <div class='col-sm-10'>
                  <input name="txtEmail" required="required" type="text" class="form-control-admin" value="<?php echo $record['Email']; ?>"/>
              </div>
        </div>
              <div class="row form-group">
              <div class="col-sm-2 form-center">Số điện thoại 1:</div>
              <div class='col-sm-10'>
                  <input name="txtPhone1" required="required" type="text" class="form-control-admin" value="<?php echo $record['Phone1']; ?>"/>
              </div>
        </div>
              <div class="row form-group">
              <div class="col-sm-2 form-center">Số điện thoại 2:</div>
              <div class='col-sm-10'>
                  <input name="txtPhone2" type="text" class="form-control-admin" value="<?php echo $record['Phone2']; ?>"/>
              </div>
        </div>
              <div class="row form-group">
              <div class="col-sm-2 form-center">Fax:</div>
              <div class='col-sm-10'>
                  <input name="txtFax" type="text" class="form-control-admin" value="<?php echo $record['Fax']; ?>"/>
              </div>
        </div>
              <div class="row form-group">
              <div class="col-sm-2 form-center">Địa chỉ:</div>
              <div class='col-sm-10'>
                  <input name="txtAddress" required="required" type="text" class="form-control-admin" value="<?php echo $record['Address']; ?>"/>
              </div>
        </div>
              <div class="row form-group">
              <div class="col-sm-2 form-center">Giờ làm việc:</div>
              <div class='col-sm-10'>
                  <input name="txtOpenHour" required="required" type="text" class="form-control-admin" value="<?php echo $record['OpenHour']; ?>"/>
              </div>
        </div>
              <div class="row form-group">
              <div class="col-sm-2 form-center">Facebook:</div>
              <div class='col-sm-6'>
                  <input name="txtFacebook" type="text" class="form-control-admin" value="<?php echo $record['Facebook']; ?>"/>
              </div>
              <div class='col-sm-4'>VD: http://facebook.com/<b><span style="color:red;">Facebook</span></b><p>(Lấy phần tô đỏ)</p></div>
        </div>
          <div class="row form-group">
              <div class="col-sm-2 form-center">Logo:</div>
              <div class='col-sm-6'>
                  <input id="imgPic" type="file" name="imgPic" class='form-control-admin' accept="image/*" onchange="loadImgFile(event)"/>
              </div>
              <div class='col-sm-4'>
                  <img name='img_preview' id='img_preview' class="logo-preview" src='../images/logo.png'/>
              </div>
        </div>
              <div class="row form-group">
              <div class="col-sm-2 form-center">Bản đồ Google Maps:</div>
              <div class="col-sm-1 form-center">Latitude:</div>
              <div class='col-sm-2'>
                  <input name="txtLatitude" type="text" class="form-control-admin" value="<?php echo $record['Latitude']; ?>"/>
              </div>
              <div class="col-sm-1 form-center">Longitude:</div>
              <div class='col-sm-2'>
                  <input name="txtLongitude" type="text" class="form-control-admin" value="<?php echo $record['Longitude']; ?>"/>
              </div>
              <div class="col-sm-4 form-center">Lấy 2 thông số trên thanh Address</div>
        </div>
              <div class='row'>
                  <div class="col-sm-12">
                      <img src='../images/maps.jpg'/>
                  </div>
              </div>
          <div class="row">
              <div class='col-sm-2'></div>
              <div class='col-sm-5'>
                  <input name="btnInfoUpdate" type="submit" value="Cập nhật" class='btn-submit'/>
                  <div id="err" class="noti-error">Cập nhật thất bại, vui lòng kiểm tra lại thông tin!</div>
              </div>
              <div class='col-sm-5'>
                  <a href="index.php"><input name="btnCancel" type="button" value="Hủy" class='btn-submit'/></a>
              </div>
        </div>
        </form>
    </div>
  </section><!--/#services-->
<?php include_once('footer.php'); ?>
</body>
</html>