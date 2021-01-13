(function ($) {
	var product_box_container_class = ".cart-popup-product-box-container";
	var cart_popup_first_open = false;
	var max_value = [];
	let availability = [];
	let is_pre_order = [];


	//to mapping each max qty of the product and disable plus if current qty already at max qty of selected product
	$.each($('.cart-popup-product-box-container'), function(index, value){
		uuid = $(this).data('uuid');
		availability[uuid] = $(this).find('.qty-container').data('availability-type');
		is_pre_order[uuid] = $(this).find('.qty-container').data('is-pre-order');

        if(availability[uuid] == 'limited_stock' && is_pre_order[uuid] != 1 ){
            max_value[uuid] = $(this).find('.qty-container').data('qty-max');
        } else {
            max_value[uuid] = 999999;
        }
		if($(this).find('.qty-container').find('#cart-order-qty').val() == max_value[uuid]){
			$(this).find('.qty-container').find('#cart-qty-plus').attr('disabled', true);
		}
	});

	cart_popup_new_element	= null;

	// $('#subscribeModal').modal('show');

	/*$("img.lazy").lazyload({
		effect : "fadeIn",
		threshold : 100,
		load : function(){
            $(this).removeClass("lazy");
	    }
	}); 

	$('.rating.rating-loading').rating({
        filledStar: '<i class="fa fa-star"></i>',
        emptyStar: '<i class="fa fa-star"></i>'
    }); 

    $('[data-toggle="tooltip"]').tooltip(); */

    //Handle Header Search Textbox With Fixed Search Textbox Always Same
    $('.search-container input[name=search]').bind("change keyup input",function() {
    	$('.search-container input[name=search]').val($(this).val());
    });
    //Handle Header Search Textbox With Fixed Search Textbox Always Same END

    // Scroll Fixed Menu Header Mini
	$(window).on('scroll', function(e) {
	    var left = $(this).scrollLeft();
	    $('.nav-container-fixed .header-mini').css('left', -left);
	});
	// Scroll Fixed Menu Header Mini END

	// Fixed Back to Top
	setTimeout(function(){
		if ($('div').hasClass("ins-pos-bottom-right") == true) {
	        // Positioning Arrow to Top
	        $( '#back-to-top' ).css({
	            "bottom": "80px",
	            "right": "20px",
	        });
	    };
	}, 3000);

	$("#back-to-top").hide();
	
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});

	$('#back-to-top a').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});
	// Fixed Back to Top END

	// Handle stay cart pop up
	/*$('.dropdown.cart-summary-container').hover(function() {
	    $(this).addClass('open');
	});*/

	if($(".nano").length > 0) {
		setInterval(function(){
	        if(cart_popup_new_element != null) {
		    	scroll_top_val = $(cart_popup_new_element).position().top + $(".nano").nanoScroller().position().top;

		    	$(".nano").nanoScroller({ scrollTop: scroll_top_val });

		    	cart_popup_new_element	= null;
		    }
	    }, 2000);
	}

	$('.dropdown-menu.for-cart').mouseleave(function() {
		setTimeout(function(){
			$('.dropdown.cart-summary-container').removeClass('open');
		},100);
	});
	$('body').on('click', function (e) {
	    if (!$('li.dropdown.cart-summary-container').is(e.target) && $('li.dropdown.cart-summary-container').has(e.target).length === 0 && $('.open').has(e.target).length === 0) {
	        $('li.dropdown.cart-summary-container').removeClass('open');
	    }
	});
	// Handle stay cart pop up END

	$('.navbar-nav .profile-menu').hover(function(e){
		if( typeof (PNotify) != 'undefined'){ 
        	PNotify.removeAll();
		}

    	$('.cart-popover').webuiPopover('destroy');
	});

	// Cart Popup Scroll
	$('.nav-container .cart-summary-container').hover(function(e){
		if (cart_popup_first_open === false) {
			$('.nano').nanoScroller();
			cart_popup_first_open = true;
		}
		if( typeof (PNotify) != 'undefined'){ 
        	PNotify.removeAll();
		}

    	$('.cart-popover').webuiPopover('destroy');
	});
	// Cart Popup Scroll END

    /*$(window).scroll(function() {
		if ($(this).scrollTop() > 104){  
			$('.site-menu').addClass("sticky");
		}
		else{
			$('.site-menu').removeClass("sticky");
		}
	});*/

	// Cart Notification
	$('.cart-summary-container').on('click', '.qty-container #cart-qty-plus', function(){
        var parent = $(this).parent().parent();
        var input = parent.find('#cart-order-qty');

        var step_value = $(this).closest('.qty-container').data('step');
        var min_value = $(this).closest('.qty-container').data('qty-min');
        var uuid = $(this).parents('.cart-popup-product-box-container').data('uuid');

        var container_element = $(this).closest(product_box_container_class);

        if (input.val() == '') {
            input.val(min_value);
        }
        else if(parseInt(input.val()) + step_value <= max_value[uuid]){
            input.val(parseInt(input.val()) + step_value);
        }

        if(parseInt(input.val()) == max_value[uuid]){
			$(this).attr('disabled', true);
		} else {
			$(this).removeAttr('disabled');
		}

        $( input ).trigger('change');
    });

	$('.cart-summary-container').on('click', '.qty-container #cart-qty-min', function(){
        var parent = $(this).parent().parent();
        var input = parent.find('#cart-order-qty');

        var step_value = $(this).closest('.qty-container').data('step');
        var min_value = $(this).closest('.qty-container').data('qty-min');
        var uuid = $(this).parents('.cart-popup-product-box-container').data('uuid');

        var container_element = $(this).closest(product_box_container_class);
        var product_id = $(container_element).data('uuid');
        var product_type = $(container_element).data('type');
        var order_date = $(container_element).find('input[name^=order_item_date]').val();
        
        if(parseInt(input.val()) - parseInt(step_value) == 0){
            var curr_qty = -parseInt(input.val());

            showRemoveModal(
                $(this).closest(product_box_container_class)
                , function(){
                    updateAllValue();
                    updateTotalProductInCartUi(curr_qty);
                    updateProductInput(product_id, order_date, 0, product_type);
                    updateProductInputInList(product_id, order_date, 0, product_type);
                }
            );
        }
        else{
            if (parseInt(input.val()) - step_value < min_value || input.val() == '') {
                input.val(min_value);
            }else if(parseInt(input.val()) - step_value > max_value[uuid] ){
				input.val(max_value[uuid]);
			}else {
				input.val(parseInt(input.val()) - step_value);
			}
            $( input ).trigger('change');
        }
    });

    $('.cart-summary-container').on('change', '.qty-container #cart-order-qty', function() {
        var step_value = $(this).closest('.qty-container').data('step');
        var min_value = $(this).closest('.qty-container').data('qty-min');
		var uuid = $(this).parents('.cart-popup-product-box-container').data('uuid');

        if($(this).val() == ""){
            $(this).val(min_value);
		}
		if($(this).val() > max_value[uuid]){
            $(this).val( max_value[uuid]);
        }

        var last_qty = $(this).closest('.qty-container').find('.last-qty').val();
        var curr_qty = $(this).val();
        var that = $(this);

        var container_element = $(this).closest(product_box_container_class);
        var product_id = $(container_element).data('uuid');
        var product_type = $(container_element).data('type');
        var order_date = $(container_element).find('input[name^=order_item_date]').val();
        var order_qty = $(container_element).find('input[name^=order_qty]').val();
        var _token = $('meta[name=csrf-token]').attr('content');

    	// refreshQuantityUi(order_qty);
    	refreshQuantityCartUi(container_element);
        
        if($(this).val() == 0){
            curr_qty = parseInt(curr_qty) - parseInt(last_qty);
            showRemoveModal(
                $(this).closest(product_box_container_class)
                ,function(){
                    updateAllValue();
                    updateTotalProductInCartUi(curr_qty);
                    updateProductInput(product_id, order_date, 0, product_type);
                    updateProductInputInList(product_id, order_date, 0, product_type);
                }
                ,function(){
                    var reset = min_value;

                    if(reset <= 0){
                        reset = step_value;
                    }
                    $(that).val(reset);
                }
            );
        }
        else{
            var diff_qty    = parseInt(curr_qty) - parseInt(last_qty);

            updateAllValue();
            updateLastQuantity(container_element, curr_qty);
            updateTotalProductInCartUi(diff_qty);

            addOrUpdateProductInCartAjax(container_element, product_id, product_type, order_date, order_qty, _token, function(response){
				max_value[uuid] = response.data.product.quantity;
			});

            updateProductInput(product_id, order_date, $(this).val(), product_type);
            updateProductInputInList(product_id, order_date, $(this).val(), product_type);

            animateCartWiggle();
        }

        setTimeout(function(){
		    $('.dropdown.cart-summary-container').addClass('open');
		},115);
    });

    $('.cart-summary-container').on('click', '.cart-popup-product-box-container .item-remove', function(e){
        e.preventDefault();

        var curr_qty            = -($(this).closest(product_box_container_class).find('input[name^=order_qty]').val());
        var container_element   = $(this).closest(product_box_container_class);
        var product_id 			= $(container_element).data('uuid');
        var product_type 		= $(container_element).data('type');
        var order_date 			= $(container_element).find('input[name^=order_item_date]').val();
        
        showRemoveModal(container_element, function(){
            updateAllValue();
            updateTotalProductInCartUi(curr_qty);
            updateProductInput(product_id, order_date, 0, product_type);
            updateProductInputInList(product_id, order_date, 0, product_type);
        });
    });

	// Cart Notification END
	
	// Refer Friend add Form Input
	$('.add-field').click(function(){
    	$('.append-container').children().last().clone().appendTo('.append-container');
    	$('.append-container').children().last().find('input[type=email]').val('');
    	$('.append-container').children().last().find('input').attr('placeholder', 'Email ' + $('.append-container').children().length);
		
		var ref_overflow = document.getElementById('ref-overflow');
		ref_overflow.scrollTop = ref_overflow.scrollHeight;
    });
    // Refer Friend add Form Input END

	// Sticky side menu and stop at footer
	$(window).scroll(sticky_relocate);
    // Sticky side menu and stop at footer END

	// Referral Point Form
	$('#btn-referral-submit').click(function(e){
		e.preventDefault();


		$(this).prop('disabled', true);
		$(this).html('<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i>');
		var that 	= $(this);
		var parent 	= $('#referral-program-form');
		var info 	= $('.referral-program-banner-content .info-block');
		var success = $('.referral-program-banner-content .success-block');
		var email 	= $('#referral-email').val();
		var token 	= $('#_token').val();

		if (email == '') {
			parent.find('.form-group').addClass('has-error');
			info.html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-warning m-r-5"></i>Mohon masukkan email Anda</div>');
			that.html('<i class="fa fa-send m-r-5"></i> Kirim');
			that.prop('disabled', false);
			return false;
		}
		else{
			$.ajax({
				type: "post",
	            url: "/user/subscribe",
	            dataType: 'json',
	            data: { email: email, _token: token, source: 'subscribe-box' },
	            error: function() {
	                console.log('error');
	                that.html('<i class="fa fa-send m-r-5"></i> Kirim');
	                that.prop('disabled', false);
	            },
	            success: function(responses) {
	                if (responses['message']['type'] == 'error') {
	                	parent.find('.form-group').addClass('has-error');
						info.html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-warning m-r-5"></i>'+ responses['message']['desc'] +'</div>');
						that.html('<i class="fa fa-send m-r-5"></i> Kirim');
						that.prop('disabled', false);
						return false;
	                }
	                else{
	                	if(responses.body && responses.body.moengage && !responses.body.moengage.tracked){
	                		if(!responses.body.moengage.loggedIn){
	                			Moengage.add_email(email); 
	                			Moengage.add_user_attribute("user_type", "guest");
	                		}
	                		Moengage.add_user_attribute("newsletter_email", email);
	                		Moengage.add_user_attribute("is_newsletter_subscribe", true);

	                		Moengage.track_event("EMAIL_SUBSCRIBE", {
								"interface"				: "desktop",
								"subscribe_source"		: "subscribe-box",
								"subscribe_email"		: email
							});
	                	}

	                	customer_id = responses['message']['data'];
	                	setCookie('user_email', email, 3);
	                	success.removeClass('none');
	                	parent[0].reset();
	                	success.html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+ responses['message']['desc'] +'</div>');
	                	that.html('<i class="fa fa-send m-r-5"></i> Kirim');
	                	that.prop('disabled', false);
	                	return true;
	                }
	            }
	        });
		}
	});

	$('#referral-email').keyup(function(){
		$('#referral-program-form').find('.form-group').removeClass('has-error');
		$('.referral-program-banner-content .info-block').html('');
		$('.referral-program-banner-content .success-block').html('');
	});
	// Referral Point Form END

	$('body').on('click', '#invitation-form #btn-send-invitation', function(e){
   		e.preventDefault();

   		var that 	= $(this);
		var parent 	= $('#invitation-form');
		var token 	= $('#invitation-form #_token').val();
		var email 	= $('#invitation-form input[name="email[]"]').map(function (idx, ele) {
					   return $(ele).val();
					}).get();
		var filtered_email = email.filter(function (el) {
			return el != "";
		});

		show_loading(that);

		$.ajax({
			type: "post",
            url: "/undang-teman/send_invitation_ajax",
            dataType: 'json',
            data: { email: email, _token: token},
            error: function(xhr, status, error) {
                remove_loading(that);
                show_message('danger', 'Something went wrong, please refresh this page again !', $(parent).parent(), 'before');
            },
            success: function(responses) {
            	remove_loading(that);

            	if (responses['message']['type'] == 'error') {
            		parent.find('.form-group').addClass('has-error');

            		show_message('danger', responses['message']['desc'], $(parent).parent(), 'before');
            		
            		return false;
            	}
            	else{
            		parent.find('.form-group').removeClass('has-error');
            		parent.find('.form-group').addClass('has-success');
            		parent[0].reset();

            		show_message('success', responses['message']['desc'], $(parent).parent(), 'before');

					mixpanel.track("Do Referral", {
						"User Identity" : user_identity,
						"Emails" : filtered_email,
						"From" : $('input[name="page_from"]').val(),
					});

            		return true;
            	}
            }
        });
   	});

   	/* ============= Show Navigation Popular Item ============= */
   	var delay	= 300;

   	//super-category
   	var timer_super_category;

   	$('.nav-container .dropdown.tabbed-mega').hover(function(e) {
		that = $(this);
	    timer_super_category = setTimeout(function(){
	        var category_slug	= that.find('li.nav-category').first().data('category-slug');

       		if(category_slug != undefined && category_slug != '')
	   		{
	   			$.ajax({
			        url: '/product/get_most_popular/category/' + category_slug,
			        dataType: 'json',
			        type: 'get',
			        error: function() {
			            console.log('error');
			        },
			        success: function(response) {
			        	first_category_element	= that.find('li.nav-category').first();

		            	first_category_element.find('.image-container #popular-product-image').attr('src', response.data.photo);
		            	first_category_element.find('.image-container #popular-product-image').closest('a').attr('href', response.data.url);
		            	first_category_element.find('.desc-container #popular-product-title').html(response.data.name)
		            	first_category_element.find('.desc-container #popular-product-title').attr('href', response.data.url);
		            	first_category_element.find('.desc-container #popular-product-size').html(response.data.size);
		            	first_category_element.find('.desc-container #popular-product-link').attr('href', response.data.url);

		            	if(response.status == true) {
		            		first_category_element.find('.popular-product-container').removeClass('hidden');
		            	}
		            	else {

		            		first_category_element.find('.popular-product-container').addClass('hidden');
		            	}
			        }
			    });
	   		}
	    }, delay);
	}, function(e) {
	    clearTimeout(timer_super_category);
	});

   	//category
   	var timer_category;

	$('.nav-container li.nav-category').on("mouseenter", function(e) {
		that = $(this);
	    timer_category = setTimeout(function(){
	        var category_slug 	= that.data('category-slug');

       		if(category_slug != undefined && category_slug != '')
	   		{
	   			$.ajax({
			        url: '/product/get_most_popular/category/' + category_slug,
			        dataType: 'json',
			        type: 'get',
			        error: function() {
			            console.log('error');
			        },
			        success: function(response) {
		            	that.find('.image-container #popular-product-image').attr('src', response.data.photo);
		            	that.find('.image-container #popular-product-image').closest('a').attr('href', response.data.url);
		            	that.find('.desc-container #popular-product-title').html(response.data.name)
		            	that.find('.desc-container #popular-product-title').attr('href', response.data.url);
		            	that.find('.desc-container #popular-product-size').html(response.data.size);
		            	that.find('.desc-container #popular-product-link').attr('href', response.data.url);

		            	if(response.status == true) {
		            		that.find('.popular-product-container').removeClass('hidden');
		            	}
		            	else {

		            		that.find('.popular-product-container').addClass('hidden');
		            	}
			        }
			    });
	   		}
	    }, delay);
	}).mouseleave(function() {
	    clearTimeout(timer_category);
	});

	//subcategory
   	var timer_subcategory;

	$('.nav-container li.nav-subcategory').hover(function(e) {
		that = $(this);
	    timer_subcategory = setTimeout(function(){
	        var subcategory_slug 	= that.data('subcategory-slug');

       		if(subcategory_slug != undefined && subcategory_slug != '')
	   		{
	   			$.ajax({
			        url: '/product/get_most_popular/subcategory/' + subcategory_slug,
			        dataType: 'json',
			        type: 'get',
			        error: function() {
			            console.log('error');
			        },
			        success: function(response) {
			        	that = that.closest('li.nav-category');

		            	that.find('.image-container #popular-product-image').attr('src', response.data.photo);
		            	that.find('.image-container #popular-product-image').closest('a').attr('href', response.data.url);
		            	that.find('.desc-container #popular-product-title').html(response.data.name)
		            	that.find('.desc-container #popular-product-title').attr('href', response.data.url);
		            	that.find('.desc-container #popular-product-size').html(response.data.size);
		            	that.find('.desc-container #popular-product-link').attr('href', response.data.url);

		            	if(response.status == true) {
		            		that.find('.popular-product-container').removeClass('hidden');
		            	}
		            	else {

		            		that.find('.popular-product-container').addClass('hidden');
		            	}
			        }
			    });
	   		}
	    }, delay);
	}, function(e) {
	    clearTimeout(timer_subcategory);
	});

   	/*$('.nav-container li.nav-category').on("mouseover", function(e) {
   		var category_slug = $(this).data('category-slug');

   		if(category_slug != undefined && category_slug != '')
   		{
   			$.ajax({
		        url: '/product/get_most_popular/category/' + category_slug,
		        dataType: 'json',
		        type: 'get',
		        error: function() {
		            console.log('error');
		        },
		        success: function(responses) {
		            console.log(responses);
		        }
		    });
   		}
   	});*/

   	/* START ALGOLIA FUNCTION */
   	var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();

    var last_search = "";

    $('#search-input').on('change keyup paste', function() {
        var that = $(this);

        if(last_search != $(that).val()) {
        	last_search = $(that).val();

        	delay(function(){
	            search($(that).val(), true)
	        }, 200 );
        }
    });
    
    if($('#search-input').val() != '') {
    	search($('#search-input').val(), false);
    }

    $('body').on('mouseover click', function(e){
    	if(!$('.algolia-search').hasClass('active') && !$('.algolia-search').hasClass('input-active') && !$('#search-input').is(':focus')) {
    		$('.algolia-search').addClass('hidden');
    	}

    	if(!$('#search-result-default-suggestion').hasClass('active') && !$('#search-result-default-suggestion').hasClass('input-active')) {
    		$('#search-result-default-suggestion').addClass('hidden');
    	}
    });

    $('#search-input').on('focus', function(e){
    	if($('#search-input').val() == '') {
    		$('#search-result-default-suggestion').addClass('input-active');
    		$('#search-result-default-suggestion').removeClass('hidden');
    	}
    	else {
    		$('.algolia-search').addClass('input-active');
			$('.algolia-search').removeClass('hidden');
    	}
    });

    $('#search-input').on('focusout', function(e){
    	$('.algolia-search').removeClass('input-active');

    	$('#search-result-default-suggestion').removeClass('input-active');

    	if(!$('.algolia-search').hasClass('active')) {
    		$('.algolia-search').addClass('hidden');
    	}
    });

    $('#form-search-container').on('mouseenter', function(e){
    	if($('.algolia-search').hasClass('input-active')) {
			$('.algolia-search').removeClass('hidden');
		}
    	else if($('#search-result-default-suggestion').hasClass('input-active')) {
			$('#search-result-default-suggestion').removeClass('hidden');
		}
    });

    $('#form-search-container').on('mouseleave', function(e){
    	$('#search-input').blur();
    });

    $('.header-search-result').on('mouseenter', function(e){
    	$('#search-input').focus();
    	$('.algolia-search').addClass('active');
    });

    $('.header-search-result').on('mouseleave', function(e){
    	$('.algolia-search').removeClass('active');
    	$('.algolia-search').addClass('hidden');

    	var element_to = e.toElement || e.relatedTarget;
    	var class_element = $(element_to).attr('id');
    	if (!(class_element == 'search-input' || class_element == 'search-button')) {
    		$('#search-input').blur();
    	}
    });

    $('.custom-duramenu .nav li a').hover(function(e){
    	$('#search-result-default-suggestion').removeClass('active');
    	$('#search-result-default-suggestion').removeClass('input-active');
    	$('.algolia-search').removeClass('active');
    	$('.algolia-search').removeClass('input-active');

    	$('#search-input').trigger('blur');
	});
	
    /* Temporary hide because function didnt show result Suggested Keywords
    query_suggestion_helper.on('result', function(content) {
        if(content.hits.length > 0) {
            $('#search-result-query-suggestion #search-result-query-suggestion-list').empty();

            $.each(content.hits, function(index, result){
                $('#search-result-query-suggestion #search-result-query-suggestion-list').append('<li class="scategories"><div class="product-titles"><a class="trackClickSuggestedSearch" href="/search/query?search=' + result.query + '" title="' + result.query + '">' + result.query + '</a></div></li>');
            });
        }
        else {
            $('#search-result-query-suggestion #search-result-query-suggestion-list').html('<span><em>Tidak ada rekomendasi keyword yang sesuai.</em></span>');
        }
    });

    merchant_helper.on('result', function(content) {
        if(content.hits.length > 0) {
            $('#search-result-merchant #search-result-merchant-list').empty();

            $.each(content.hits, function(index, result){
                var merchant_element = '';
                merchant_element += '<li class="sproduct">';
                merchant_element += '<a href="/brand/' + result.merchant_slug + '" class="product-infos__thumbnail trackClickSearch" title="' + result.merchant_name + '">';
                merchant_element += '<img class="trackClickSearch" src="https://lemonilo.imgix.net/' + (result.merchant_photo_url != undefined ? result.merchant_photo_url : 'no-image/merchant.jpg') + '?auto=format&w=60" title="' + result.merchant_name + '" alt="' + result.merchant_name + '">';
                merchant_element += '</a>';
                merchant_element += '<div class="product-titles">';
                merchant_element += '<div class="item-name">';
                merchant_element += '<a class="trackClickSearch" href="/brand/'  + result.merchant_slug + '" title="' + result.merchant_name + '">' + result.merchant_name + '</a>';
                merchant_element += '</div>';
                merchant_element += '</div>';
                merchant_element += '</li>';

                $('#search-result-merchant #search-result-merchant-list').append(merchant_element);
            });
        }
        else {
            $('#search-result-merchant #search-result-merchant-list').html('<span><em>Tidak ada brand yang sesuai dengan pencarian Anda.</em></span>');
        }
    }); 

    product_helper.on('result', function(content) {
        if(content.hits.length > 0) {
            $('#search-result-product #search-result-product-list').empty();

            $.each(content.hits, function(index, result){
                var product_element = '';
                product_element += '<li class="sproduct">';
                product_element += '<a href="/product/' + result.product_slug + '" class="product-infos__thumbnail trackClickSearch" title="' + result.product_name + '">';
                product_element += '<img class="trackClickSearch" src="https://lemonilo.imgix.net/' + (result.product_photo_url != undefined ? result.product_photo_url : 'no-image/product.jpg') + '?w=60&auto=format&q=50" title="' + result.product_name + '" alt="' + result.product_name + '">';
                product_element += '</a>';
                product_element += '<div class="product-titles">';
                product_element += '<div class="item-merchant">';
                product_element += '<a class="trackClickSearch" href="/brand/' + result.merchant_slug + '" title="' + result.merchant_name + '">' + result.merchant_name + '</a>';
                product_element += '</div>';
                product_element += '<div class="item-name ellipsis-wrapper">';
                product_element += '<a class="trackClickSearch" href="/product/' + result.product_slug + '" title="' + result.product_name + '">' + result.product_name + '</a>';
                product_element += '</div>';
                product_element += '</div>';
                product_element += '<div class="product-price">';
                product_element += '<div class="item-price">';
                product_element += '<sup class="pricing">Rp</sup>&nbsp;' + (result.sell_price).formatMoney(0, ',', '.');
                product_element += '</div>';
                product_element += '</div>';
                product_element += '</li>';
                
                $('#search-result-product #search-result-product-list').append(product_element);
            });

            $('.header-search-result #btn-see-all-product').removeClass('hidden');
        }
        else {
            $('#search-result-product #search-result-product-list').html('<span><em>Tidak ada produk yang sesuai dengan pencarian Anda.</em></span>');
            $('.header-search-result #btn-see-all-product').addClass('hidden');
        }
    });

    category_helper.on('result', function(content){
        if(content.hits.length > 0) {
        	$('#search-result-category #search-result-category-list').empty();

            $.each(content.hits, function(index, result){
                $('#search-result-category #search-result-category-list').append('<li class="scategories"><div class="product-titles"><a class="trackClickSearch" href="/' + result.category_slug + '" title="' + result.category_name + '">' + result.category_name + '</a></div></li>');
            });
        }
        else {
        	$('#search-result-category #search-result-category-list').html('<span><em>Tidak ada kategori yang sesuai dengan pencarian Anda.</em></span>');
        }
    });

    product_tag_helper.on('result', function(content){
        if(content.hits.length > 0) {
        	$('#search-result-product-tag #search-result-product-tag-list').empty();

            $.each(content.hits, function(index, result){
                var product_tag_element = '';
                product_tag_element += '<li class="sproduct-tag">';
				product_tag_element += '<a class="trackClickSearch" href="/tag/' + result.product_tag_slug + '" title="' + result.product_tag_name + '">';
				product_tag_element += '<div class="tag-icons">';
				product_tag_element += '<span class="icon ' + result.product_tag_icon + '"></span>';
				product_tag_element += '</div>';
				product_tag_element += '<div class="tag-titles">';
				product_tag_element += result.product_tag_name;
				product_tag_element += '</div>';
				product_tag_element += '</a>';
                product_tag_element += '</li>';

                $('#search-result-product-tag #search-result-product-tag-list').append(product_tag_element);
            });
        }
        else {
        	$('#search-result-product-tag #search-result-product-tag-list').html('<span><em>Tidak ada manfaat produk yang sesuai dengan pencarian Anda.</em></span>');
        }
    });

    article_helper.on('result', function(content) {
        if(content.hits.length > 0) {
            $('#search-result-article #search-result-article-list').empty();

            $.each(content.hits, function(index, result){
                var article_element = '';
                article_element += '<li class="sblog">';
                article_element += '<a href="/blog/' + result.article_slug + '">';
                article_element += '<img class="trackClickSearch" src="https://lemonilo.imgix.net/' + (result.article_photo_url != undefined ? result.article_photo_url : 'no-image/article.jpg') + '?w=180&auto=format&q=50" title="' + result.article_title + '" alt="' + result.article_title + '">';
                article_element += '</a>';
                article_element += '<div class="product-titles">';
                article_element += '<div class="item-name item-wrapper">';
                article_element += '<a class="trackClickSearch" href="/blog/' + result.article_slug + '" title="' + result.article_title + '">' + result.article_title + '</a>';
                article_element += '</div>';
                article_element += '</div>';
                article_element += '</li>';

                $('#search-result-article #search-result-article-list').append(article_element);
            });

            $('.header-search-result #btn-see-all-article').removeClass('hidden');
        }
        else {
            $('#search-result-article #search-result-article-list').html('<span><em>Tidak ada artikel yang sesuai dengan pencarian Anda.</em></span>');
            $('.header-search-result #btn-see-all-article').addClass('hidden');
        }
    });

    $('.header-search-result #btn-see-all-product').click(function(e){
        window.location = '/search/query?search=' + $('#search-input').val();
    });

    $('.header-search-result #btn-see-all-article').click(function(e){
        window.location = '/blog?search=' + $('#search-input').val();
    });
    */
    /* END ALGOLIA FUNCTION 

    function search(query, show_suggestion) {
	    if(query != '') {
       		$('#search-result-default-suggestion').addClass('hidden');

       		if(show_suggestion) {
       			$('.algolia-search').removeClass('hidden');
       		}

   //     		Moengage.track_event("SEARCH_PRODUCT", {
			// 	"interface"				: "desktop",
			//     "search_keyword"		: query,
			//     "clicked_keyword"		: query,
			//     "search_date"			: new Date()
			// });

	        //query_suggestion_helper.setQuery(query)
	        //                   .setQueryParameter('hitsPerPage', 4)
	        //                   .search();

	        merchant_helper.setQuery(query)
	                       .setQueryParameter('hitsPerPage', 5)
	                       .addFacetRefinement('merchant_status', 'active')
	                       .search();

	        product_helper.setQuery(query)
	                      .setQueryParameter('hitsPerPage', 5)
	                      .addFacetRefinement('product_status', 'active')
	                      .addFacetRefinement('merchant_status', 'active')
	                      .addFacetRefinement('product_subcategory_status', 'active')
	                      .addFacetRefinement('product_category_status', 'active')
	                      .addFacetRefinement('product_super_category_status', 'active')
	                      .addFacetRefinement('is_visible', 1)
	                      .search();

	        category_helper.setQuery(query)
	                       .setQueryParameter('hitsPerPage', 4)
	                       .addFacetRefinement('category_status', 'active')
	                       .search();

	        product_tag_helper.setQuery(query)
	                       	  .setQueryParameter('hitsPerPage', 4)
	                       	  .addFacetRefinement('product_tag_status', 'active')
	                       	  .search();

	        article_helper.setQuery(query)
	                      .setQueryParameter('hitsPerPage', 4)
	                      .addFacetRefinement('article_status', 'active')
	                      .search();
	    }
	    else {
	    	$('.algolia-search').addClass('hidden');
        	$('#search-result-default-suggestion').removeClass('hidden');
	    }
	}

   	function show_message(alert_type, message_text, element, state){
		$(element).find('.error-message').remove();

		if(state == 'after' || state === 'undefined'){
			$(element).append(get_message_template(alert_type, message_text));
		}
		else if(state == 'before'){
			$(element).prepend(get_message_template(alert_type, message_text));
		}
	}
	*/
	function show_loading(element){
	    $(element).prop('disabled', true);
		$(element).prepend('<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i>');
	}

	function remove_loading(element){
		$(element).find('i').remove();
	    $(element).prop('disabled', false);
	}

	function max_length(evt, obj) {
	    if (obj.value.length > obj.maxLength) 
	        obj.value = obj.value.slice(0, obj.maxLength);
	}

	function updateAllValue(){
		var total_item_in_cart = 0;
	    var total_item_price = 0;
	    var subtotal = 0;
	    var subtotal_for_lemonilo = 0;
	    var total_save = 0;
	    var total_reward = 0;

	    $.each($('.cart-summary-container .qty-container'), function( index, value ) {
	        quantity = $(value).find('#cart-order-qty').val();
	        price = $(value).find('#product_item_price').val();
	        fulfillment = $(value).find('#product_fulfillment').val();

	        save = $(value).find('#product_item_save').val();
	        reward = $(value).find('#product_item_reward').val();

	        $(value).closest(product_box_container_class).find('.subtotal').html((price * quantity).formatMoney(0, ',', '.'));

	        total_item_in_cart = total_item_in_cart + parseInt(quantity);
	        subtotal = subtotal + price * quantity;
	        if(fulfillment == 1){
	        	subtotal_for_lemonilo = subtotal_for_lemonilo + price * quantity;

	        }
	        total_save = total_save + save * quantity;
	        total_reward = total_reward + reward * quantity;
	    });

	    price_subtotal = subtotal.formatMoney(0, ',', '.');
	    price_subtotal_for_lemonilo = subtotal_for_lemonilo + ".00";
        price_total_save = total_save.formatMoney(0, ',', '.');
        price_total_reward = total_reward.formatMoney(0, ',', '.');

	    if (subtotal >= 1000) {
	    	price_subtotal = updatePriceToSuperscriptThousandFormat(price_subtotal);
        }

	    if (total_save >= 1000) {
	    	price_total_save= updatePriceToSuperscriptThousandFormat(price_total_save);
        }

	    if (total_reward >= 1000) {
	    	price_total_reward = updatePriceToSuperscriptThousandFormat(price_total_reward);
        }

		$('.cart-summary-container .cart-sum').html(total_item_in_cart <= 99 ? total_item_in_cart : '99+');
	    $('.cart-summary-container .subtotal #popup-subtotal-text').html(price_subtotal);
	    $('.cart-summary-container .total_cart_free_shipping_lemonilo #total_cart_free_shipping').html(price_subtotal_for_lemonilo);
	    $('.cart-summary-container .save #popup-save-text').html(price_total_save);
	    $('.cart-summary-container .reward #popup-reward-text').html(price_total_reward);
	}

	function updatePriceToSuperscriptThousandFormat(price_value) {
		var money_parts = price_value.split('.');
        var thousand_number = money_parts.pop();
        var money_after_thousand_number = parseInt(money_parts.join('')).formatMoney(0, ',', '.');
        
        price_value = money_after_thousand_number + '.<sup class="pricing">' + thousand_number +'</sup>';
		
		return price_value;
	}

	function updateLastQuantity(container_element, curr_qty_param){
	    var curr_qty = (curr_qty_param != undefined) ? curr_qty_param : $(container_element).find('.qty-number').val();
	    $(container_element).find('.last-qty').val(curr_qty);
	}

	/*function refreshQuantityUi(qty) {
        qty             = parseInt(qty);
        console.log(qty);

        if(qty <= 0) {
            $('#cartForm').find('.qty-container .btn-min').attr('disabled', 'disabled');
        }
        else {
            $('#cartForm').find('.qty-container .btn-min').removeAttr('disabled');
        }

        if(qty >= 9999) {
            $('#cartForm').find('.qty-container .btn-plus').attr('disabled', 'disabled');
            console.log('hit');
        }
        else {
            $('#cartForm').find('.qty-container .btn-plus').removeAttr('disabled');
        }
    }*/

	function refreshQuantityCartUi(box_element) {
        var qty         = parseInt($(box_element).find('.qty-container #cart-order-qty').val());
        var uuid = $(box_element).data('uuid');

        if(qty <= 0) {
            $(box_element).find('.qty-container .btn-min').attr('disabled', 'disabled');
        }
        else {
            $(box_element).find('.qty-container .btn-min').removeAttr('disabled');
        }

        if(qty >= max_value[uuid]) {
            $(box_element).find('.qty-container .btn-plus').attr('disabled', 'disabled');
        }
        else {
            $(box_element).find('.qty-container .btn-plus').removeAttr('disabled');
        }
    }

	function updateTotalProductInCartUi(update_step_qty)
    {
        var cur_qty = parseInt($('.cart-menu input[name=cur_qty]').val());
        var now_qty = cur_qty + update_step_qty;

        $('.cart-menu input[name=cur_qty]').val(now_qty);
        $('.cart-menu .cart-sum').html(now_qty > 99 ? '99+' : now_qty);
    }

    function updateProductInput(product_id, order_date, qty, product_type) {
    	var input_date = product_type == 'non' ? moment($('#cartForm input[name=order_item_date]').val()).format('DD/MM/YYYY') : $('#cartForm input[name=order_item_date]').val();

    	if($('#cartForm input[name=order_item_product_uuid]').val() == product_id && input_date == order_date) {

    		if(qty <= 0) {
    			$('#cartForm input[name=last_qty]').val(0);
                $('#cartForm input[name=order_qty]').val(1);

                $('#cartForm #update-now').addClass('hidden');
                $('#cartForm #buy-link-container').removeClass('hidden');
    		}
    		else {
    			$('#cartForm input[name=order_qty]').val(qty);
    			$('#cartForm input[name=last_qty]').val(qty);
    		}
    	}
    }

    function updateProductInputInList(product_id, order_date, qty, product_type) {
    	var product_box = $('.product-box-container[data-uuid=' + product_id + ']');

    	if(product_box.length > 0) {
    		var input_date = product_type == 'non' ? moment(product_box.find('input[name=order_item_date]').val()).format('DD/MM/YYYY') : product_box.find('input[name=order_item_date]').val();
	    	
	    	if(input_date == order_date ) {
	    		if(qty <= 0) {
	    			product_box.find('input[name=last_qty]').val(0);
	    			product_box.find('input[name=order_qty]').val(0);

	                product_box.find('.qty-container').addClass('hidden');
	                product_box.find('.buy-container').removeClass('hidden');
	    		}
	    		else {
	    			product_box.find('input[name=order_qty]').val(qty);
	    			product_box.find('input[name=last_qty]').val(qty);
	    		}
	    	}
    	}
    }

	function showRemoveModal(container_element, callback, deny_callback) {
        // WA-875 Improvement Cart Page (Remove modal confirmation delete product)
        /*var last_qty = $(container_element).find('.last-qty').val();
	    bootbox.confirm({
	        message: "Yakin untuk menghapus produk dari Shopping Cart?",
	        buttons: {
	            confirm: {
	                label: 'Ya',
	                className: 'btn-primary'
	            },
	            cancel: {
	                label: 'Batal',
	                className: 'btn-danger'
	            }
	        },
	        callback: function (result) {
        */        
                showLoading(container_element);
	    /*
	            if(result) 
	            {
    	*/
	                var product_id = $(container_element).data('uuid');
	                var product_type = $(container_element).data('type');
	                var date = $(container_element).find('input[name^=order_item_date]').val();
	                var _token = $('meta[name=csrf-token]').attr('content');
	                
	                removeProductFromCartAjax(container_element, product_id, product_type, date, _token, true, callback);

	                /*mixpanel.track("Remove Product From Cart", {
                        "User Identity" : user_identity,
                        "Product Name" : $(container_element).find('input[name=product_item_name]').val(),
                        "Qty" : $(container_element).find(".last-qty").val(),
                        "Price" : $(container_element).find("#product_item_price").val(),
                    });*/
        /*
	            } else {
                    $(container_element).find('input[name^=order_qty]').val(last_qty);
                }
	        }
	    }).init(function() {
		  	$('.cart-summary-container').addClass('open');
		});*/
	}

	function addOrUpdateProductInCartAjax(container_element, product_id, product_type, order_date, order_qty, _token, callback){
	    $.ajax({
	        url: '/product/cart/add-ajax',
	        dataType: 'json',
	        type: 'post',
	        context: $(container_element),
	        data: {
	            order_item_product_uuid : product_id,
	            order_item_product_type : product_type,
	            order_item_date : order_date,
	            order_qty : parseInt(order_qty),
	            _token : _token
	        },
	        error: function(xhr, status, error) {
	            console.log(error);
	        },
	        success: function(response) {
	            if(response.status)
	            {
	                if(callback != undefined){
	                    callback(response);
	                }
	            }
	            else
	            if(response.error !== null || response.error != "")
	            {
	                GeneralMessage.animate_error_message(response.error);
	            }
	        }
	    });
	}

	function removeProductFromCartAjax(container_element, product_id, product_type, order_date, _token, is_remove_element, callback){
	    $.ajax({
	        url: '/product/cart/remove',
	        type: 'post',
	        context: $(container_element),
	        data: {
	            product_id : product_id,
	            product_type : product_type,
	            date : order_date,
	            _token : _token,
	        },
	        error: function(xhr, status, error) {
	            console.log(error);
	        },
	        success: function(response) {
	            if(response['status']) {
	                removeLoading(container_element);

	                if(is_remove_element != 'undefined' && is_remove_element === true){
	                    removeElement(container_element, callback);
	                }
	                else{
	                    triggerCallback(callback);
	                }
	                
	            }
	            else {
	                GeneralMessage.animate_error_message(response['message']);
	            }
	        }
	    });
	}

	function removeElement(container_element, callback){
	    if($('.cart-summary-container').find(product_box_container_class).length > 1){
	        var target_cart_pnp_box_element = $(container_element).closest('.product-group');

	        if($(target_cart_pnp_box_element).find(product_box_container_class).length == 1){
	            animateRemove(container_element.closest('.product-group'), callback);
	        }
	        else{
	            animateRemove(container_element, callback);    
	        }
	    }
	    else{
	        var cart_second_header_container = $('.cart-summary-container .dropdown-menu .row.second-header');
	        var cart_container_element = $('.cart-summary-container .dropdown-menu .row.content');
	        var cart_footer_element = $('.cart-summary-container .dropdown-menu .row.footer');

	        animateEmpty(cart_container_element, function(){
	        	animateRemove(cart_footer_element, function(){
	        		cart_second_header_container.find('.reward').html('Anda belum memasukkan barang apapun');
	        		$('.cart-summary-container .dropdown-menu .nano').css({'height' : '34px'});
	        		$('.cart-summary-container .dropdown-menu .side-title').addClass('hidden');

	        		triggerCallback(callback);
	        	})
	        });
	    }
	}

	function animateRemove(container, callback){
	    $(container).slideUp("fast", function(){
	        $(this).remove();
	        triggerCallback(callback);
	    });
	}

	function triggerCallback(callback){
	    if(callback != undefined){
	        callback();
	    }
	}

	/*function getEmptyCartElement(){
	    var empty_cart_element = '<div class="row header"><div class="col-xs-12 p-a-0"><div class="cart-empty">Anda belum memasukkan barang apapun</div></div></div>';
	    return empty_cart_element;
	}*/

	function animateEmpty(container, callback){
	    $(container).slideUp("fast", function(){
	        $(this).empty();

	        if(callback != undefined){
	            callback();
	        }
	    });
	}

	function showLoading(container){
        $(container).find('.loading-container').removeClass('hidden');
        $(container).find('.qty-container').addClass('hidden');
    }

    function removeLoading(container){
        $(container).find('.loading-container').addClass('hidden');
        $(container).find('.qty-container').removeClass('hidden');
    }

    /*$(document).on('click','.trackClickSearch', function(){
    	var that = $(this);
    	if($('#search-input').val()!=''){
	     	Moengage.track_event("SEARCH_PRODUCT", {
					"interface"				: "desktop",
				    "search_keyword"		: $('#search-input').val(),
				    "clicked_keyword"		: ($(that).attr('title')!=null)?$(that).attr('title'):$('#search-input').val(),
				    "search_date"			: new Date()
			});
     	}
    });
     
    $(document).on('click','.trackClickSuggestedSearch', function(){
    	var that = $(this);
    	if($('#search-input').val()!=''){
	     	Moengage.track_event("SEARCH_PRODUCT", {
					"interface"				: "desktop",
				    "search_keyword"		: $(that).attr('title'),
				    "clicked_keyword"		: $(that).attr('title'),
				    "search_date"			: new Date()
			});
     	}
    });

    $(document).on('click','.trackSearch', function(){
     	if($('#search-input').val()!=''){
	     	Moengage.track_event("SEARCH_PRODUCT", {
					"interface"				: "desktop",
				    "search_keyword"		: $('#search-input').val(),
				    "clicked_keyword"		: $('#search-input').val(),
				    "search_date"			: new Date()
			});
	    }
    });

    $(document).on('click','#search-button', function(){
     	if($('#search-input').val()!=''){
	     	Moengage.track_event("SEARCH_PRODUCT", {
					"interface"				: "desktop",
				    "search_keyword"		: $('#search-input').val(),
				    "clicked_keyword"		: $('#search-input').val(),
				    "search_date"			: new Date()
			});
	    }
    }); */

})
//(jQuery);



