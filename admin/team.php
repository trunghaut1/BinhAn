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
            <li class="scroll"><a href="info.php">Thông tin</a></li>
            <li class="scroll"><a href="slider.php">Slide</a></li>
            <li class="scroll"><a href="service.php">Dịch vụ</a></li>
            <li class="scroll active"><a href="team.php">Đội ngũ</a></li>
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
    if(isset($_REQUEST['edit']))
    { ?>
  <section id="services">
    <div class="container">
        <div class="row">
          <div class="text-center col-sm-8 col-sm-offset-2 wow fadeInDown" data-wow-duration="1000ms">
            <h2>Chỉnh sửa thông tin</h2>
          </div>
        </div> 
          <form id="frm_team_edit" name="frm_team_edit" method="post" enctype="multipart/form-data" action="#">
              <?php 
              require('../opendb.php'); 
              $sql = sprintf('select * from founder where ID = "%s"',$_REQUEST['edit']);
              $record = mysql_fetch_assoc(mysql_query($sql));
              require('../closedb.php'); 
              ?>
              <input id="txtID" name="txtID" type="text" value="<?php echo $record['ID']; ?>" hidden="true"/>
        <div class="row form-group">
              <div class="col-sm-2 form-center">Tên:</div>
              <div class='col-sm-10'>
                  <?php if(isset($_REQUEST['success'])) { ?>
                  <div class="noti-success wow fadeOut" data-wow-duration="1000ms" data-wow-delay="3000ms">Đã cập nhật!</div><?php } ?>
                  <input name="txtName" required="required" type="text" class="form-control-admin" value="<?php echo $record['Name']; ?>"/>
              </div>
        </div>
              <div class="row form-group">
              <div class="col-sm-2 form-center">Vị trí:</div>
              <div class='col-sm-10'>
                  <input name="txtPos" required="required" type="text" class="form-control-admin" value="<?php echo $record['Position']; ?>"/>
              </div>
        </div>
          <div class="row form-group">
              <div class="col-sm-2 form-center">Mô tả:</div>
              <div class='col-sm-10'>
                  <textarea name="txtDes" required="required" class="form-control-admin"><?php echo $record['Description']; ?></textarea>
              </div>
        </div>
          <div class="row form-group">
              <div class="col-sm-2 form-center">Ảnh đại diện:</div>
              <div class='col-sm-8'>
                  <input type="file" id="imgPic" name="imgPic" class='form-control-admin' accept="image/*" onchange="loadImgFile(event)"/>
              </div>
              <div class='col-sm-2'>
                  <img name='img_preview' id='img_preview' class="img-preview" <?php
                  if($record['Picture'] != '') echo 'src="../'.$record['Picture'].'"'; ?>/>
              </div>
        </div>
              <div class="row form-group">
              <div class="col-sm-2 form-center">Facebook:</div>
              <div class='col-sm-10'>
                  <input name="txtFacebook" type="text" class="form-control-admin" value="<?php echo $record['Facebook']; ?>"/>
              </div>
        </div>
          <div class="row">
              <div class='col-sm-2'></div>
              <div class='col-sm-5'>
                  <input name="btnTeamEdit" type="submit" value="Cập nhật" class='btn-submit'/>
                  <div id='err_edit' class="noti-error">Cập nhật thất bại, vui lòng kiểm tra lại thông tin!</div>
              </div>
              <div class='col-sm-5'>
                  <a href="team.php"><input name="btnCancel" type="button" value="Hủy" class='btn-submit'/></a>
              </div>
        </div>
        </form>
    </div>
  </section><!--/#services-->
    <?php } else if(isset ($_REQUEST['add'])) { ?>
  <section id="services">
    <div class="container">
        <div class="row">
          <div class="text-center col-sm-8 col-sm-offset-2 wow fadeInDown" data-wow-duration="1000ms">
            <h2>Thêm mới</h2>
          </div>
        </div> 
          <form id="frm_team_add" name="frm_team_add" method="post" enctype="multipart/form-data" action="#">
        <div class="row form-group">
              <div class="col-sm-2 form-center">Tên:</div>
              <div class='col-sm-10'>
                  <?php if($_REQUEST['add'] == 'success') { ?>
                  <div class="noti-success wow fadeOut" data-wow-duration="1000ms" data-wow-delay="3000ms">Đã thêm!</div><?php } ?>
                  <input name="txtName" required="required" type="text" class="form-control-admin"/>
              </div>
        </div>
              <div class="row form-group">
              <div class="col-sm-2 form-center">Vị trí:</div>
              <div class='col-sm-10'>
                  <input name="txtPos" required="required" type="text" class="form-control-admin"/>
              </div>
        </div>
          <div class="row form-group">
              <div class="col-sm-2 form-center">Mô tả:</div>
              <div class='col-sm-10'>
                  <textarea name="txtDes" required="required" class="form-control-admin"></textarea>
              </div>
        </div>
          <div class="row form-group">
              <div class="col-sm-2 form-center">Ảnh đại diện:</div>
              <div class='col-sm-8'>
                  <input type="file" id="imgPic" required="required" name="imgPic" class='form-control-admin' accept="image/*" onchange="loadImgFile(event)"/>
              </div>
              <div class='col-sm-2'>
                  <img name='img_preview' id='img_preview' class="img-preview"/>
              </div>
        </div>
              <div class="row form-group">
              <div class="col-sm-2 form-center">Facebook:</div>
              <div class='col-sm-10'>
                  <input name="txtFacebook" type="text" class="form-control-admin"/>
              </div>
        </div>
          <div class="row">
              <div class='col-sm-2'></div>
              <div class='col-sm-5'>
                  <input name="btnTeamAdd" type="submit" value="Thêm" class='btn-submit'/>
                  <div id='err_add' class="noti-error">Thêm thất bại, vui lòng kiểm tra lại thông tin!</div>
              </div>
              <div class='col-sm-5'>
                  <a href="team.php"><input name="btnCancel" type="button" value="Hủy" class='btn-submit'/></a>
              </div>
        </div>
        </form>
    </div>
  </section><!--/#services-->
    <?php } else { ?>
  <section id="services">
      <div class="container">
          <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="100ms">
        <div class="row">
          <div class="text-center col-sm-8 col-sm-offset-2">
            <h2>Danh sách Đội ngũ sáng lập</h2>
          </div>
        </div>
              <div class="row form-group">
                  <div class="col-sm-3">
                      <?php if(isset($_REQUEST['error'])) { ?>
                  <div class="noti-error-show wow fadeOut" data-wow-duration="1000ms" data-wow-delay="3000ms">Xóa thất bại!</div><?php } ?>
                      <a href="team.php?add"><input type="button" class="btn-submit margin-top-5" value="Thêm mới"/></a>
                  </div>
              </div>
              <div class="row">
                  <b>
                  <div class="col-sm-1">Ảnh</div>
                  <div class="col-sm-2">Tên</div>
                  <div class="col-sm-2">Vị trí</div>
                  <div class="col-sm-3">Mô tả</div>
                  <div class="col-sm-2">Facebook</div>
                  <div class="col-sm-1">Sửa</div>
                  <div class="col-sm-1">Xóa</div>
                  </b>
              </div>
              <hr>
              <?php
              require('../opendb.php'); 
              $sql = sprintf('select * from founder');
              $recordset = mysql_query($sql);
              while($record = mysql_fetch_array($recordset))
              {
                  $s = sprintf('<div class="row">
                  <div class="col-sm-1"><img class="img-news-list" src="../%s"/></div>
                  <div class="col-sm-2">%s</div>
                  <div class="col-sm-2">%s</div>
                  <div class="col-sm-3">%s</div>
                  <div class="col-sm-2">%s</div>
                  <div class="col-sm-1"><a href="team.php?edit=%s">Sửa</a></div>
                  <div class="col-sm-1"><a href="process.php?team_del=%s" onClick="return confirm(\'Bạn có chắc muốn xóa!\');">Xóa</a></div>
              </div>',$record['Picture'],$record['Name'],$record['Position'],$record['Description'],$record['Facebook'],$record['ID'],$record['ID']);
                  echo $s;
                  echo "<hr class='hr-list'>";
              }
              require('../closedb.php'); 
              ?>
      </div>
      </div>
  </section>
    <?php } ?>
<?php include_once('footer.php'); ?>
</body>
</html>