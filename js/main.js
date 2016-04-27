jQuery(function($) {

	//Preloader
	var preloader = $('.preloader');
	$(window).load(function(){
		preloader.remove();
	});

	//#main-slider
	var slideHeight = $(window).height();
	$('#home-slider .item').css('height',slideHeight);

	$(window).resize(function(){'use strict',
		$('#home-slider .item').css('height',slideHeight);
	});
	
	//Scroll Menu
	$(window).on('scroll', function(){
		if( $(window).scrollTop()>slideHeight ){
			$('.main-nav').addClass('navbar-fixed-top');
		} else {
			$('.main-nav').removeClass('navbar-fixed-top');
		}
	});
	
	// Navigation Scroll
	$(window).scroll(function(event) {
		Scroll();
	});

	$('.navbar-collapse ul li a').on('click', function() {  
		$('html, body').animate({scrollTop: $(this.hash).offset().top - 5}, 1000);
		return false;
	});

	// User define function
	function Scroll() {
		var contentTop      =   [];
		var contentBottom   =   [];
		var winTop      =   $(window).scrollTop();
		var rangeTop    =   200;
		var rangeBottom =   500;
		$('.navbar-collapse').find('.scroll a').each(function(){
			contentTop.push( $( $(this).attr('href') ).offset().top);
			contentBottom.push( $( $(this).attr('href') ).offset().top + $( $(this).attr('href') ).height() );
		})
		$.each( contentTop, function(i){
			if ( winTop > contentTop[i] - rangeTop ){
				$('.navbar-collapse li.scroll')
				.removeClass('active')
				.eq(i).addClass('active');			
			}
		})
	};

	$('#tohash').on('click', function(){
		$('html, body').animate({scrollTop: $(this.hash).offset().top - 5}, 1000);
		return false;
	});
	
	//Initiat WOW JS
	new WOW().init();
	//smoothScroll
	smoothScroll.init();
	
	// Progress Bar
	$('#about-us').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
		if (visible) {
			$.each($('div.progress-bar'),function(){
				$(this).css('width', $(this).attr('aria-valuetransitiongoal')+'%');
			});
			$(this).unbind('inview');
		}
	});

	//Countdown
	$('#features').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
		if (visible) {
			$(this).find('.timer').each(function () {
				var $this = $(this);
				$({ Counter: 0 }).animate({ Counter: $this.text() }, {
					duration: 2000,
					easing: 'swing',
					step: function () {
						$this.text(Math.ceil(this.Counter));
					}
				});
			});
			$(this).unbind('inview');
		}
	});

	// Portfolio Single View
	$('#portfolio').on('click','.folio-read-more',function(event){
		event.preventDefault();
		var link = $(this).data('single_url');
		var full_url = '#portfolio-single-wrap',
		parts = full_url.split("#"),
		trgt = parts[1],
		target_top = $("#"+trgt).offset().top;

		$('html, body').animate({scrollTop:target_top}, 600);
		$('#portfolio-single').slideUp(500, function(){
			$(this).load(link,function(){
				$(this).slideDown(500);
			});
		});
	});

	// Close Portfolio Single View
	$('#portfolio-single-wrap').on('click', '.close-folio-item',function(event) {
		event.preventDefault();
		var full_url = '#portfolio',
		parts = full_url.split("#"),
		trgt = parts[1],
		target_offset = $("#"+trgt).offset(),
		target_top = target_offset.top;
		$('html, body').animate({scrollTop:target_top}, 600);
		$("#portfolio-single").slideUp(500);
	});

	// Contact form
	var form = $('#main-contact-form');
	form.submit(function(event){
		event.preventDefault();
		var form_status = $('<div class="form_status"></div>');
		$.ajax({
			url: $(this).attr('action'),
			beforeSend: function(){
				form.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Đang gửi Email...</p>').fadeIn() );
			}
		}).done(function(data){
			form_status.html('<p class="text-success">Cảm ơn bạn đã liên lạc với chúng tôi, chúng tôi sẽ trả lời thư trong thời gian sớm nhất có thể!</p>').delay(3000).fadeOut();
		});
	});

	//Google Map
	var latitude = $('#google-map').data('latitude')
	var longitude = $('#google-map').data('longitude')
	function initialize_map() {
		var myLatlng = new google.maps.LatLng(latitude,longitude);
		var mapOptions = {
			zoom: 14,
			scrollwheel: false,
			center: myLatlng
		};
		var map = new google.maps.Map(document.getElementById('google-map'), mapOptions);
		var contentString = '';
		var infowindow = new google.maps.InfoWindow({
			content: '<div class="map-content"><ul class="address">' + $('.address').html() + '</ul></div>'
		});
		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map
		});
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
		});
	}
	google.maps.event.addDomListener(window, 'load', initialize_map);
	
});
var loadImgFile = function(event) {
    var output = document.getElementById('img_preview');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
$("#frm_login").submit(function(event) {
    var username = $("#username").val();
    var password = $("#password").val();
    $.ajax({
       type: "POST",
       url: "process.php",
       data: "user=" + username + "&pass=" + password,
       success: function(value) {
           if(value == "errID") $("#errID").css('display','inherit').delay(3000).fadeOut();
           if(value == "errPass") $("#errPass").css('display','inherit').delay(3000).fadeOut();
           if(value == "success") window.location="index.php";
       }
    });
    event.preventDefault();
});
$("#frm_info").submit(function(event) {
    var data = new FormData($(this)[0]);
    $.ajax({
       type: "POST",
       url: "process.php",
       data: data,
       async: false,
       cache: false,
       processData: false,
       contentType: false,
       success: function(value) {
           if(value == "success") {
               window.location="info.php?success";
           } else {
               $("#err").css('display','inherit').delay(3000).fadeOut();
           }
       }
    });
    event.preventDefault();
});
$("#frm_slider_add").submit(function(event) {
    var data = new FormData($(this)[0]);
    data.append("SliderAdd","1");
    $.ajax({
       type: "POST",
       url: "process.php",
       data: data,
       async: false,
       cache: false,
       processData: false,
       contentType: false,
       success: function(value) {
           if(value == "add_done") {
               window.location="slider.php?add=success";
           }
           else {
               $("#err_add").css('display','inherit').delay(3000).fadeOut();
           }
       }
    });
    event.preventDefault();
});
$("#frm_slider_edit").submit(function(event) {
    var data = new FormData($(this)[0]);
    data.append("SliderEdit","1");
    $.ajax({
       type: "POST",
       url: "process.php",
       data: data,
       async: false,
       cache: false,
       processData: false,
       contentType: false,
       success: function(value) {
           if(value == "edit_done") {
               var id = $("#txtID").val();
               window.location="slider.php?edit="+id+"&success";
           }
           else {
               $("#err_edit").css('display','inherit').delay(3000).fadeOut();
           }
       }
    });
    event.preventDefault();
});
$("#frm_service_add").submit(function(event) {
    var data = $(this).serialize() + "&ServiceAdd=";
    $.ajax({
       type: "POST",
       url: "process.php",
       data: data,
       success: function(value) {
           if(value == "success") {
               window.location="service.php?add=success";
           }
           else {
               $("#err_add").css('display','inherit').delay(3000).fadeOut();
           }
       }
    });
    event.preventDefault();
});
$("#frm_service_edit").submit(function(event) {
    var data = $(this).serialize() + "&ServiceEdit=";
    $.ajax({
       type: "POST",
       url: "process.php",
       data: data,
       success: function(value) {
           if(value == "success") {
               var id = $("#txtID").val();
               window.location="service.php?edit="+id+"&success";
           }
           else {
               $("#err_edit").css('display','inherit').delay(3000).fadeOut();
           }
       }
    });
    event.preventDefault();
});
$("#frm_team_add").submit(function(event) {
    var data = new FormData($(this)[0]);
    data.append("TeamAdd","1");
    $.ajax({
       type: "POST",
       url: "process.php",
       data: data,
       async: false,
       cache: false,
       processData: false,
       contentType: false,
       success: function(value) {
           if(value == "success") {
               window.location="team.php?add=success";
           }
           else {
               $("#err_add").css('display','inherit').delay(3000).fadeOut();
           }
       }
    });
    event.preventDefault();
});
$("#frm_team_edit").submit(function(event) {
    var data = new FormData($(this)[0]);
    data.append("TeamEdit","1");
    $.ajax({
       type: "POST",
       url: "process.php",
       data: data,
       async: false,
       cache: false,
       processData: false,
       contentType: false,
       success: function(value) {
           if(value == "success") {
               var id = $("#txtID").val();
               window.location="team.php?edit="+id+"&success";
           }
           else {
               $("#err_edit").css('display','inherit').delay(3000).fadeOut();
           }
       }
    });
    event.preventDefault();
});
$("#frm_news_add").submit(function(event) {
    var data = new FormData($(this)[0]);
    data.append("NewsAdd","1");
    $.ajax({
       type: "POST",
       url: "process.php",
       data: data,
       async: false,
       cache: false,
       processData: false,
       contentType: false,
       success: function(value) {
           if(value == "success") {
               window.location="news.php?add=success";
           }
           else {
               $("#err_add").css('display','inherit').delay(3000).fadeOut();
           }
       }
    });
    event.preventDefault();
});
$("#frm_news_edit").submit(function(event) {
    var data = new FormData($(this)[0]);
    data.append("NewsEdit","1");
    $.ajax({
       type: "POST",
       url: "process.php",
       data: data,
       async: false,
       cache: false,
       processData: false,
       contentType: false,
       success: function(value) {
           if(value == "success") {
               var id = $('#txtID').val();
               window.location="news.php?edit=" + id + "&success";
           }
           else {
               $("#err_edit").css('display','inherit').delay(3000).fadeOut();
           }
       }
    });
    event.preventDefault();
});
function checkRePass(pass,repass) {
    if(pass != repass) {
        $("#errRePass").css('display','inherit').delay(3000).fadeOut();
        return false;
    }
    return true;
}
$("#frm_user_add").submit(function(event) {
    event.preventDefault();
    if(!checkRePass($("#txtPass").val(),$("#txtRePass").val())) return;
    var data = $(this).serialize() + "&UserAdd=";
    $.ajax({
       type: "POST",
       url: "process.php",
       data: data,
       success: function(value) {
           if(value == "success") {
               window.location="user.php?add=success";
           }
           else {
               $("#err_add").css('display','inherit').delay(3000).fadeOut();
           }
       }
    }); 
});
$("#frm_user_edit").submit(function(event) {
    event.preventDefault();
    if(!checkRePass($("#txtNewPass").val(),$("#txtRePass").val())) return;
    var data = $(this).serialize() + "&UserEdit=";
    $.ajax({
       type: "POST",
       url: "process.php",
       data: data,
       success: function(value) {
           if(value == "success") {
               var id = $("#txtID").val();
               window.location="user.php?edit=" + id + "&success";
           }
           else {
               if(value == "error_pass")
                   $("#errPass").css('display','inherit').delay(3000).fadeOut();
               else
                    $("#err_edit").css('display','inherit').delay(3000).fadeOut();
           }
       }
    });
});