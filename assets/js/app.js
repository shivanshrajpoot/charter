var editor; // Global Editor
var table; // Global Editor
function strip_html_tags(str){
   if ((str===null) || (str===''))
       return false;
  else
   str = str.toString();
  return str.replace(/<[^>]*>/g, '');
}
$(function(){
/**
 * Datatable
 */
    _table = $('.table')
    if (_table.length > 0) {
        table = $('.table').DataTable()
    }
    $('.sidebar_link .nav-item').on('click',function(){
        alert()
        $('.sidebar_link .nav-item').each(function(){
            $(this).toggleClass('active');
        })
    })
})

$('.hasTimepicker').wickedpicker();
$('.delete-charter').on('click',function(){
    var data = table.row( $(this).parents('tr') ).data();
    target_id = $(this).data('target');
    $.ajax({
        url: 'delete-charter', 
         data: {id:target_id,},
         cache: false, 
         type: 'POST', 
         dataType: 'json',
         success: function($response){
            if ($response.success="success") {
                swal({
                    title: $response.message,
                    text: "Success",
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    closeOnEsc: false,
                    allowOutsideClick:false,
                    cancelButtonColor: '#d33',
                    button: 'Ok',
                    timer: 1000
                });
                setTimeout(function(){
                    location.reload()
                },1000)
            }
         }
    });
})
$('.assign-charter').on('click',function(){
    target_id = $(this).data('target');
    var modal = $('#assignUser');
    modal.modal('show')
})
$('.edit-charter').on('click',function(){
    var data = table.row( $(this).parents('tr') ).data();
    var modal = $('#createCharter');
    var target_id = $(this).attr('data-target');
    console.log($(this).attr('data-target'));
    modal.modal('show')
    $('#createCharter .modal-title').html('Edit Charter...')
    modal.find('input').each(function(index){
        let type = $(this).attr('type')
        if (type !=='hidden') {
            $(this).val(data[index])
        }
    })
    $('<input>').attr({
        "type": 'hidden',
        "id": 'target_id',
        "name": 'id',
        "value":target_id
    }).appendTo('form');
})
$('.edit-aircraft').on('click',function(){
    var data = table.row( $(this).parents('tr') ).data();
    var modal = $('#createAircraft');
    var target_id = $(this).attr('data-target');
    modal.modal('show')
    $('#createAircraft .modal-title').html('Edit Aircraft...')
    modal.find('input').each(function(index){
        let name = $(this).attr('name')
        let type = $(this).attr('type')
        if (name !=='image' || type !=='hidden') {
            $(this).val(data[index]);
        }
    })
    $('<input>').attr({
        "type": 'hidden',
        "id": 'target_id',
        "name": 'id',
        "value":target_id
    }).appendTo('form');
})
$('.delete-aircraft').on('click',function(){
    var data = table.row( $(this).parents('tr') ).data();
    target_id = $(this).data('target');
    swal({
        title: 'Are you sure?',
        text: "This item will be deleted.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        button: 'Ok',
        closeOnEsc: false,
        allowOutsideClick:false,
    }).then(function (result) {
        $.ajax({
            url: 'delete-aircraft', 
             data: {id:target_id,},
             cache: false, 
             type: 'POST', 
             dataType: 'json',
             success: function($response){
                if ($response.success="success") {
                    swal({
                        title: $response.message,
                        text: "Success",
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        closeOnEsc: false,
                        allowOutsideClick:false,
                        cancelButtonColor: '#d33',
                        button: 'Ok',
                        timer: 1000
                    });
                    setTimeout(function(){
                        location.reload()
                    },1000)
                }
             }
        });
    })
})
$('.edit-user').on('click',function(){
	var data = table.row( $(this).parents('tr') ).data();
	var modal = $('#createUser');
	var target_id = $(this).attr('data-id');
    console.log(target_id)
    $('#createUser .modal-title').html('Edit User...')
	modal.modal('show')
	modal.find('input').each(function(index){
        var input_id = String($(this).attr('id'))
        if (input_id != 'password' && input_id != 'password_conf') {
		  $(this).val(data[index+1]);  
        }
	})
	$('<input>').attr({
	    "type": 'hidden',
	    "id": 'target_id',
	    "name": 'id',
	    "value":target_id
	}).appendTo('form');
})
$('.delete-user').on('click',function(){
    var data = table.row( $(this).parents('tr') ).data();
    target_id = $(this).data('id');
    console.log(target_id);
    swal({
        title: 'Are you sure?',
        text: "This item will be deleted.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        button: 'Ok',
        closeOnEsc: false,
        allowOutsideClick:false,
    }).then(function (result) {
        $.ajax({
            url: 'delete-user', 
             data: {id:target_id,},
             cache: false, 
             type: 'POST', 
             dataType: 'json',
             success: function($response){
                if ($response.success="success") {
                    swal({
                        title: $response.message,
                        text: "Success",
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        closeOnEsc: false,
                        allowOutsideClick:false,
                        cancelButtonColor: '#d33',
                        button: 'Ok',
                        timer: 1000
                    });
                    setTimeout(function(){
                        location.reload()
                    },1000)
                }
             }
        });
    })
})
$('.delete-quote').on('click',function(){
    var data = table.row( $(this).parents('tr') ).data();
    target_id = $(this).data('target');
    swal({
           title: 'Are you sure?',
           text: "This item will be deleted.",
           type: 'warning',
           confirmButtonColor: '#3085d6',
           button: 'Ok',
           closeOnEsc: false,
           allowOutsideClick:false,
       }).then(function (result) {
        $.ajax({
            url: 'delete-quote', 
             data: {id:target_id,},
             cache: false, 
             type: 'POST', 
             dataType: 'json',
             success: function($response){
                if ($response.success="success") {
                    swal({
                        title: $response.message,
                        text: "Success",
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        closeOnEsc: false,
                        allowOutsideClick:false,
                        cancelButtonColor: '#d33',
                        button: 'Ok',
                        timer: 1000
                    });
                    setTimeout(function(){
                        location.reload()
                    },1000)
                }
             }
        });
    })
})

