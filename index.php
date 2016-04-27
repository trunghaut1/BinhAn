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
    <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
      <?php
	  	require('opendb.php');
	  	$sql = sprintf("select * from slider");
		$recordset = mysql_query($sql);
	  	while($record = mysql_fetch_array($recordset))
		{
			$active = "";
			if($record['ID'] == $info['SliderActive']) $active = " active";
			$s = sprintf('<div class="item%s" style="background-image: url(%s)">
          <div class="caption">
            <h1 class="animated fadeInLeftBig"><span>%s</span></h1>
            <p class="animated fadeInRightBig">%s</p>
            <a data-scroll class="btn btn-start animated fadeInUpBig" href="%s">%s</a>
          </div>
        </div>',$active,$record['Img'],$record['Cap1'],$record['Cap2'],$record['Href'],$record['Href_text']);
			echo $s;
		}
		require('closedb.php'); 
		?>
      </div>
      <a class="left-control" href="#home-slider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
      <a class="right-control" href="#home-slider" data-slide="next"><i class="fa fa-angle-right"></i></a>

      <a id="tohash" href="#services"><i class="fa fa-angle-down"></i></a>

    </div><!--/#home-slider-->
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
            <li class="scroll active"><a href="#home">Trang chủ</a></li>
            <li class="scroll"><a href="#services">Dịch vụ</a></li> 
            <li class="scroll"><a href="#about-us">Giới thiệu</a></li>                     
            <li class="scroll"><a href="#team">Đội ngũ</a></li>
            <li class="scroll"><a href="#blog">Tin tức</a></li>
            <li class="scroll"><a href="#contact">Liên hệ</a></li>       
          </ul>
        </div>
      </div>
    </div><!--/#main-nav-->
  </header><!--/#home-->
  <section id="services">
    <div class="container">
      <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="row">
          <div class="text-center col-sm-8 col-sm-offset-2">
            <h2>Dịch vụ của chúng tôi</h2>
          </div>
        </div> 
      </div>
      <div class="text-center our-services">
        <div class="row">
        <?php
			require('opendb.php'); 
			$sql = sprintf("select * from service");
			$recordset = mysql_query($sql);
			while($record = mysql_fetch_array($recordset))
			{
				$s = sprintf('<div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="service-icon">
              <i class="fa %s"></i>
            </div>
            <div class="service-info">
              <h3>%s</h3>
              <p>%s</p>
            </div>
          </div>',$record['Icon'],$record['Name'],$record['Description']);
				echo $s;
			}
			require('closedb.php'); 
		?>
        </div>
      </div>
    </div>
  </section><!--/#services-->
  <section id="about-us" class="parallax">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="about-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <h2>Giới thiệu</h2>
            <p class='break-word'><?php echo $info['Description']; ?></p>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="our-skills wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="single-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
              <p class="lead"></p>
              <div class="progress">
                <div class="progress-bar progress-bar-primary six-sec-ease-in-out" role="progressbar"  aria-valuetransitiongoal="95"></div>
              </div>
            </div>
            <div class="single-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="400ms">
              <p class="lead"></p>
              <div class="progress">
                <div class="progress-bar progress-bar-primary six-sec-ease-in-out" role="progressbar"  aria-valuetransitiongoal="75"></div>
              </div>
            </div>
            <div class="single-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="500ms">
              <p class="lead"></p>
              <div class="progress">
                <div class="progress-bar progress-bar-primary six-sec-ease-in-out" role="progressbar"  aria-valuetransitiongoal="60"></div>
              </div>
            </div>
            <div class="single-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
              <p class="lead"></p>
              <div class="progress">
                <div class="progress-bar progress-bar-primary six-sec-ease-in-out" role="progressbar"  aria-valuetransitiongoal="85"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!--/#about-us-->

  <section id="team">
    <div class="container">
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
          <h2>Đội ngũ sáng lập công ty</h2>
          
        </div>
      </div>
      <div class="team-members">
        <div class="row">
        <?php 
			require('opendb.php'); 
			$sql = sprintf("select * from founder");
			$recordset = mysql_query($sql);
			while($record = mysql_fetch_array($recordset))
			{
				$s = sprintf('<div class="col-sm-3">
            <div class="team-member wow flipInY" data-wow-duration="1000ms" data-wow-delay="300ms">
              <div class="member-image">
                <img class="img-responsive" src="%s" alt="">
              </div>
              <div class="member-info">
                <h3>%s</h3>
                <h4>%s</h4>
                <p>%s</p>
              </div>
              <div class="social-icons">
                <ul>
                  <li><a class="facebook" href="http://facebook.com/%s"><i class="fa fa-facebook"></i></a></li>
                  <li class="hide"><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                  <li class="hide"><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                  <li class="hide"><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                  <li class="hide"><a class="rss" href="#"><i class="fa fa-rss"></i></a></li>
                </ul>
              </div>
            </div>
          </div>',$record['Picture'],$record['Name'],$record['Position'],$record['Description'],$record['Facebook']);
				echo $s;
			}
			require('closedb.php'); 
		?>
        </div>
      </div>            
    </div>
  </section><!--/#team-->

  <section id="features" class="parallax">
    <div class="container">
      <div class="hide">
        <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
          <i class="fa fa-user"></i>
          <h3 class="timer">4000</h3>
          <p>Happy Clients</p>
        </div>
        <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
          <i class="fa fa-desktop"></i>
          <h3 class="timer">200</h3>                    
          <p>Modern Websites</p>
        </div> 
        <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="700ms">
          <i class="fa fa-trophy"></i>
          <h3 class="timer">10</h3>                    
          <p>WINNING AWARDS</p>
        </div> 
        <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="900ms">
          <i class="fa fa-comment-o"></i>                    
          <h3>24/7</h3>
          <p>Fast Support</p>
        </div>                 
      </div>
    </div>
  </section><!--/#features-->

  <section id="blog">
    <div class="container">
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
          <h2>Tin tức</h2>
        </div>
      </div>
      <div class="blog-posts">
        <div class="row">
            <?php 
            require('opendb.php'); 
            $sql = sprintf("select * from news order by ID desc limit 3");
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
        <div class="load-more wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms">
          <a href="news.php" class="btn-loadmore"><i class="fa fa-repeat"></i> Xem thêm</a>
        </div>                
      </div>
    </div>
  </section><!--/#blog-->

  
<?php include_once('footer.php'); ?>
</body>
</html>