var width = $( window ).width();
var __slick_5 = 5;
var __slick_4 = 4;
var __slick_3 = 3;
var __slick_2 = 2;
var __article_slick_3 = 3;

/*if (width <= 1182) {
	__slick_4 = 3;
	__slick_3 = 2;
	__slick_2 = 2;
	__article_slick_3 = 2;
}

if (width <= 980) {
	__slick_4 = 2;
	__slick_3 = 1;
	__slick_2 = 1;
	__article_slick_3 = 2;
}*/

function animateCartWiggle(){
    var wiggle_icon_cart = $(".icon-cart");
    var wiggle_sum_cart = $(".cart-sum");
    
    $(wiggle_icon_cart).wiggle(4, 100);
    $(wiggle_sum_cart).wiggle(4, 100);
}

function sticky_relocate(event) {
	if( $('.side-menu').length>0 &&  $('#sticky-anchor').length>0) {
	    var window_top			= $(window).scrollTop();
	    var window_left			= $(window).scrollLeft();
	    var div_top 			= $('#sticky-anchor').offset().top;
	    var separate_profile 	= $(".separate-profile").offset().left;
	    var footer_top 			= $("#site-footer").offset().top;
	    var div_width 			= $(".side-menu").width();
	    var div_height 			= $(".side-menu").height();
	    
	    var padding = 60;  // tweak here or get from margins etc

	    // Stop at Footer (Vertical Scroll)
	    if (window_top + div_height > footer_top - padding) {
	        $('.side-menu').css({top: (window_top + div_height - footer_top + padding) * -1})
	    } else if (window_top > div_top) {
	        $('.side-menu').addClass('sticky');
	        $('.side-menu').css({top: 80})
	    } else {
	        $('.side-menu').removeClass('sticky');
	    }

	    // Stop at separate_profile (Horizontal Scroll)
	    if (window_left > padding) {
			$('.side-menu').css({left: (window_left + div_width - separate_profile + padding) * -1})
	    }
	    else {
	        $('.side-menu').css('left','auto');
	    }
    }
}