$('.edit-destination').on('click',function(){
    var data = table.row( $(this).parents('tr') ).data();
    var modal = $('#createDestination');
    var target_id = $(this).attr('data-target');
    modal.modal('show')
    $('#createDestination .modal-title').html('Edit Destination...')
    modal.find('input').each(function(index){
        let name = $(this).attr('name')
        let type = $(this).attr('type')
        if (name !=='image' || type !=='hidden') {
            $(this).val(data[index]);
        }
    })
    $('<input>').attr({
        "type": 'hidden',
        "id": 'target_id',
        "name": 'id',
        "value":target_id
    }).appendTo('form');
})
$('.delete-destination').on('click',function(){
    var data = table.row( $(this).parents('tr') ).data();
    target_id = $(this).data('target');
    swal({
        title: 'Are you sure?',
        text: "This item will be deleted.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        button: 'Ok',
        closeOnEsc: false,
        allowOutsideClick:false,
    }).then(function (result) {
        $.ajax({
            url: 'delete-destination', 
             data: {id:target_id,},
             cache: false, 
             type: 'POST', 
             dataType: 'json',
             success: function($response){
                if ($response.success="success") {
                    swal({
                        title: $response.message,
                        text: "Success",
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        closeOnEsc: false,
                        allowOutsideClick:false,
                        cancelButtonColor: '#d33',
                        button: 'Ok',
                        timer: 1000
                    });
                    setTimeout(function(){
                        location.reload()
                    },1000)
                }
             }
        });
    })
})



$('[data-target="#createCharter"]').on('click',function(){
    $('#createCharter .modal-title').html('Create New Charter...')
})
$('[data-target="#createCharter"]').on('click',function(){
    $('#createCharter .modal-title').html('Create New Aircraft...')
})
$('[data-target="#createUser"]').on('click',function(){
    $('#createUser .modal-title').html('Create New User...')
    var modal = $('#createUser')
    modal.find('input').each(function(index){
        let name = $(this).attr('name')
        let type = $(this).attr('type')
        if (name !== 'ajax-request' && type !== 'hidden') {
            $(this).val('');
        }
    })
})


