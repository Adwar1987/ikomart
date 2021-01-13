(function ($) {

	// Pop Up Modal Discount for First Time Buy
	/*
	$('#btn-subscribe-submit').click(function(){
		$(this).prop('disabled', true);
		$(this).html('<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i>');
		var that 	= $(this);
		var parent 	= $('#subscribe-form');
		var info 	= $('#info-block');
		var success = $('#success-block');
		var email 	= $('#txt-email').val();
		var token 	= $('#_token').val();
		if (email == '') {
			parent.find('.form-group').addClass('has-error');
			info.html('Mohon masukkan email Anda');
			that.html('Ya, kirimkan!');
			that.prop('disabled', false);
			return false;
		}
		else{
			$.ajax({
				type: "post",
	            url: "/subscribes/validate/",
	            dataType: 'json',
	            data: { email: email, _token: token },
	            error: function() {
	                console.log('error');
	                that.html('Ya, kirimkan!');
	                that.prop('disabled', false);
	            },
	            success: function(responses) {
	                if (responses['message']['type'] == 'error') {
	                	parent.find('.form-group').addClass('has-error');
						info.html(responses['message']['desc']);
						that.html('Ya, kirimkan!');
						that.prop('disabled', false);
						return false;
	                }
	                else{
	                	setCookie('user_email', email, 3);
	                	parent.addClass('none');
	                	success.removeClass('none');
	                	success.html(responses['message']['desc']);
	                	return true;
	                }
	            }
	        });
		}
	});
	*/

	$('#txt-email').keyup(function(){
		$(this).parent().removeClass('has-error');
		$('#info-block').html('');
	});

	// Home Banner
    var mySwiper = new Swiper ('.banner-container .swiper-container', {
		direction: 'horizontal',
		loop: true,
		autoplay: 5000,
		updateOnImagesReady: true,
		pagination: '.banner-container .swiper-pagination',
        paginationClickable: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
    });

	// Binding Click Swiper
	$(".swiper-container .swiper-slide a").bind("click", function() {
		window.location.href=$(this).attr('href');
	});

	/*mySwiper.on('touchEnd', function () {
		mixpanel.track("Swipe Banner Link", {
			"User Identity" : user_identity
		});
	}); */

	/*var sourceSwap = function () {
	    var that = $(this);
	    var newSource = that.data('hover-src');
	    that.data('hover-src', that.attr('src'));
	    that.attr('src', newSource);
	}

	$('img.hovering').hover(sourceSwap, sourceSwap);*/

	// success msg for create password and verify email
	if ($("[name=success_verify_email]").val()) {
		GeneralMessage.animate_success_message($("[name=success_verify_email]").val());
	}

	if ($("[name=success_create_password]").val()) {
		GeneralMessage.animate_success_message($("[name=success_create_password]").val());
	}

	if ($("[name=unsuccessful_verify_email]").val()) {
		GeneralMessage.animate_error_message($("[name=unsuccessful_verify_email]").val());
	}

	// SWIPER FOR MAIN IMAGE (1/2 GRID / Seasonal Banner)
	$(".mainimg-item .swiper-container").each(function(index, element){
	    var that = $(this);
	    that.addClass("instance-mainimg-" + index);
	    that.find(".swiper-button-prev").addClass("btn-prev-" + index);
	    that.find(".swiper-button-next").addClass("btn-next-" + index);
	    var swiper_mainimg = new Swiper(".instance-mainimg-" + index, {
	        slidesPerView: __slick_2,
			spaceBetween: 15,
			preloadImages: false,
			lazyLoading: true,
			slidesPerGroup: __slick_2,
	        nextButton: ".btn-next-" + index,
	        prevButton: ".btn-prev-" + index,
	    });

	    if(swiper_mainimg.slides.length <= __slick_2) {
	    	that.find(".btn-prev-" + index).hide();
	        that.find(".btn-next-" + index).hide();
	    }

		swiper_mainimg.on('touchEnd', function () {
			//mixpanel.track("Swipe Seasonal Product", {
			//	"User Identity" : user_identity
			//});
		});
	});

	$(".mainimg-item2 .swiper-container").each(function(index, element){
	    var that = $(this);
	    that.addClass("instance-mainimg-" + index);
	    that.find(".swiper-button-prev").addClass("btn-prev-" + index);
	    that.find(".swiper-button-next").addClass("btn-next-" + index);
	    var swiper_mainimg = new Swiper(".instance-mainimg-" + index, {
	        slidesPerView: 1,
			spaceBetween: 15,
			preloadImages: false,
			lazyLoading: true,
			slidesPerGroup: 1,
	        nextButton: ".btn-next-" + index,
	        prevButton: ".btn-prev-" + index,
	    });

	    if(swiper_mainimg.slides.length <= 2) {
	    	that.find(".btn-prev-" + index).hide();
	        that.find(".btn-next-" + index).hide();
	    }

		swiper_mainimg.on('touchEnd', function () {
			//mixpanel.track("Swipe Seasonal Product", {
			//	"User Identity" : user_identity
			//});
		});
	});

	// SWIPER MAIN WITHOUT SIDE IMAGE
	$(".sw-product-list-main .swiper-container").each(function(index, element){
	    var that = $(this);
	    that.addClass("instance-" + index);
	    that.find(".swiper-button-prev").addClass("btn-prev-" + index);
	    that.find(".swiper-button-next").addClass("btn-next-" + index);
	    var swiper_main = new Swiper(".instance-" + index, {
	        slidesPerView: __slick_4,
			spaceBetween: 15,
			preloadImages: false,
			lazyLoading: true,
			slidesPerGroup: __slick_4,
	        nextButton: ".btn-next-" + index,
	        prevButton: ".btn-prev-" + index,
	    });

	    if(swiper_main.slides.length <= __slick_4) {
	    	that.find(".btn-prev-" + index).hide();
	        that.find(".btn-next-" + index).hide();
	    }

	    if(swiper_main.container.hasClass("instance-1")) {
			swiper_main.on('touchEnd', function () {
				//mixpanel.track("Swipe Popular Product", {
				//	"User Identity" : user_identity
				//});
			});
		}
	});

	// SWIPER MAIN SIDE IMAGE
	$(".sideimg-item .swiper-container").each(function(index, element){
	    var that = $(this);
	    that.addClass("instance-sideimg-" + index);
	    that.find(".swiper-button-prev").addClass("btn-prev-" + index);
	    that.find(".swiper-button-next").addClass("btn-next-" + index);
	    var swiper_sideimg = new Swiper(".instance-sideimg-" + index, {
	        slidesPerView: __slick_4,
			spaceBetween: 15,
			preloadImages: false,
			lazyLoading: true,
			slidesPerGroup: __slick_4,
	        nextButton: ".btn-next-" + index,
	        prevButton: ".btn-prev-" + index,
	    });

	    if(swiper_sideimg.slides.length <= __slick_4) {
	    	that.find(".btn-prev-" + index).hide();
	        that.find(".btn-next-" + index).hide();
	    }

		if(swiper_sideimg.container.hasClass("instance-sideimg-0")) {
			swiper_sideimg.on('touchEnd', function () {
				//mixpanel.track("Swipe Recommended Product", {
				//	"User Identity" : user_identity
				//});
			});
		}
		else if(swiper_sideimg.container.hasClass("instance-sideimg-1")) {
			swiper_sideimg.on('touchEnd', function () {
				//mixpanel.track("Swipe Newest Product", {
				//	"User Identity" : user_identity
				//});
			});
		}
	});

	

	// SWIPER FOR ARTICLE
	var swiper_article = new Swiper('.sw-article-list-container .swiper-container', {
	    slidesPerView: __article_slick_3,
	    spaceBetween: 15,
	    preloadImages: false,
	    lazyLoading: true,
	});

	$(document).on("click", ".mainimg-item .mp-product_link", function(){
	    //mixpanel.track("Click Product from Seasonal", {
		//	"User Identity" : user_identity,
		//	"Product Name" : $(this).attr("title"),
		//});
	});

	$(document).on("click", ".recommended-product .mp-product_link", function(){
	    //mixpanel.track("Click Product from Recommended", {
		//	"User Identity" : user_identity,
		//	"Product Name" : $(this).attr("title"),
		//});
	});

	$(document).on("click", ".newest-product .mp-product_link", function(){
	    //mixpanel.track("Click Product from Newest", {
		//	"User Identity" : user_identity,
		//	"Product Name" : $(this).attr("title"),
		//});
	});

	$(document).on("click", ".popular-product .mp-product_link", function(){
	    //mixpanel.track("Click Product from Popular", {
		//	"User Identity" : user_identity,
		//	"Product Name" : $(this).attr("title"),
		//});
	});
})(jQuery);

// SWIPER FOR SIDE IMAGE
var width = $( window ).width();
var __slick_custom_3 = __slick_4;
if (width <= 980) {
	__slick_custom_3 = __slick_4 + 1;
}