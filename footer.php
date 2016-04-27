<section id="contact">
    <?php 
		require('opendb.php'); 
		$sql = sprintf("select * from googlemaps");
		$map = mysql_fetch_assoc(mysql_query($sql));
		require('closedb.php'); 
	?>
    <div id="google-map" class="wow fadeIn" data-latitude="<?php echo $map['Latitude']; ?>" data-longitude="<?php echo $map['Longitude']; ?>" data-wow-duration="1000ms" data-wow-delay="400ms"></div>
    <div id="contact-us" class="parallax">
      <div class="container">
        <div class="row">
          <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <h2>Liên hệ</h2>
            <p>Mọi thông tin liên hệ quý khách vui lòng xem thông tin bên dưới, hoặc có thể gửi thư trực tiếp cho chúng tôi thông qua biểu mẫu. Cảm ơn quý khách đã quan tâm đến công ty!</p>
          </div>
        </div>
        <div class="contact-form wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
          <div class="row">
            <div class="col-sm-6">
              <form id="main-contact-form" name="contact-form" method="post" action="#">
                <div class="row  wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="name" class="form-control" placeholder="Tên" required="required">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="email" name="email" class="form-control" placeholder="Địa chỉ Email" required="required">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" name="subject" class="form-control" placeholder="Tiêu đề" required="required">
                </div>
                <div class="form-group">
                  <textarea name="message" id="message" class="form-control" rows="4" placeholder="Nội dung" required></textarea>
                </div>                        
                <div class="form-group">
                  <button type="submit" class="btn-submit">Gửi</button>
                </div>
              </form>   
            </div>
            <div class="col-sm-6">
              <div class="contact-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                <p><b><?php echo $info['LongName']; ?></b></p>
                <ul class="address">
                  <li><i class="fa fa-map-marker"></i> <span> Địa chỉ:</span> <?php echo $info['Address']; ?> </li>
                  <li><i class="fa fa-phone"></i> <span> Điện thoại:</span> <?php echo $info['Phone1']; ?>  </li>
                  <?php if($info['Phone2'] === NULL) {} else { ?>
                  <li><i class="fa fa-phone"></i> <span> Điện thoại:</span> <?php echo $info['Phone2']; ?>  </li>
                  <?php } ?>
                  <?php if($info['Fax'] === NULL) {} else { ?>
                  <li><i class="fa fa-fax"></i> <span> Fax:</span> <?php echo $info['Fax']; ?>  </li>
                  <?php } ?>
                  <li><i class="fa fa-envelope"></i> <span> Email:</span><a href="mailto:<?php echo $info['Email']; ?>"> <?php echo $info['Email']; ?></a></li>
                  <li><i class="fa fa-clock-o"></i> <span> Giờ làm việc:</span> <?php echo $info['OpenHour']; ?> </li>
                  <li><i class="fa fa-globe"></i> <span> Website:</span> <a href="index.php"><?php echo $_SERVER['HTTP_HOST']; ?></a></li>
                </ul>
              </div>                            
            </div>
          </div>
        </div>
      </div>
    </div>        
  </section><!--/#contact-->
  
<footer id="footer">
    <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
      <div class="container text-center">
        <div class="footer-logo">
          <a href="index.php"><img class="img-responsive" src="images/logo.png" alt=""></a>
        </div>
        <div class="social-icons">
          <ul>
            <li><a class="envelope" href="mailto:<?php echo $info['Email']; ?>"><i class="fa fa-envelope"></i></a></li>
            <li class="hide"><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li> 
            <li class="hide"><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
            <?php if($info['Facebook'] === NULL) {} else { ?>
            <li><a class="facebook" href="http://facebook.com/<?php echo $info['Facebook']; ?>"><i class="fa fa-facebook"></i></a></li>
			<?php } ?>
            <li class="hide"><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            <li class="hide"><a class="tumblr" href="#"><i class="fa fa-tumblr-square"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <p>&copy; 2016 <?php echo $info['ShortName']; ?>.</p>
          </div>
          <div class="col-sm-6">
            <p class="pull-right">Thiết kế bởi <a href="http://designscrazed.org/">Allie</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script type="text/javascript" src="js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="js/wow.min.js"></script>
  <script type="text/javascript" src="js/mousescroll.js"></script>
  <script type="text/javascript" src="js/smoothscroll.js"></script>
  <script type="text/javascript" src="js/jquery.countTo.js"></script>
  <script type="text/javascript" src="js/lightbox.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>