/**
 * Icons
 */

var iconClass = ['la-500px', 'la-adjust', 'la-adn', 'la-align-center', 'la-align-justify',
'la-align-left', 'la-align-right', 'la-amazon', 'la-ambulance', 'la-anchor', 'la-android', 'la-angellist', 'la-angle-double-down', 'la-angle-double-left', 'la-angle-double-right', 'la-angle-double-up', 'la-angle-down', 'la-angle-left', 'la-angle-right', 'la-angle-up', 'la-apple', 'la-archive', 'la-area-chart', ' la-arrow-circle-down', 'la-arrow-circle-left', 'la-arrow-circle-o-down', 'la-arrow-circle-o-left', 'la-arrow-circle-o-right', 'la-arrow-circle-o-up', 'la-arrow-circle-right', 'la-arrow-circle-up', 'la-arrow-down', 'la-arrow-left', 'la-arrow-right', 'la-arrow-up', 'la-arrows', 'la-arrows-alt', 'la-arrows-h', 'la-arrows-v', 'la-asterisk', 'la-at', 'la-automobile', 'la-backward', 'la-balance-scale', 'la-ban', 'la-bank', 'la-bar-chart', 'la-bar-chart-o', 'la-barcode', 'la-bars', 'la-battery-0', 'la-battery-1', 'la-battery-2', 'la-battery-3', 'la-battery-4', 'la-battery-empty', 'la-battery-full', 'la-battery-half', 'la-battery-quarter', 'la-battery-three-quarters', 'la-bed', 'la-beer', 'la-behance', 'la-behance-square', 'la-bell', 'la-bell-o', 'la-bell-slash', 'la-bell-slash-o', 'la-bicycle', 'la-binoculars', 'la-birthday-cake', 'la-bitbucket', 'la-bitbucket-square', 'la-bitcoin', 'la-black-tie', 'la-bold', 'la-bolt', 'la-bomb', 'la-book', 'la-bookmark', 'la-bookmark-o', 'la-briefcase', 'la-btc', 'la-bug', 'la-building', 'la-building-o', 'la-bullhorn', 'la-bullseye', 'la-bus', 'la-buysellads', 'la-cab', 'la-calculator', 'la-calendar', 'la-calendar-check-o', 'la-calendar-minus-o', 'la-calendar-o', 'la-calendar-plus-o', 'la-calendar-times-o', 'la-camera', 'la-camera-retro', 'la-car', 'la-caret-down', 'la-caret-left', 'la-caret-right', 'la-caret-square-o-down', 'la-toggle-down', 'la-caret-square-o-left', 'la-toggle-left', 'la-caret-square-o-right', 'la-toggle-right', 'la-caret-square-o-up', 'la-toggle-up', 'la-caret-up', 'la-cart-arrow-down', 'la-cart-plus', 'la-cc', 'la-cc-amex', 'la-cc-diners-club', 'la-cc-discover', 'la-cc-jcb', 'la-cc-mastercard', 'la-cc-paypal', 'la-cc-stripe', 'la-cc-visa', 'la-certificate', 'la-chain', 'la-chain-broken', 'la-check', 'la-check-circle', 'la-check-circle-o', 'la-check-square', 'la-check-square-o', 'la-chevron-circle-down', 'la-chevron-circle-left', 'la-chevron-circle-right', 'la-chevron-circle-up', 'la-chevron-down', 'la-chevron-left', 'la-chevron-right', 'la-chevron-up', 'la-child', 'la-chrome', 'la-circle', 'la-circle-o', 'la-circle-o-notch', 'la-circle-thin', 'la-clipboard', 'la-clock-o', 'la-clone', 'la-close', 'la-cloud', 'la-cloud-download', 'la-cloud-upload', 'la-cny', 'la-code', 'la-code-fork', 'la-codepen', 'la-coffee', 'la-cog', 'la-cogs', 'la-columns', 'la-comment', 'la-comment-o', 'la-commenting', 'la-commenting-o', 'la-comments', 'la-comments-o', 'la-compass', 'la-compress', 'la-connectdevelop', 'la-contao', 'la-copy', 'la-copyright', 'la-creative-commons', 'la-credit-card', 'la-crop', 'la-crosshairs', 'la-css3', 'la-cube', 'la-cubes', 'la-cut', 'la-cutlery', 'la-dashboard', 'la-dashcube', 'la-database', 'la-dedent', 'la-delicious', 'la-desktop', 'la-deviantart', 'la-diamond', 'la-digg', 'la-dollar', 'la-dot-circle-o', 'la-download', 'la-dribbble', 'la-dropbox', 'la-drupal', 'la-edit', 'la-eject', 'la-ellipsis-h', 'la-ellipsis-v', 'la-empire', 'la-ge', 'la-envelope', 'la-envelope-o', 'la-envelope-square', 'la-eraser', 'la-eur', 'la-euro', 'la-exchange', 'la-exclamation', 'la-exclamation-circle', 'la-exclamation-triangle', 'la-expand', 'la-expeditedssl', 'la-external-link', 'la-external-link-square', 'la-eye', 'la-eye-slash', 'la-eyedropper', 'la-facebook', 'la-facebook-f', 'la-facebook-official', 'la-facebook-square', 'la-fast-backward', 'la-fast-forward', 'la-fax', 'la-female', 'la-fighter-jet', 'la-file', 'la-file-archive-o', 'la-file-audio-o', 'la-file-code-o', 'la-file-excel-o', 'la-file-image-o', 'la-file-movie-o', 'la-file-o', 'la-file-pdf-o', 'la-file-photo-o', 'la-file-picture-o', 'la-file-powerpoint-o', 'la-file-sound-o', 'la-file-text', 'la-file-text-o', 'la-file-video-o', 'la-file-word-o', 'la-file-zip-o', 'la-files-o', 'la-film', 'la-filter', 'la-fire', 'la-fire-extinguisher', 'la-firefox', 'la-flag', 'la-flag-checkered', 'la-flag-o', 'la-flash', 'la-flask', 'la-flickr', 'la-floppy-o', 'la-folder', 'la-folder-o', 'la-folder-open', 'la-folder-open-o', 'la-font', 'la-fonticons', 'la-forumbee', 'la-forward', 'la-foursquare', 'la-frown-o', 'la-futbol-o', 'la-soccer-ball-o', 'la-gamepad', 'la-gavel', 'la-gbp', 'la-gear', 'la-gears', 'la-genderless', 'la-get-pocket', 'la-gg', 'la-gg-circle', 'la-gift', 'la-git', 'la-git-square', 'la-github', 'la-github-alt', 'la-github-square', 'la-glass', 'la-globe', 'la-google', 'la-google-plus', 'la-google-plus-square', 'la-google-wallet', 'la-graduation-cap', 'la-gratipay', 'la-gittip', 'la-group', 'la-h-square', 'la-hacker-news', 'la-hand-grab-o', 'la-hand-lizard-o', 'la-hand-o-down', 'la-hand-o-left', 'la-hand-o-right', 'la-hand-o-up', 'la-hand-paper-o', 'la-hand-peace-o', 'la-hand-pointer-o', 'la-hand-rock-o', 'la-hand-scissors-o', 'la-hand-spock-o', 'la-hand-stop-o', 'la-hdd-o', 'la-header', 'la-headphones', 'la-heart', 'la-heart-o', 'la-heartbeat', 'la-history', 'la-home', 'la-hospital-o', 'la-hotel', 'la-hourglass', 'la-hourglass-1', 'la-hourglass-2', 'la-hourglass-3', 'la-hourglass-end', 'la-hourglass-half', 'la-hourglass-o', 'la-hourglass-start', 'la-houzz', 'la-html5', 'la-i-cursor', 'la-ils', 'la-image', 'la-inbox', 'la-indent', 'la-industry', 'la-info', 'la-info-circle', 'la-inr', 'la-instagram', 'la-institution', 'la-internet-explorer', 'la-ioxhost', 'la-italic', 'la-joomla', 'la-jpy', 'la-jsfiddle', 'la-key', 'la-keyboard-o', 'la-krw', 'la-language', 'la-laptop', 'la-lastfm', 'la-lastfm-square', 'la-leaf', 'la-leanpub', 'la-legal', 'la-lemon-o', 'la-level-down', 'la-level-up', 'la-life-bouy', 'la-life-buoy', 'la-life-ring', 'la-support', 'la-life-saver', 'la-lightbulb-o', 'la-line-chart', 'la-link', 'la-linkedin', 'la-linkedin-square', 'la-linux', 'la-list', 'la-list-alt', 'la-list-ol', 'la-list-ul', 'la-location-arrow', 'la-lock', 'la-long-arrow-down', 'la-long-arrow-left', 'la-long-arrow-right', 'la-long-arrow-up', 'la-magic', 'la-magnet', 'la-mail-forward', 'la-mail-reply', 'la-mail-reply-all', 'la-male', 'la-map', 'la-map-marker', 'la-map-o', 'la-map-pin', 'la-map-signs', 'la-mars', 'la-mars-stroke-v', 'la-maxcdn', 'la-meanpath', 'la-medium', 'la-medkit', 'la-meh-o', 'la-mercury', 'la-microphone', 'la-microphone-slash', 'la-minus', 'la-minus-circle', 'la-minus-square', 'la-minus-square-o', 'la-mobile', 'la-mobile-phone', 'la-money', 'la-moon-o', 'la-mortar-board', 'la-motorcycle', 'la-mouse-pointer', 'la-music', 'la-navicon', 'la-neuter', 'la-newspaper-o', 'la-object-group', 'la-object-ungroup', 'la-odnoklassniki', 'la-odnoklassniki-square', 'la-opencart', 'la-openid', 'la-opera', 'la-optin-monster', 'la-outdent', 'la-pagelines', 'la-paint-brush', 'la-paper-plane', 'la-send', 'la-paper-plane-o', 'la-send-o', 'la-paperclip', 'la-paragraph', 'la-paste', 'la-pause', 'la-paw', 'la-paypal', 'la-pencil', 'la-pencil-square', 'la-pencil-square-o', 'la-phone', 'la-phone-square', 'la-photo', 'la-picture-o', 'la-pie-chart', 'la-pied-piper', 'la-pied-piper-alt', 'la-pinterest', 'la-pinterest-p', 'la-pinterest-square', 'la-plane', 'la-play', 'la-play-circle', 'la-play-circle-o', 'la-plug', 'la-plus', 'la-plus-circle', 'la-plus-square', 'la-plus-square-o', 'la-power-off', 'la-print', 'la-puzzle-piece', 'la-qq', 'la-qrcode', 'la-question', 'la-question-circle', 'la-quote-left', 'la-quote-right', 'la-ra', 'la-random', 'la-rebel', 'la-recycle', 'la-reddit', 'la-reddit-square', 'la-refresh', 'la-registered', 'la-renren', 'la-reorder', 'la-repeat', 'la-reply', 'la-reply-all', 'la-retweet', 'la-rmb', 'la-road', 'la-rocket', 'la-rotate-left', 'la-rotate-right', 'la-rouble', 'la-rss', 'la-feed', 'la-rss-square', 'la-rub', 'la-ruble', 'la-rupee', 'la-safari', 'la-save', 'la-scissors', 'la-search', 'la-search-minus', 'la-search-plus', 'la-sellsy', 'la-server', 'la-share', 'la-share-alt', 'la-share-alt-square', 'la-share-square', 'la-share-square-o', 'la-shekel', 'la-sheqel', 'la-shield', 'la-ship', 'la-shirtsinbulk', 'la-shopping-cart', 'la-sign-in', 'la-sign-out', 'la-signal', 'la-simplybuilt', 'la-sitemap', 'la-skyatlas', 'la-skype', 'la-slack', 'la-sliders', 'la-slideshare', 'la-smile-o', 'la-sort', 'la-unsorted', 'la-sort-alpha-asc', 'la-sort-alpha-desc', 'la-sort-amount-asc', 'la-sort-amount-desc', 'la-sort-asc', 'la-sort-up', 'la-sort-desc', 'la-sort-down', 'la-sort-numeric-asc', 'la-sort-numeric-desc', 'la-soundcloud', 'la-space-shuttle', 'la-spinner', 'la-spoon', 'la-spotify', 'la-square', 'la-square-o', 'la-stack-exchange', 'la-stack-overflow', 'la-star', 'la-star-half', 'la-star-half-o', 'la-star-half-full', 'la-star-half-empty', 'la-star-o', 'la-steam', 'la-steam-square', 'la-step-backward', 'la-step-forward', 'la-stethoscope', 'la-sticky-note', 'la-sticky-note-o', 'la-stop', 'la-street-view', 'la-strikethrough', 'la-stumbleupon', 'la-stumbleupon-circle', 'la-subscript', 'la-subway', 'la-suitcase', 'la-sun-o', 'la-superscript', 'la-table', 'la-tablet', 'la-tachometer', 'la-tag', 'la-tags', 'la-tasks', 'la-taxi', 'la-television', 'la-tv', 'la-tencent-weibo', 'la-terminal', 'la-text-height', 'la-text-width', 'la-th', 'la-th-large', 'la-th-list', 'la-thumb-tack', 'la-thumbs-down', 'la-thumbs-o-down', 'la-thumbs-o-up', 'la-thumbs-up', 'la-ticket', 'la-times', 'la-remove', 'la-times-circle', 'la-times-circle-o', 'la-tint', 'la-toggle-off', 'la-toggle-on', 'la-trademark', 'la-train', 'la-trash', 'la-trash-o', 'la-tree', 'la-trello', 'la-tripadvisor', 'la-trophy', 'la-truck', 'la-try', 'la-tty', 'la-tumblr', 'la-tumblr-square', 'la-turkish-lira', 'la-twitch', 'la-twitter', 'la-twitter-square', 'la-umbrella', 'la-underline', 'la-undo', 'la-university', 'la-unlink', 'la-unlock', 'la-unlock-alt', 'la-upload', 'la-usd', 'la-user', 'la-user-md', 'la-user-plus', 'la-user-secret', 'la-user-times', 'la-users', 'la-venus', 'la-venus-double', 'la-venus-mars', 'la-viacoin', 'la-video-camera', 'la-vimeo', 'la-vimeo-square la-vine la-vk la-volume-down la-volume-off la-volume-up la-warning la-wechat', 'la-weibo', 'la-weixin', 'la-whatsapp', 'la-wheelchair', 'la-wifi', 'la-wikipedia-w', 'la-windows', 'la-won', 'la-wordpress', 'la-wrench', 'la-xing', 'la-xing-square', 'la-y-combinator', 'la-y-combinator-square', 'la-yahoo', 'la-yc', 'la-yc-square', 'la-yelp', 'la-yen', 'la-youtube', 'la-youtube-play', 'la-youtube-square'
]; var rowDemoIcon = "#row-demo-icon";
for (i = 0; i < iconClass.length; i++){
	$(rowDemoIcon).append('<div class="col-md-3"> <div class="demo-icon"> <div class="icon-preview"><i class="la ' + iconClass[i] + '"></i></div> <div class="icon-class">la ' + iconClass[i] + '</div> </div> </div>');
}

