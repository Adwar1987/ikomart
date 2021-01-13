(function ($) {
    $('select.dropdown').dropdown(
        // {
        //     forceSelection: false,
        // }
    );

    $('.ui.radio.checkbox').checkbox();

	$('.ui.accordion').accordion();

    $('.accordion-static').accordion({
        collapsible: false
    });

    $('.menu .item').tab();

    $('#subscribeModal').modal('show');
	
    $('.message .close').on('click', function() {
	    $(this)
	       .closest('.message')
	       .transition('fade');
	});

    $("img.lazy").lazyload({
        effect : "fadeIn",
        threshold : 100,
        load : function(){
            // $(this).css('opacity', '1');
            $(this).removeClass("lazy");
        }
    });

    // Slidebars
    var sidemenu_controller = new slidebars();
    var search_controller = new slidebars();
    sidemenu_controller.init();
    search_controller.init();

    // Sidemenu Slidebars
    $( '.js-toggle-left-slidebar' ).on( 'click', function ( event ) {
        event.stopPropagation();
        sidemenu_controller.toggle( 'left-slidebar' );
    } );

    $( sidemenu_controller.events ).on( 'opened', function () {
        $( '[canvas="container"]' ).addClass( 'js-close-any-slidebar' );
        $( '[canvas="nav"]' ).addClass( 'js-close-any-slidebar' );
        $( '.canvas-overlay' ).addClass( 'js-close-any-slidebar' );
        hideScrollOverlay();
    } );
    $( sidemenu_controller.events ).on( 'closed', function () {
        $( '[canvas="container"]' ).removeClass( 'js-close-any-slidebar' );
        $( '[canvas="nav"]' ).removeClass( 'js-close-any-slidebar' );
        $( '.canvas-overlay' ).removeClass( 'js-close-any-slidebar' );
        showScrollOverlay();
    } );

    $( 'body' ).on( 'click', '.js-close-any-slidebar', function ( event ) {
        event.stopPropagation();
        sidemenu_controller.close();
    } );

    // Search Slidebars
    $( '.toggle-search-slidebar' ).on( 'click', function ( event ) {
        event.stopPropagation();
        search_controller.toggle( 'search-slidebar' );
    } );

    $( search_controller.events ).on( 'opened', function () {
        $( '.sidebar-search' ).addClass( 'show-opacity' );
        $('#search-input').focus();
        hideIntercom();
        hideScrollOverlay();
    } );
    $( search_controller.events ).on( 'closing', function () {
        showIntercom();
        $('#search-placeholder').show();
        $('#search-placeholder').prop( "disabled", false );
        $( '.sidebar-search' ).removeClass( 'show-opacity' );
        showScrollOverlay();
    } );

    // Search Prevent
    $('#search-placeholder').click(function(e) {
        e.preventDefault();
        $('#search-placeholder').prop( "disabled", true );
        $('#search-placeholder').hide();

        return false;
    });
    $( "#search-input" ).change(function() {
        var search_input = $( this ).val();
        $( "#search-placeholder" ).val(search_input);
    });
    $('#clearable-button').click(function() {
        $( "#search-input" ).val('');
        $( "#search-placeholder" ).val('');
        $('#search-input').focus();

        search($(that).val());
    });
    // Search Prevent END

    // Multilevel menu in Main Menu Left
    $('#menu').slinky({
        title: false,
        label: true,
        resize: false,
    });

    // Multilevel menu in Search Top
    $('#menu-search').slinky({
        title: false,
        label: true,
        resize: false,
    });

    // Refer Friend add Form Input
    $('.add-field').click(function(){
        $('.append-container').children().last().clone().appendTo('.append-container');
        $('.append-container').children().last().find('input[type=email]').val('');
        $('.append-container').children().last().find('input').attr('placeholder', 'Email ' + $('.append-container').children().length);
    });
    // Refer Friend add Form Input END
    
    // Fixed Back to Top
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

    // Referral Point Form
    $('#btn-referral-submit').click(function(e){
        e.preventDefault();

        $(this).prop('disabled', true);
        $(this).html('<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i>');
        var that    = $(this);
        var parent  = $('#referral-program-form');
        var info    = $('.referral-program-banner-content .info-block');
        var success = $('.referral-program-banner-content .success-block');
        var email   = $('#referral-email').val();
        var token   = $('#_token').val();

        if (email == '') {
            parent.find('.form-group').addClass('has-error');
            info.html('<div class="ui negative message m-b-15"><i class="close icon"></i><p><i class="fa fa-warning m-r-5"></i>Mohon masukkan email Anda</p></div>');
            that.html('Kirim');
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
                    that.html('Kirim');
                    that.prop('disabled', false);
                },
                success: function(responses) {
                    if (responses['message']['type'] == 'error') {
                        parent.find('.form-group').addClass('has-error');
                        info.html('<div class="ui negative message m-b-15"><i class="close icon"></i><p><i class="fa fa-warning m-r-5"></i>'+ responses['message']['desc'] +'</p></div>');
                        that.html('Kirim');
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
                                "interface"             : "m-web",
                                "subscribe_source"      : "subscribe-box",
                                "subscribe_email"       : email
                            });
                        }
                        customer_id = responses['body'];
                        setCookie('user_email', email, 3);
                        success.removeClass('hidden');
                        parent[0].reset();
                        success.html('<div class="ui positive message m-b-15"><p><i class="fa fa-warning m-r-5"></i>'+ responses['message']['desc'] +'</p></div>');
                        that.html('Kirim');
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

        var that    = $(this);
        var parent  = $('#invitation-form');
        var token   = $('#invitation-form #_token').val();
        var email   = $('#invitation-form input[name="email[]"]').map(function (idx, ele) {
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
                show_message('negative', 'Something went wrong, please refresh this page again !', $(parent).parent(), 'before');
            },
            success: function(responses) {
                remove_loading(that);

                if (responses['message']['type'] == 'error') {
                    show_message('negative', responses['message']['desc'], $(parent).parent(), 'before');
                    
                    return false;
                }
                else{
                    parent[0].reset();

                    show_message('positive', responses['message']['desc'], $(parent).parent(), 'before');

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

    $('.rating.rating-loading').rating({
        filledStar: '<i class="fa fa-star"></i>',
        emptyStar: '<i class="fa fa-star"></i>'
    });

    /* START ALGOLIA FUNCTIONALITY */

    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();

    if($('#search-input').val() != '') {
        search($('#search-input').val());
    }

    $('#search-input').on('change keyup paste', function() {
        var that = $(this);
        delay(function(){
            search($(that).val())
        }, 200 );
    });

    /* Temporary hide because function didnt show result Suggested Keywords
    query_suggestion_helper.on('result', function(content) {
        if(content.hits.length > 0) {
            $('#search-result-query-suggestion').removeClass('hidden');

            $('#search-result-query-suggestion #search-result-query-suggestion-list').empty();

            $.each(content.hits, function(index, result){
                $('#search-result-query-suggestion #search-result-query-suggestion-list').append('<div class="scategories"><div class="product-titles"><a class="trackClickSuggestedSearch" href="/search/query?search=' + result.query + '" title="' + result.query + '">' + result.query + '</a></div></div>');
            });
        }
        else {
            $('#search-result-query-suggestion').removeClass('hidden');
            $('#search-result-query-suggestion #search-result-query-suggestion-list').html('<p><em>Tidak ada rekomendasi keyword yang sesuai.</em></p>');
        }
    });*/

    /*merchant_helper.on('result', function(content) {
        if(content.hits.length > 0) {
            $('#search-result-merchant').removeClass('hidden');

            $('#search-result-merchant #search-result-merchant-list').empty();

            $.each(content.hits, function(index, result){
                var merchant_element = '';
                merchant_element += '<div class="sproduct">';
                merchant_element += '<a href="/brand/' + result.merchant_slug + '" class="product-infos__thumbnail trackClickSearch" title="' + result.merchant_name + '">';
                merchant_element += '<img class="trackClickSearch" src="https://lemonilo.imgix.net/' + (result.merchant_photo_url != undefined ? result.merchant_photo_url : 'no-image/merchant.jpg') + '?auto=format&w=60" title="' + result.merchant_name + '" alt="' + result.merchant_name + '">';
                merchant_element += '</a>';
                merchant_element += '<div class="product-titles">';
                merchant_element += '<div class="item-name">';
                merchant_element += '<a class="trackClickSearch" href="/brand/' + result.merchant_slug + '" title="' + result.merchant_name + '">' + result.merchant_name + '</a>';
                merchant_element += '</div>';
                merchant_element += '</div>';
                merchant_element += '<div class="product-price">';
                merchant_element += '</div>';
                merchant_element += '</div>';

                $('#search-result-merchant #search-result-merchant-list').append(merchant_element);
            });
        }
        else {
            $('#search-result-merchant').removeClass('hidden');
            $('#search-result-merchant #search-result-merchant-list').html('<p><em>Tidak ada brand yang sesuai dengan pencarian Anda.</em></p>');
        }
    });*/

    /*product_helper.on('result', function(content) {
        if(content.hits.length > 0) {
            $('#search-result-product').removeClass('hidden');
            $('.header-search-result #btn-see-all-product').removeClass('hidden');

            $('#search-result-product #search-result-product-list').empty();

            $.each(content.hits, function(index, result){
                var product_element = '';
                product_element += '<div class="sproduct">';
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
                product_element += '</div>';

                $('#search-result-product #search-result-product-list').append(product_element);
            });
        }
        else {
            $('#search-result-product').removeClass('hidden');
            $('#search-result-product #search-result-product-list').html('<p><em>Tidak ada produk yang sesuai dengan pencarian Anda.</em></p>');
            $('.header-search-result #btn-see-all-product').addClass('hidden');
        }
    });

    category_helper.on('result', function(content){
        if(content.hits.length > 0) {
            $('#search-result-category').removeClass('hidden');

            $('#search-result-category #search-result-category-list').empty();

            $.each(content.hits, function(index, result){
                $('#search-result-category #search-result-category-list').append('<div class="scategories"><div class="product-titles"><a href="/' + result.category_slug + '" title="' + result.category_name + '">' + result.category_name + '</a></div></div>');
            });
        }
        else {
            $('#search-result-category').removeClass('hidden');
            $('#search-result-category #search-result-category-list').html('<p><em>Tidak ada kategori yang sesuai dengan pencarian Anda.</em></p>');
        }
    });

    product_tag_helper.on('result', function(content) {
        if(content.hits.length > 0) {
            $('#search-result-product-tag').removeClass('hidden');

            $('#search-result-product-tag #search-result-product-tag-list').empty();

            $.each(content.hits, function(index, result){
                var product_tag_element = '';
                product_tag_element += '<div class="sproduct-tag">';
                product_tag_element += '<a class="trackClickSearch" href="/tag/' + result.product_tag_slug + '" title="' + result.product_tag_name + '">';
                product_tag_element += '<div class="tag-icons">';
                product_tag_element += '<span class="icon ' + result.product_tag_icon + '"></span>';
                product_tag_element += '</div>';
                product_tag_element += '<div class="tag-titles">';
                product_tag_element += result.product_tag_name;
                product_tag_element += '</div>';
                product_tag_element += '</a>';
                product_tag_element += '</div>';

                $('#search-result-product-tag #search-result-product-tag-list').append(product_tag_element);
            });
        }
        else {
            $('#search-result-product-tag').removeClass('hidden');
            $('#search-result-product-tag #search-result-product-tag-list').html('<p><em>Tidak ada manfaat produk yang sesuai dengan pencarian Anda.</em></p>');
        }
    });

    article_helper.on('result', function(content) {
        if(content.hits.length > 0) {
            $('#search-result-article').removeClass('hidden');
            $('.header-search-result #btn-see-all-article').removeClass('hidden');

            $('#search-result-article #search-result-article-list').empty();

            $.each(content.hits, function(index, result){
                var article_element = '';
                article_element += '<div class="sblog">';
                article_element += '<a href="/blog/' + result.article_slug + '">';
                article_element += '<img class="trackClickSearch" src="https://lemonilo.imgix.net/' + (result.article_photo_url != undefined ? result.article_photo_url : 'no-image/article.jpg') + '?w=180&auto=format&q=50" title="' + result.article_title + '" alt="' + result.article_title + '">';
                article_element += '</a>';
                article_element += '<div class="product-titles">';
                article_element += '<div class="item-name ellipsis-wrapper">';
                article_element += '<a class="trackClickSearch" href="/blog/' + result.article_slug + '" title="' + result.article_title + '">' + result.article_title + '</a>';
                article_element += '</div>';
                article_element += '</div>';
                article_element += '</div>';

                $('#search-result-article #search-result-article-list').append(article_element);
            });
        }
        else {
            $('#search-result-article').removeClass('hidden');
            $('#search-result-article #search-result-article-list').html('<p><em>Tidak ada artikel yang sesuai dengan pencarian Anda.</em></p>');
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
    $(document).on('click','.trackClickSearch', function(){
        var that = $(this);
        if( $('#search-input').val()!=''){
            Moengage.track_event("SEARCH_PRODUCT", {
                    "interface"             : "m-web",
                    "search_keyword"        : $('#search-input').val(),
                    "clicked_keyword"       : ($(that).attr('title')!=null)?$(that).attr('title'):$('#search-input').val(),
                    "search_date"           : new Date()
            });
        }
    });
    
    $(document).on('click','.trackClickSuggestedSearch', function(){
        var that = $(this);
        if( $('#search-input').val()!=''){
            Moengage.track_event("SEARCH_PRODUCT", {
                    "interface"             : "m-web",
                    "search_keyword"        : $(that).attr('title'),
                    "clicked_keyword"       : $(that).attr('title'),
                    "search_date"           : new Date()
            });
        }
    });

    $(document).on('click','.trackSearch', function(){
        if( $('#search-input').val()!=''){
            Moengage.track_event("SEARCH_PRODUCT", {
                    "interface"             : "m-web",
                    "search_keyword"        : $('#search-input').val(),
                    "clicked_keyword"       : $('#search-input').val(),
                    "search_date"           : new Date()
            });
        }
    });

    $(document).on('click','#search-button', function(){
        if( $('#search-input').val()!=''){
            Moengage.track_event("SEARCH_PRODUCT", {
                    "interface"             : "m-web",
                    "search_keyword"        : $('#search-input').val(),
                    "clicked_keyword"       : $('#search-input').val(),
                    "search_date"           : new Date()
            });
        }
    });

    /* END ALGOLIA FUNCTIONALITY */

})(jQuery);

function search(query) {
    if(query != '') {
        $('#search-result-default-suggestion').addClass('hidden');

        // Moengage.track_event("SEARCH_PRODUCT", {
        //     "interface"             : "desktop",
        //     "search_keyword"        : query,
        //     "clicked_keyword"       : query,
        //     "search_date"           : new Date()
        // });

        /*query_suggestion_helper.setQuery(query)
                           .setQueryParameter('hitsPerPage', 4)
                           .search();

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
                      .search();*/
    }
    else {
        $('#search-result-default-suggestion').removeClass('hidden');
        $('#search-result-query-suggestion').addClass('hidden');
        $('#search-result-merchant').addClass('hidden');
        $('#search-result-product').addClass('hidden');
        $('#search-result-category').addClass('hidden');
        $('#search-result-product-tag').addClass('hidden');
        $('#search-result-article').addClass('hidden');
    }
}

function showIntercom() {
    $('#intercom-container').removeClass('hidden');
};

function hideIntercom() {
    $('#intercom-container').addClass('hidden');
};

function showScrollOverlay() {
    $(document.documentElement).css('overflow', '');
    $("body").css('overflow', '');
};

function hideScrollOverlay() {
    $(document.documentElement).css('overflow', 'hidden');
    $("body").css('overflow', 'hidden');
};

function showButtonToTop() {
    if ($(window).scrollTop() > 100) {
        $( '.back-to-top-container' ).css({
            "display": "block",
        });
    }
};

function hideButtonToTop() {
    $( '.back-to-top-container' ).css({
        "display": "none",
    });
};

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

var width = $( window ).width();
var __slick_4 = 4;
var __slick_3 = 3;
var __article_slick_3 = 3;

if (width <= 1182) {
    __slick_4 = 3;
    __slick_3 = 2;
    __article_slick_3 = 2;
}

if (width <= 980) {
    __slick_4 = 2;
    __slick_3 = 2;
    __article_slick_3 = 2;
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
    message_template = '<div class="ui message '+alert_type+' m-b-15 error-message">' +
                            '<i class="close icon"></i>' +
                            '<p>' +
                                message_text +
                            '</p>' +
                        '</div>';

    return message_template;
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

function show_loading(element){
    $(element).prop('disabled', true);
    $(element).prepend('<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i>');
}

function remove_loading(element){
    $(element).find('i').remove();
    $(element).prop('disabled', false);
}

function _only_number_ (evt,obj) {
    var temp = obj.value;
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if(charCode == 46) temp += '.';
    tempArr = temp.split('.');
    if(tempArr.length > 2) return false;
    
    return ((charCode == 8) || (charCode >= 48) && (charCode <= 57));
}

function max_length(evt, obj) {
    if (obj.value.length > obj.maxLength) 
        obj.value = obj.value.slice(0, obj.maxLength);
}

function check_qty_format_valid(evt, obj){
    var temp = obj.value;
    var charCode = (evt.which) ? evt.which : event.keyCode;
    
    return ((charCode == 8) || (charCode >= 48) && (charCode <= 57));
}

function check_qty_value(evt, obj){
    var default_min = 1;
    var default_max = 9999;

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

// Clear Input Form
Array.prototype.forEach.call(document.querySelectorAll('.clearable-input'), function(el) {
    var input = el.querySelector('input');

    conditionallyHideClearIcon();
    input.addEventListener('input', conditionallyHideClearIcon);
    el.querySelector('[data-clear-input]').addEventListener('click', function(e) {
        input.value = '';
        conditionallyHideClearIcon();
    });

    function conditionallyHideClearIcon(e) {
        var target = (e && e.target) || input;
        target.nextElementSibling.style.display = target.value ? 'block' : 'none';
    }
})

String.prototype.ucwords = function() {
    str = this.toLowerCase();
    return str.replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
        function($1){
            return $1.toUpperCase();
        });
}