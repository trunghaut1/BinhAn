<!DOCTYPE html>
<html lang="en">
<?php 
require('opendb.php'); 
$sql = sprintf("select * from information");
$info = mysql_fetch_assoc(mysql_query($sql));
require('closedb.php'); 
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php  echo $info['LongName']; ?></title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet"> 
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/lightbox.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link id="css-preset" href="css/presets/preset4.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">

  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="images/favicon.ico">
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
          <a class="navbar-brand" href="index.php">
            <h1><img class="img-responsive" src="images/logo.png" alt="logo"></h1>
          </a>                    
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">                 
            <li class="scroll"><a href="index.php">Trang chủ</a></li>
            <li class="scroll"><a href="index.php#services">Dịch vụ</a></li> 
            <li class="scroll"><a href="index.php#about-us">Giới thiệu</a></li>                     
            <li class="scroll"><a href="index.php#team">Đội ngũ</a></li>
            <li class="scroll active"><a href="news.php">Tin tức</a></li>
            <li class="scroll"><a href="#contact">Liên hệ</a></li>       
          </ul>
        </div>
      </div>
    </div><!--/#main-nav-->
  </header><!--/#home-->
  <section id="blog">
    <div class="container">
        <?php 
        if(isset($_REQUEST['id']))
        { 
            require('opendb.php'); 
            $sql = sprintf('select * from news where ID = "%s"',$_REQUEST['id']);
            $record = mysql_fetch_assoc(mysql_query($sql));
            require('closedb.php'); 
            ?>
        <div class='row'>
            <div class="text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
          <h2><?php echo $record['Title']; ?></h2>
        </div>
        </div>
        <div class='row'>
            <div class="col-sm-12 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
          <?php echo $record['Content']; ?>
        </div>
        </div>
        <?php } else { ?>
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
          <h2>Tin tức</h2>
        </div>
      </div>
      <div class="blog-posts">
        <div class="row">
            <?php 
            require('opendb.php'); 
            $sql = sprintf("select * from news order by ID desc");
            $recordset = mysql_query($sql);
            while($record = mysql_fetch_array($recordset))
            {
                $date = strtotime($record['Date']);
                $s = sprintf('<div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">
            <div class="post-thumb">
              <a href="news.php?id=%s"><img class="img-responsive img-news-thum" src="%s" alt=""></a> 
            </div>
            <div class="entry-header">
              <h3><a href="news.php?id=%s">%s</a></h3>
              <span class="date">%s</span>
            </div>
            <div class="entry-content">
              <p>%s</p>
            </div>
          </div>',$record['ID'],$record['Picture'],$record['ID'],$record['Title'],date('d/m/Y',$date),$record['Description']);
                echo $s;
            } 
            require('closedb.php'); 
            ?>
        </div>                
      </div>
        <?php } ?>
    </div>
  </section><!--/#blog-->

  
<?php include_once('footer.php'); ?>
</body>
</html>