/**
 * Ajax Calls
 */
    $(document).on('click','[data-request="ajax-submit"]',function(){
    /*REMOVING PREVIOUS ALERT AND ERROR CLASS*/
    // $('.popup').show();  $('.alert').remove(); $(".has-error").removeClass('has-error'); $('.help-block').remove();

    var $this           = $(this);
    var $target         = $this.data('target');
    var $url            = $($target).attr('action');
    var $method         = $($target).attr('method');
    var $show_error     = $this.data('show_error');
    $modal              = $this.data('modal');
    $data               = new FormData($($target)[0]);
    // var access_token    = $('#access_token').val();
    $($show_error).html('');
    if(!$method){ $method = 'get'; }
    $.ajax({
         // url: $url + '?access_token=' + access_token, 
        url: $url, 
        data: $data,
        cache: false, 
        type: $method, 
        dataType: 'json',
        contentType: false, 
        processData: false,
        success: function($response){
            if($response.error_key == '406'){
             check_login_status($response);
            }else{
             if ($response.status == 'success'){
                 if($response.ajax_request){
                     $.ajax({
                         url: $response.ajax_request + '?access_token=' + access_token,
                         data: $data,
                         cache: false, 
                         type: $method, 
                         dataType: 'json',
                         contentType: false, 
                         processData: false,                         
                         success : function($newresponse){
                             if($newresponse.status == 'SUCCESS'){
                                 if($newresponse.modal){
                                     $($modal).trigger('click');
                                 }
                             }else{
                                 if($newresponse.message.length > 0){
                                     if($show_error){
                                         $($show_error).html($newresponse.message).css('color','red');
                                     }
                                 }
                                 $('.popup').hide();
                             }
                         }
                     })
                 }

                 if($response.modal){
                     $($modal).trigger('click');
                 }

                 if($response.redirect){
                     if($response.swal == false){
                         if($response.message.length > 0){
                             if($show_error){
                                 $($show_error).html($response.message).css('color','green');
                             }
                         }
                     }else{
                         $('.popup').hide();
                         swal({
                             title: $response.message,
                             type: 'success',
                             showCancelButton: false,
                             closeOnEsc: false,
                             allowOutsideClick:false,
                             confirmButtonColor: '#3085d6',
                             button: 'Ok',
                             showConfirmButton: typeof $response.showconfirmButton !== 'undefined' ? false : true,
                         }).then(function (result) {
                                 if (result) {
                                     if (result === true) {
                                         window.location.href = $response.redirect;
                                     }
                                 }
                             })
                     }
                 }
                 
                 if($response.saved=="true"){
                     swal({
                         title: $response.message,
                         text: "Success",
                         type: 'success',
                         showCancelButton: false,
                         confirmButtonColor: '#3085d6',
                         closeOnEsc: false,
                         allowOutsideClick:false,
                         cancelButtonColor: '#d33',
                         button: 'Ok',
                         timer: 1000
                     });
                 }

                 if($response.redirect){
                     setTimeout(function(){window.location = $response.redirect;},1500)
                     $('.popup').hide();
                 }
                 if ($response.reload){
                 	setTimeout(function(){
                 			location.reload()
                 		},1000)
                 }
             }else{
                console.log($response);
                if ($response.errors) {
                    swal({
                        title: 'Empty Fields...',
                        text: "Please fill all the fields.",
                        icon: 'warning',
                        button: 'Ok'
                    })
                }
               /* if($response.swal == false){
                 if($response.message.length > 0){
                     if($show_error){
                         $($show_error).html($response.message).css('color','red');
                     }
                 }
                }else{
                 $('.popup').hide();

                 swal({
                     title: $response.message,
                     text: "",
                     icon: 'warning',
                     button: 'Ok'
                 }).then(function (result) {                        
                         if (result) {
                         }
                     })
                 }
                $('.popup').hide();*/
             }
             // $('.popup').hide();
             if ($response.messages) {
                var messages  = strip_html_tags($response.messages);
                swal({
                    title: 'Please correct the following errors.',
                    text: messages,
                    icon: 'warning',
                    button: 'Ok'
                })
             }
            }
         }
     }); 
 });

$('body').on('change','#return',function(){
    $('#return_info').slideToggle()
})
$( ".hasDatepicker" ).datepicker({
    inline: true
});
function logOut(el){
    $url = $(el).data('url')
    console.log($url)
    $.ajax({
        url: $url, 
        dataType: 'json',
        success: function(response){
            if (response.status == 'success') {
                window.location.assign(response.location)
            }else{

            }
        }
    });
}
if (typeof $notify != 'undefined') {
    $.notify({
        icon: 'la la-bell',
        title: $notify_obj.notify_title,
        message: $notify_obj.notify_message,
    },{
        type: $notify_obj.notify_type,
        placement: $notify_obj.notify_placement,
        time: $notify_obj.time,
    });
}