var Phonemask = function(elem){
    elem.inputmask({
        "mask": ".99 *99999999999",
        definitions: {
            '.': {
                validator: "[+]",
                cardinality: 1,
                casing: "lower"
            },
            '*': {
                validator: "[1-9]",
                cardinality: 1,
                casing: "lower"
            }
        },
        placeholder: "",
        removeMaskOnSubmit: true, 
    });

    elem.focus(function(){
    	if ($(this).val() == '' || $(this).val() == '+') {
    		$(this).val('+62');
    	}
    });

    elem.blur(function(){
        var text = $(this).val();
        if (text == '+62') {
            $(this).val('');
        }
    });

    elem.keyup(function(){
        var text    = $(this).val();
        var c       = text.charAt(3);

        if (text.length > 1) {
            if (c == '0') {
                $(this).val('+62');
            }   
        }
        else{
            $(this).val('+62');
        }
    });
}

var Dollarmask = function(elem){
    elem.inputmask({
        definitions: {
            '.': {
                validator: "[$]",
                cardinality: 1,
                casing: "lower"
            },
        },
        placeholder: "",
        removeMaskOnSubmit: true,
    });

    elem.focus(function(){
        if ($(this).val() == '' || $(this).val() == '+') {
            $(this).val('$');
        }
    });

    elem.blur(function(){
        var text = $(this).val();
        if (text == '$') {
            $(this).val('');
        }
    });

    elem.keyup(function(){
        var text    = $(this).val();

        if (text.length < 1) {
            $(this).val('$');
        }
    });
}

