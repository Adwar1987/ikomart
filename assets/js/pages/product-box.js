(function ($) {
    var product_box_container_class = ".product-box-container";
    let max_value = [];
    let availability = [];
    let is_pre_order = [];

    $.each($('.product-box-container'), function(index, value){
        uuid = $(this).data('uuid');
        availability[uuid] = $(this).find('.qty-container').data('availability-type');
        is_pre_order[uuid] = $(this).find('.qty-container').data('is-pre-order');

        if(availability[uuid] == 'limited_stock' && is_pre_order[uuid] != 1){
            max_value[uuid] = $(this).find('.qty-container').data('qty-max');
        } else {
            max_value[uuid] = 999999;
        }

        if($(this).find('.qty-container').find('input[name=order_qty]').val() == max_value[uuid]){
            $(this).find('.qty-container').find('.qty-plus').attr('disabled', true);
        }
    });

    
    
    if (typeof open_cart !== 'undefined' && open_cart === true) {
        $('.dropdown.cart-summary-container').find('[data-toggle=dropdown]').dropdown('toggle');
    }

    if($(product_box_container_class).length > 0){
        $(product_box_container_class+'[data-type="perishable"]').each(function(key, index){
            var product_uuid = $(this).data('uuid');
            
            $.ajax({
                url: '/utils/get_holidays?product_uuid=' + product_uuid,
                dataType: 'json',
                type: 'get',
                context: $(this),
                error: function() {
                    console.log('error');
                },
                success: function(responses) {
                    var forbidden = responses;

                    $(this).find('.datepicker').datepicker({
                        format: 'dd/mm/yyyy',
                        keyboardNavigation: false,
                        autoclose:true,
                        beforeShowDay:function(Date){
                            var year    = Date.getFullYear();
                            var month   = (1 + Date.getMonth()).toString();
                            month       = month.length > 1 ? month : '0' + month;
                            var day     = Date.getDate().toString();
                            day         = day.length > 1 ? day : '0' + day;

                            var curr_date = day + '/' + month + '/' + year;
                            if (forbidden.indexOf(curr_date) > -1) return false;
                        }
                    })
                    .on('changeDate', function (event) {
                        checkProductInCart(event);
                    });
                }
            });
        });
        
        $(product_box_container_class+' .buy').click(function(e) {
            let uuid = $(this).closest(product_box_container_class).data('uuid');
            showLoading($(this).closest(product_box_container_class));
            addToCart(e, true, 1, true, function(response){
                max_value[uuid] = response.data.product.quantity;
            });
        });

        $(product_box_container_class+' .qty-container').on('click', '.qty-plus', function(e){
            var plus_qty = $(e.delegateTarget).data('step');
            updateCart(e, true, plus_qty);
        });

        $(product_box_container_class+' .qty-container').on('click', '.qty-min', function(e){
            var minus_qty = -($(e.delegateTarget).data('step'));
            var input = $(this).closest(product_box_container_class).find('input[name=order_qty]');
            
            if (input.val() == 1) {
                input.val(parseInt(input.val()) + minus_qty);
            }
            
            updateCart(e, false, minus_qty);
        });
        
        $(product_box_container_class+' .qty-container').on('change', '.qty-number', function(e){
            var past_qty = $(this).closest(product_box_container_class).find('input[name=last_qty]').val();
            var step = $(this).val() - past_qty;

            if ($(this).val() > 0) {
                $(this).val(past_qty);
            }

            if($(this).val() === ""){
                $(this).val("0");
            }

            updateCart(e, false, step);
        });

        function checkProductInCart(event){
            var current_target = event.currentTarget;
            var that = $(current_target).closest(product_box_container_class);

            $.ajax({
                url: '/product/cart/check',
                dataType: 'json',
                type: 'post',
                context: $(that),
                data: {
                    type : 'perishable',
                    product_uuid : $(that).data('uuid'),
                    date : $(that).find('input[name=order_item_date]').val(),
                    _token : $(that).find('input[name=_token]').val()
                },
                error: function(xhr, status, error) {
                    console.log(error);
                },
                beforeSend: function(){
                    showLoading($(that));
                },
                success: function(response) {
                    if(response.status)
                    {
                        if(response.data.in_cart) {
                            _change($(this), response.data.qty_in_cart);
                        }
                        else {
                            _reset($(this));
                        }
                    }
                    else
                    if(response.error !== null || response.error !== "")
                    {
                        GeneralMessage.animate_error_message(response.error);
                    }
                },
                complete: function(){
                    removeLoading($(that));
                }
            });
        }

        function updateCart(event, is_animate_animation, step_qty){
            var current_target  = event.currentTarget;
            var that            = $(current_target).closest(product_box_container_class);
            

            var past_qty        = parseInt($(that).find('input[name=last_qty]').val());
            var curr_qty        = parseInt($(that).find('input[name=order_qty]').val());
            var uuid            = that.data('uuid');

            if((curr_qty + step_qty) <= 0){
                removeFromCart(event, step_qty);
            }
            else{
                addToCart(event, is_animate_animation, step_qty, false, function(response){
                    max_value[uuid] = response.data.product.quantity;
                });
            }
        }

        function removeFromCart(event, step_qty){
            var current_target  = event.currentTarget;
            var that            = $(current_target).closest(product_box_container_class);
            
            var past_qty        = 1;
            var cart_date       = $(that).find('input[name=order_item_date]').val();

            if($(that).data('type') == 'non') {
                cart_date   = 'non_perishable';
            }

            // WA-875 Improvement Cart Page (Remove modal confirmation delete product)
            /*bootbox.confirm({
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
                    showLoading($(that));
            /*
                    if(result) 
                    {
            */
                        $.ajax({
                            url: '/product/cart/remove',
                            type: 'post',
                            context: $(that),
                            data: {
                                product_id : $(that).data('uuid'),
                                product_type : $(that).data('type'),
                                date : $(that).find('input[name=order_item_date]').val(),
                                _token : $(that).find('input[name=_token]').val(),
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            },
                            success: function(response) {
                                if(response['status']) {
                                    removeLoading($(that));
                                    _update($(that), step_qty);

                                    updateCartBox($(that).data('uuid'), 0, cart_date, function(){
                                        updateAllValue();
                                        // animateCartWiggle();
                                    });
                                }
                                else {
                                    GeneralMessage.animate_error_message(response['message']);
                                }
                            }
                        });
            /*
                    } else {
                        removeLoading($(that));
                        $(that).find('input[name=order_qty]').val(past_qty);
                    }
                }
            });*/
        }

        function addToCart(event, is_animate_animation, step_qty, is_new_product, callback){
            var current_target  = event.currentTarget;
            
            var that            = $(current_target).closest(product_box_container_class);

            _update($(that), step_qty);

            var past_qty        = $(that).find('input[name=last_qty]').val();
            var curr_qty        = $(that).find('input[name=order_qty]').val();

            var cart_date       = $(that).find('input[name=order_item_date]').val();

            if($(that).data('type') == 'non') {
                cart_date   = 'non_perishable';
            }

            animateCartWiggle();

            if(is_new_product === undefined || !is_new_product) {
                updateCartBox($(that).data('uuid'), parseInt($(that).find('input[name=order_qty]').val()), cart_date);
                updateAllValue();
            }


            $.ajax({
                url: '/product/cart/add-ajax',
                dataType: 'json',
                type: 'post',
                context: $(that),
                data: {
                    order_item_product_uuid : $(that).data('uuid'),
                    order_item_product_type : $(that).data('type'),
                    order_item_date : $(that).find('input[name=order_item_date]').val(),
                    order_qty : parseInt($(that).find('input[name=order_qty]').val()),
                    _token : $(that).find('input[name=_token]').val()
                },
                error: function(xhr, status, error) {
                    console.log(error);
                },
                success: function(response) {
                    if(response.status)
                    {                    
                        updateLastValue($(this));

                        if(response.is_new_product_in_cart) {
                            Moengage.track_event("CART_ADD", {
                                "interface"             : "desktop",
                                "brand_name"            : response.data.product.merchant.name,
                                "product_name"          : response.data.product.name,
                                "product_id"            : response.data.product.id,
                                "product_url"           : "https://www.lemonilo.com/product/"+ response.data.product.slug,
                                "product_sku"           : response.data.product.sku,
                                "product_price"         : response.data.product.sell_price,
                                "product_image_url"     : "https://lemonilo.imgix.net/" + response.data.product.photo_url,
                                "sub_category_name"     : response.data.product.subcategory.name,
                                "sub_category_id"       : response.data.product.subcategory.id,
                                "sub_category_url"      : window.location.origin +"/"+ response.data.product.category.slug +"/"+ response.data.product.subcategory.slug,
                                "category_name"         : response.data.product.category.name,
                                "category_id"           : response.data.product.category.id,
                                "category_url"          : window.location.origin +"/"+ response.data.product.category.slug,
                                "super_category_name"   : response.data.product.super_category.name,
                                "super_category_id"     : response.data.product.super_category.id,
                            });

                            addToCardBox(response.data);
                            updateAllValue();
                        }
                        if(callback){
                            callback(response);
                        }
                        if($(current_target).is('.buy')){
                            notificationCartPopover();
                        }
                    }
                    else if(response.error !== null || response.error != "")
                    {
                        if(response.is_available == 0){
                            $(that).find('.sold-overlay').removeClass('hidden');
                            str_html = "<a href='javascript:void(0);' class='btn btn-warning-reverse btn-block btn-rectangular disabled-link'>Stok Kosong</a>"
                            $(that).find('.product-box-action-container').html(str_html);
                            updateTotalProductInCartUi(-curr_qty);
                        }
                        GeneralMessage.animate_error_message(response.error);
                    }
                },
                complete: function(){
                    if(parseInt(curr_qty) == 1){
                        removeLoading(that);
                    }
                }
            });
        }

        function _reset(box_element){
            var before_reset_value = $(box_element).find('input[name=order_qty]').val();
            updateValue(box_element, before_reset_value, 0);
            changeUi(box_element);
        }

        function _change(box_element, change_value){
            updateValue(box_element, change_value, change_value);
            changeUi(box_element);
        }

        function _update(box_element, step){
            var min_value = parseInt($(box_element).find('.qty-container').data('qty-min'));
            var uuid = $(box_element).data('uuid');
            var past_qty = parseInt($(box_element).find('input[name=last_qty]').val());
            var curr_qty = parseInt($(box_element).find('input[name=order_qty]').val()) + parseInt(step);

            if(curr_qty < min_value){
                curr_qty = min_value;
            }
            else if(curr_qty >= max_value[uuid]){
                curr_qty = max_value[uuid];
                step = curr_qty - past_qty;
            }

            updateValue(box_element, past_qty, curr_qty);
            refreshUi(box_element, step);
        }

        function updateLastValue(box_element){
            var curr_qty    = parseInt($(box_element).find('input[name=order_qty]').val());
            var past_qty    = curr_qty;

            updateValue(box_element, past_qty, curr_qty);
        }

        function updateValue(box_element, before_qty, update_qty){
            $(box_element).find('input[name=last_qty]').val(before_qty);
            $(box_element).find('input[name=order_qty]').val(update_qty);
        }

        function changeUi(box_element){
            changeButtonAction(box_element);
        }

        function refreshUi(box_element, step){
            changeButtonAction(box_element);
            refreshQuantityUi(box_element);
            updateTotalProductInCartUi(step);
        }

        function updateTotalProductInCartUi(qty)
        {
            var cur_qty = parseInt($('.cart-menu input[name=cur_qty]').val());
            var now_qty = cur_qty + qty;

            $('.cart-menu input[name=cur_qty]').val(now_qty);
            $('.cart-menu .cart-sum').html(now_qty > 99 ? '99+' : now_qty);
        }

        function changeButtonAction(box_element){
            var past_qty    = parseInt($(box_element).find('input[name=last_qty]').val());
            var curr_qty    = parseInt($(box_element).find('input[name=order_qty]').val());
            
            if(curr_qty >= 1){
                changeToProductInCartUI(box_element);
            }
            else{
                changeToProductNotInCartUI(box_element);
            }
        }

        function refreshQuantityUi(box_element) {
            var qty         = parseInt($(box_element).find('input[name=order_qty]').val());
            var uuid        = $(box_element).data('uuid');

            if(qty <= 0) {
                $(box_element).find('.qty-container .qty-min').attr('disabled', 'disabled');
            }
            else {
                $(box_element).find('.qty-container .qty-min').removeAttr('disabled');
            }

            if(qty >= max_value[uuid]) {
                $(box_element).find('.qty-container .qty-plus').attr('disabled', 'disabled');
            }
            else {
                $(box_element).find('.qty-container .qty-plus').removeAttr('disabled');
            }
        }

        function changeToProductInCartUI(box_element){
            $(box_element).find('.buy-container').addClass('hidden');
            $(box_element).find('.qty-container').removeClass('hidden');
        }

        function changeToProductNotInCartUI(box_element){
            $(box_element).find('.buy-container').removeClass('hidden');
            $(box_element).find('.qty-container').addClass('hidden');
        }

        function notificationCartPopover() {
            $('.cart-popover').webuiPopover('destroy');
            
            WebuiPopovers.show('.cart-popover', {
                width: 300,
                placement: 'bottom-left',
                autoHide: 2000,
                trigger: 'manual',
            });
        }

        /*function showMessageModal(box_element, message){
            if(!$('#remove-product-modal').is(':visible')){
                $('.modal.modal-cart').modal({
                    inverted: true,
                    onShow: function(){
                        var that = $(this);
                        that.find('.cart-message').html(message);

                        setTimeout(function(){
                            that.modal('hide');
                        }, 1500);

                    }
                })
                .modal('show');

                $(".ui.modal.modal-cart").css("margin-top","-58px");
            }
        }*/

        function showLoading(box_element){
            $(box_element).find('.loading-container').show();
        }

        function removeLoading(box_element){
            $(box_element).find('.loading-container').hide();
        }

        function addToCardBox(data) {
            if(data != null) {
                var element     = null;
                var date        = moment(data.date).format('DD/MM/YYYY');

                var gimmick_price = parseFloat(data.product.gimmick_price).formatMoney(0, ',', '.');
                var sell_price = parseFloat(data.product.sell_price).formatMoney(0, ',', '.');
                var reward = parseFloat(data.product.reward).formatMoney(0, ',', '.');

                if (data.product.gimmick_price >= 1000) {
                    gimmick_price = updatePriceToSuperscriptThousandFormat(gimmick_price);
                }

                if (data.product.sell_price >= 1000) {
                    sell_price= updatePriceToSuperscriptThousandFormat(sell_price);
                }

                if (data.product.reward >= 1000) {
                    reward = updatePriceToSuperscriptThousandFormat(reward);
                }

                //check if cart is empty
                if($('.cart-summary-container .product-group').length == 0) {
                    var cart_content = '<div class="nano">';
                    cart_content    += '<div class="nano-content">';
                    cart_content    += '<div class="row second-header">';
                    cart_content    += '<div class="col-xs-12">';
                    cart_content    += '<div class="reward">Cashback ke Moni Coins <sup class="pricing">Rp</sup>&nbsp;<span id="popup-reward-text">0</span></div>';
                    cart_content    += '</div>';
                    cart_content    += '</div>';
                    cart_content    += '<div class="row content">';
                    cart_content    += '<div class="product-group-container col-xs-12 p-a-0">';
                    cart_content    += '</div>';
                    cart_content    += '</div>';
                    cart_content    += '</div>';
                    cart_content    += '</div>';
                    cart_content    += '<div class="row footer">';
                    cart_content    += '<div class="col-xs-12 p-a-0">';
                    cart_content    += '<div class="button-to-cart">';
                    cart_content    += '<a href="/cart" title="Lanjut ke Pembayaran"><button class="btn btn-full">Lanjut ke Pembayaran</button></a>';
                    cart_content    += '</div>';
                    cart_content    += '</div>';
                    cart_content    += '</div>';

                    $('.cart-summary-container .cart-content').html(cart_content);
                    $('.cart-summary-container .side-title').removeClass('hidden');
                }

                if($('.cart-summary-container .product-group-container .product-group[data-date="' + date + '"]').length > 0 && data.product.is_perishable) {
                    //product group already existed
                    element = $('#target-clone-cart-popup .cart-popup-product-box-container').clone();

                    element.attr('data-uuid', data.product.id);
                    element.attr('data-type', data.product.is_perishable ? 'perishable' : 'non');
                }
                else {
                    //product group not exist
                    element = $('#target-clone-cart-popup').find('.product-group').clone();
                    
                    element.attr('data-date', data.product.is_perishable ? date : 'non_perishable');

                    if(!data.product.is_perishable) {
                        element.find('.cart-popup-header-title').remove();
                    }
                    else {
                        element.find('.cart-popup-header-title').html('Pengiriman ' + moment(data.date).format('DD MMM YYYY'));
                    }

                    element.find('.cart-popup-product-box-container').attr('data-uuid', data.product.id);
                    element.find('.cart-popup-product-box-container').attr('data-type', data.product.is_perishable ? 'perishable' : 'non');
                }

                element.find('.image-container .product-image-link').attr('href', '/product/' + data.product.slug);
                element.find('.image-container .product-image-link').attr('title', data.product.name);
                element.find('.image-container .product-image-link .product-image').attr('src', 'https://lemonilo.imgix.net/' + data.product.photo_url + '?w=110&auto=format&q=50');
                element.find('.image-container .product-image-link .product-image').attr('title', 'data.product.name');
                element.find('.image-container .product-image-link .product-image').attr('alt', 'data.product.name');

                element.find('.desc-container .item-merchant .product-merchant-link').attr('href', '/brand/' + data.product.merchant.slug);
                element.find('.desc-container .item-merchant .product-merchant-link').html(data.product.merchant.name);

                element.find('.desc-container .item-remove .product-remove-link').attr('href', '/product/card/remove/' + data.cart_detail_id);
                element.find('.desc-container .item-remove .product-remove-link').attr('onclick', "mixpanelRemoveCart('" + data.product.name + "', " + data.qty + ", " + data.product.sell_price + ")");

                element.find('.item-name .product-link').attr('href', '/product/' + data.product.slug);
                element.find('.item-name .product-link').attr('title', data.product.name);
                element.find('.item-name .product-link').html(data.product.name);

                if(data.product.gimmick_price != data.product.sell_price) {
                    element.find('.item-price .bprice').html(gimmick_price);
                }
                else {
                    element.find('.item-price .bprice').remove();
                }

                element.find('.item-price .product-sell-price').html('<sup class="pricing">Rp</sup>&nbsp;' + sell_price);

                if(data.product.reward > 0) {
                    element.find('.item-point').html('Cashback ke Moni Coins <sup class="pricing">Rp</sup>&nbsp;' + reward);
                }
                else {
                    element.find('.item-point').remove();
                }
                element.find('#product_fulfillment').val(data.product.fulfillment_by_lemonilo);
                element.find('#product_item_price').val(data.product.sell_price);
                element.find('#product_item_save').val(data.product.save);
                element.find('#product_item_reward').val(data.product.reward);
                element.find("input[name='order_item_date[]']").val(date);

                if(data.product.is_perishable) {
                    //product group already existed
                    if($('.cart-summary-container .product-group[data-date="' + date + '"]').length > 0){
                        $('.cart-summary-container .product-group-container .product-group[data-date="' + date + '"]').append(element);
                    }
                    else{
                        $('.cart-summary-container .product-group-container').prepend(element);
                    }
                   
                }
                else {
                    if($('.cart-summary-container .product-group-container .product-group[data-date="non_perishable"]').length > 0){
                        element = element.children();
                        $('.cart-summary-container .product-group-container .product-group[data-date="non_perishable"]').append(element);
                    }
                    else{
                        $('.cart-summary-container .product-group-container').append(element);
                    }
                }

                cart_popup_new_element = element;
            }
        }

        function updateCartBox(product_uuid, qty, date, callback) {
            if(qty > 0) {
    
                $('.cart-summary-container .product-group[data-date="' + date + '"] .cart-popup-product-box-container[data-uuid=' + product_uuid + '] input[name="order_qty[]"]').val(qty);
                $('.cart-summary-container .product-group[data-date="' + date + '"] .cart-popup-product-box-container[data-uuid=' + product_uuid + '] input.last-qty').val(qty);

                if(qty >= max_value[product_uuid]){
                    $('.cart-summary-container .product-group[data-date="' + date + '"] .cart-popup-product-box-container[data-uuid=' + product_uuid + '] #cart-qty-plus').attr('disabled', true);
                } else {
                    $('.cart-summary-container .product-group[data-date="' + date + '"] .cart-popup-product-box-container[data-uuid=' + product_uuid + '] #cart-qty-plus').attr('disabled', false);
                }
            }
            else {
                if($('.cart-summary-container').find('.cart-popup-product-box-container').length > 1) {
                    removeCartBoxProduct($('.cart-summary-container .product-group[data-date="' + date + '"] .cart-popup-product-box-container[data-uuid=' + product_uuid + ']'), callback);
                }
                else {
                    var cart_second_header_container = $('.cart-summary-container .dropdown-menu .row.second-header');
                    var cart_container_element = $('.cart-summary-container .dropdown-menu .row.content');
                    var cart_footer_element = $('.cart-summary-container .dropdown-menu .row.footer');

                    animateRemove(cart_container_element, function(){
                        animateRemove(cart_footer_element, function(){
                            cart_second_header_container.find('.reward').html('Anda belum memasukkan barang apapun');
                            $('.cart-summary-container .dropdown-menu .nano').css({'height' : '34px'});
                            $('.cart-summary-container .dropdown-menu .side-title').addClass('hidden');
                            triggerCallback(callback);
                        })
                    });
                }
            }
        }

        function removeCartBoxProduct(container, callback) {
            if($(container).closest('.product-group').find('.cart-popup-product-box-container').length <= 1) {
                animateRemove($(container).closest('.product-group'), callback);
            }
            else {
                animateRemove(container, callback);
            }
        }

        function animateRemove(container, callback){
            $(container).slideUp("fast", function(){
                $(this).remove();
                triggerCallback(callback);
            });
        }

        function animateEmpty(container, callback){
            $(container).slideUp("fast", function(){
                $(this).empty();

                if(callback != undefined){
                    callback();
                }
            });
        }

        function triggerCallback(callback){
            if(callback != undefined){
                callback();
            }
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

                $(value).closest($('.cart-summary-container .cart-popup-product-box-container')).find('.subtotal').html((price * quantity).formatMoney(0, ',', '.'));

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
    };
})(jQuery);