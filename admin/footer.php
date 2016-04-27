 
<footer id="footer">
    <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
      <div class="container text-center">
        <div class="footer-logo">
          <a href="../index.php"><img class="img-responsive" src="../images/logo.png" alt=""></a>
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

  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script type="text/javascript" src="../js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="../js/wow.min.js"></script>
  <script type="text/javascript" src="../js/mousescroll.js"></script>
  <script type="text/javascript" src="../js/smoothscroll.js"></script>
  <script type="text/javascript" src="../js/jquery.countTo.js"></script>
  <script type="text/javascript" src="../js/lightbox.min.js"></script>
  <script type="text/javascript" src="../js/main.js"></script>