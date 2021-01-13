(function ($) {

    // Pop Up Modal Discount for First Time Buy
    /*
	$('#btn-subscribe-submit').click(function(){
        $(this).prop('disabled', true);
        $(this).html('<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i>');
        var that    = $(this);
        var parent  = $('#subscribe-form');
        var info    = $('#info-block');
        var success = $('#success-block');
        var email   = $('#txt-email').val();
        var token   = $('#_token').val();
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
                        parent.addClass('hidden');
                        success.removeClass('hidden');
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

    // Swiper Banner (Home)
    var bannerSwiper = new Swiper ('.banner-container .swiper-container', {
        direction: 'horizontal',
        loop: true,
        autoplay: 5000,
        updateOnImagesReady: true,
        pagination: '.banner-container .swiper-pagination',
        paginationClickable: true,
    });

   /*  bannerSwiper.on('touchEnd', function () {
        mixpanel.track("Swipe Banner Link", {
            "User Identity" : user_identity
        });
    }); */

    // Swiper Value
    var valueSwiper = new Swiper('.value-container .swiper-container', {
        nextButton: ".btn-next",
        prevButton: ".btn-prev",

        onProgress: function(e){
            if(e.isBeginning){
                $(".btn-prev").hide();
                $(".btn-next").show();
            } 
            else if(e.isEnd) {
                $(".btn-next").hide();
                $(".btn-prev").show();
            } 
            else {
                $(".btn-prev").show();
                $(".btn-next").show();
            }
        }
    });

    // SWIPER MAIN
	/*$(".sw-product-list-container .swiper-container").each(function(index, element){
	    var $this = $(this);
	    $this.addClass("instance-" + index);
	    $this.find(".swiper-button-prev").addClass("btn-prev-" + index);
	    $this.find(".swiper-button-next").addClass("btn-next-" + index);
	    var swiper_main = new Swiper(".instance-" + index, {
            slidesPerView: 'auto',
            slidesPerGroup: 1,
			spaceBetween: 2,
            freeMode: true,
	    });
	});*/

    // SWIPER FOR ARTICLE
    var articleSwiper = new Swiper ('.article-container .swiper-container', {
		direction: 'horizontal',
		loop: true,
		preloadImages: false,
		lazyLoading: true,
		pagination: '.article-container .swiper-pagination',
        paginationClickable: true
    });

    // Binding Click Swiper
    $(".swiper-container .swiper-slide a").bind("click", function() {
		window.location.href=$(this).attr('href');
	});

    // success msg for create password and verify email
    $(function(){
        if ($("[name=success_verify_email]").val()) {
            GeneralMessage.animate_success_message($("[name=success_verify_email]").val());
        }

        if ($("[name=success_create_password]").val()) {
            GeneralMessage.animate_success_message($("[name=success_create_password]").val());
        }

        if ($("[name=unsuccessful_verify_email]").val()) {
            GeneralMessage.animate_error_message($("[name=unsuccessful_verify_email]").val());
        }
    });
    
    $(document).on("click", ".seasonal-product .mp-product_link", function(){
        /*mixpanel.track("Click Product from Seasonal", {
            "User Identity" : user_identity,
            "Product Name" : $(this).attr("title"),
        });*/
    });

    $(document).on("click", ".recommended-product .mp-product_link", function(){
       /* mixpanel.track("Click Product from Recommended", {
            "User Identity" : user_identity,
            "Product Name" : $(this).attr("title"),
        });*/
    });

    $(document).on("click", ".newest-product .mp-product_link", function(){
        /*mixpanel.track("Click Product from Newest", {
            "User Identity" : user_identity,
            "Product Name" : $(this).attr("title"),
        });*/
    });

    $(document).on("click", ".popular-product .mp-product_link", function(){
        /*mixpanel.track("Click Product from Popular", {
            "User Identity" : user_identity,
            "Product Name" : $(this).attr("title"),
        });*/
    });
})(jQuery);