Number.prototype.formatMoney = function(c, d, t){
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

jQuery.fn.wiggle = function (times, duration, easing, complete) {
    var self = this;

    if (times > 0) {
        this.animate({
            marginLeft: times-- % 2 === 0 ? -3 : 3
        }, duration, easing, function () {
            self.wiggle(times, duration, easing, complete);
        });
    } else {
        this.animate({
            marginLeft: 0
        }, duration, easing, function () {
            if (jQuery.isFunction(complete)) {
                complete();
            }
        });
    }
    return this;
};

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function deleteCookie( name, path, domain ) {
	if ( getCookie( name ) ) document.cookie = name + "=" +
	( ( path ) ? ";path=" + path : "") +
	( ( domain ) ? ";domain=" + domain : "" ) +
	"; Expires=Thu, 01-Jan-1970 00:00:01 GMT";
}

function get_message_template(alert_type, message_text){
	message_template = '<div class="col-xs-12 p-lr-0 error-message">' +
						    '<div class="alert alert-'+alert_type+' alert-dismissible">' +
								'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
								message_text +
							'</div>' +
						'</div>';

	return message_template;
}

var copyText = function(html_elem){
	var temp = document.createElement("input");
	temp.setAttribute("value", html_elem.innerHTML);
	document.body.appendChild(temp);
	temp.select();
	result = document.execCommand("copy");

	document.body.removeChild(temp);

	return result;
}

function check_qty_format_valid(evt, obj){
    var temp = obj.value;
    var charCode = (evt.which) ? evt.which : event.keyCode;
    
    return ((charCode == 8) || (charCode >= 48) && (charCode <= 57));
}

function check_qty_value(evt, obj){
    var default_min = 1;
    var default_max = 99;

    var data_qty_min = (obj.getAttribute("data-qty-min") != null /*&& obj.getAttribute("data-qty-min") > default_min*/) ? obj.getAttribute("data-qty-min") : default_min;
    var data_qty_max = (obj.getAttribute("data-qty-max") != null) ? obj.getAttribute("data-qty-max") : default_max;

    if(obj.value){
        var value = parseInt(obj.value);
        obj.value = value;

        if(value < data_qty_min){
            obj.value = data_qty_min;
        }

        if(value > data_qty_max){
            obj.value = data_qty_max;
        }

        return true;
    }
    
    return false;
}

function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}