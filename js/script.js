//All scripts in spite of third-part plug-ins
$(document).ready(function () {
    // initialising every page
    $('input[name=URL]').hide();
    var newURL = window.location.href;
    var hash = window.location.hash;
    var returnURL = newURL.replace(hash, '');
    returnURL = returnURL.replace('#', '');
    $('input[name=URL]').attr('value', returnURL);

    // initialising index.php page
    $('.user a').click(function () {
        var inst = $('[data-remodal-id=LogInModal]').remodal();
        inst.open();
    });

    $('#timeline img').click(function () {
        var inst = $('[data-remodal-id=EditModal]').remodal();
        var editimgid = $(this).attr('id');
        $('input[name=editimgid]').attr('value', editimgid);
        inst.open();
    });
    $('form[id=edit] button[name=view]').click(function (event) {
        event.preventDefault();
        var showURL_fromedit = "/show.php?id=" + $('input[name=editimgid]').val();
        window.location.href = showURL_fromedit;
    });

    $('#popular img').click(function () {
        var inst = $('[data-remodal-id=VoteModal]').remodal();
        var voteimgid = $(this).attr('id');
        $('input[name=voteimgid]').attr('value', voteimgid);
        inst.open();
    });

    $('form[id=vote] button[name=view]').click(function (event) {
        event.preventDefault();
        var showURL_fromvote = "/show.php?id=" + $('input[name=voteimgid]').val();
        window.location.href = showURL_fromvote;
    });

    // initialising show.php page
    $('#show img').click(function () {
        var inst = $('[data-remodal-id=VoteModal]').remodal();
        var voteimgid = $(this).attr('id');
        $('input[name=voteimgid]').attr('value', voteimgid);
        inst.open();
    });

    // initialising share.php page
    $('#results img').click(function () {
        var inst = $('[data-remodal-id=EditModal]').remodal();
        inst.open();
    });

    $('.share').click(function () {
        var inst = $('[data-remodal-id=ShareModal]').remodal();
        inst.open();
    });

    $('.save').click(function () {
        var inst = $('[data-remodal-id=SaveModal]').remodal();
        inst.open();
    });

    // initialising confirm.php page
    $('input[name=towhom_check]').hide();
    $('input[name=fromwhom_check]').hide();
    $('textarea[name=greeting_check]').hide();
    $('textarea[name=frontimgdata]').hide();
    $('textarea[name=backimgdata]').hide();

    // initialising design.php page
    showStep2(); // initialization
    $('input[name=firstimg]').hide();
    $('input[name=secondimg]').hide();
    $('input[name=address]').hide();
    $('input[name=fronturl]').hide();
    $('input[name=backurl]').hide();
    $('input[name=voteimgid]').hide();
    $('input[name=editimgid]').hide();
    $('#finishrender').hide();
    $('button[name="confirm"]').hide();

    // Set navigation style and check whether the user has chosen location before going to another step.
    $('#navigation ul li:eq(0)').css('font-weight', '500');

    $('#navigation ul li:eq(0)').click(function () {
        $('#navigation ul li:eq(0)').css('font-weight', '500');
        $('#navigation ul li:eq(1)').css('font-weight', '300');
        $('#navigation ul li:eq(2)').css('font-weight', '300');
        $('#navigation ul li:eq(3)').css('font-weight', '300');
        $('.inProgress').css('width', '25%');
        showStep2();
    });

    $('#navigation ul li:eq(1)').click(function () {
        if ($('input[name=address]').val() != 'Australia') {
            $('#navigation ul li:eq(0)').css('font-weight', '300');
            $('#navigation ul li:eq(1)').css('font-weight', '500');
            $('#navigation ul li:eq(2)').css('font-weight', '300');
            $('#navigation ul li:eq(3)').css('font-weight', '300');
            $('.inProgress').css('width', '50%');
            showStep3();
        } else {
            alert('Please choose your location first.');
        }
    });

    $('#navigation ul li:eq(2)').click(function () {
        if ($('input[name=address]').val() == 'Australia') {
            alert('Please choose your location first.');
        } else if ($('input[name=firstimg]').val() == '') {
            alert('Please choose an image for the front side of your postcard.');
        } else {
            $('#navigation ul li:eq(0)').css('font-weight', '300');
            $('#navigation ul li:eq(1)').css('font-weight', '300');
            $('#navigation ul li:eq(2)').css('font-weight', '500');
            $('#navigation ul li:eq(3)').css('font-weight', '300');
            $('.inProgress').css('width', '75%');
            showStep4();
        }
    });

    $('#navigation ul li:eq(3)').click(function () {
        if ($('input[name=address]').val() == 'Australia') {
            alert('Please choose your location first.');
        } else if ($('input[name=firstimg]').val() == '') {
            alert('Please choose an image for the front side of your postcard.');
        } else if ($('input[name=secondimg]').val() == '') {
            alert('Please choose an image for the stamp on the back side of your postcard.');
        } else {
            $('#navigation ul li:eq(0)').css('font-weight', '300');
            $('#navigation ul li:eq(1)').css('font-weight', '300');
            $('#navigation ul li:eq(2)').css('font-weight', '300');
            $('#navigation ul li:eq(3)').css('font-weight', '500');
            $('.inProgress').css('width', '100%');
            showStep6();
        }
    });

    // get images from Trove based on the geo-location
    $('#step2Content').find('.button').click(function () {
        if ($('input[name=address]').val() != 'Australia') {
            loadedImages = [];
            found = 0;
            //get input values
            //        var searchTerm = $('#step2Instruction>h1').val().trim();
            //        searchTerm = searchTerm.replace(/ /g, "%20");
            //        var searchTerm = 'st.lucia';
            //        var searchTerm = currentLocation;
            var searchTerm = $('input[name=address]').val();
            //        var sortBy = $("#sortBy").val();
            var sortBy = 'datedesc';
            var apiKey = "kr6iv720kob8nph6";

            //create searh query
            var url = "http://api.trove.nla.gov.au/result?key=" + apiKey + "&l-availability=y%2Ff&encoding=json&zone=picture&sortby=" + sortBy + "&n=100&q=" + searchTerm + "&callback=?";


            //get the JSON information we need to display the images
            $.getJSON(url, function (data) {
                $('#mainPicture').empty();
                $.each(data.response.zone[0].records.work, processImages);
                //printImages();

                waitForFlickr(); // Waits for the flickr images to load
            });

            $('.inProgress').css('width', '50%');
            $('#notification p').html('You are at Step2/4');
            $('#navigation ul li:eq(0)').css('font-weight', '300');
            $('#navigation ul li:eq(1)').css('font-weight', '500');
            $('#navigation ul li:eq(2)').css('font-weight', '300');
            $('#navigation ul li:eq(3)').css('font-weight', '300');

            $('#locationP').text($('input[name="address"]').val());
            showStep3();
        } else {
            alert('Please choose your location first.');
        }
    });
    $('#step2Content').find('.alternativeOption').click(function () {
        $('#step2Content').hide();
        $('#step2Branch').show();
    });

    // get images from Trove based on the geo-location
    $('#step2Branch').find('.button').click(function () {
        loadedImages = [];
        found = 0;
        var searchTerm = $('input[name=address]').val();
        //        var sortBy = $("#sortBy").val();
        var sortBy = 'datedesc';
        var apiKey = "kr6iv720kob8nph6";

        //create searh query
        var url = "http://api.trove.nla.gov.au/result?key=" + apiKey + "&l-availability=y%2Ff&encoding=json&zone=picture&sortby=" + sortBy + "&n=100&q=" + searchTerm + "&callback=?";


        //get the JSON information we need to display the images
        $.getJSON(url, function (data) {
            $('#mainPicture').empty();
            $.each(data.response.zone[0].records.work, processImages);
            //printImages();

            waitForFlickr(); // Waits for the flickr images to load
        });



        $('#locationP').text($('input[name="address"]').val());

        if ($('input[name=address]').val() == 'Australia') {
            alert('Please choose your location first.');
        } else {
            $('.inProgress').css('width', '50%');
            $('#notification p').html('You are at Step2/4');
            $('#navigation ul li:eq(0)').css('font-weight', '300');
            $('#navigation ul li:eq(1)').css('font-weight', '500');
            $('#navigation ul li:eq(2)').css('font-weight', '300');
            $('#navigation ul li:eq(3)').css('font-weight', '300');
            showStep3();
        }
    });

    // choose image for the front side of the image and
    // get thumbnail images from Trove for the stamp based on the geo-location
    $('#step3Content').find('.button').click(function () {
        loadedImages = [];
        found = 0;
        //get input values
        //        var searchTerm = $('#step2Instruction>h1').val().trim();
        //        searchTerm = searchTerm.replace(/ /g, "%20");
        //        var searchTerm = 'st.lucia';
        var searchTerm = currentLocation;
        //        var sortBy = $("#sortBy").val();
        var sortBy = 'dateasc';
        var apiKey = "kr6iv720kob8nph6";

        //create searh query
        var url = "http://api.trove.nla.gov.au/result?key=" + apiKey + "&l-availability=y%2Ff&encoding=json&zone=picture&sortby=" + sortBy + "&n=100&q=" + searchTerm + "&callback=?";


        //get the JSON information we need to display the images
        $.getJSON(url, function (data) {
            $('#stamps').empty();
            $.each(data.response.zone[0].records.work, processSmallImages);
            //printImages();

            waitForFlickrSmall(); // Waits for the flickr images to load
        });
        $('input[name=firstimg]').attr('value', selected_front_image)
        $('#img1P').attr('src', selected_front_image);

        if ($('input[name=firstimg]').val() == '') {
            alert('Please choose an image for the front side of your postcard.');

        } else {
            $('.inProgress').css('width', '75%');
            $('#notification p').html('You are at Step3/4');
            $('#navigation ul li:eq(0)').css('font-weight', '300');
            $('#navigation ul li:eq(1)').css('font-weight', '300');
            $('#navigation ul li:eq(2)').css('font-weight', '500');
            $('#navigation ul li:eq(3)').css('font-weight', '300');
            showStep4();
        }
    });

    // choose image for the stamp
    $('#step4Content').find('.button').click(function () {

        $('input[name=secondimg]').attr('value', selected_back_image)
        $('#img2P').attr('src', selected_back_image);

        if ($('input[name=secondimg]').val() == '') {
            alert('Please choose an image for the stamp on the back side of your postcard.');
        } else {
            $('.inProgress').css('width', '100%');
            $('#notification p').html('You are at Step4/4');
            $('#navigation ul li:eq(0)').css('font-weight', '300');
            $('#navigation ul li:eq(1)').css('font-weight', '300');
            $('#navigation ul li:eq(2)').css('font-weight', '300');
            $('#navigation ul li:eq(3)').css('font-weight', '500');
            showStep6();
        }
    });

    // submit all the elements to php
    $('#step6Content').find('.button').click(function (event) {
        event.preventDefault();
        if ($('input[name=fromwhom]').val() == '' || $('input[name=towhom]').val() == '' || $('input[name=greeting]').val() == '') {
            alert('Please check the form is completed.')
        } else {
            $('form[id=greetings]').submit();
        }
    });

    // Call merge() function
    $('#prerender').click(function (event) {
        event.preventDefault();
        merge();
        $(this).hide();
        $('#finishrender').slideUp(300).delay(800).fadeIn(400);
    });

    // call to_image() function to finalize drawing the postcard
    $('#finishrender').click(function (event) {
        event.preventDefault();
        to_image();
        $(this).hide();
        $('button[name="confirm"]').show();
    });

    // Add style to the selected picture
    var selected_front_image;
    var selected_back_image;
    $(document).on("mousedown", "#mainPicture img", function () {
        $(this).addClass('selected').siblings().removeClass('selected');
        selected_front_image = $(this).attr("src");
    });

    $(document).on("mousedown", "#stamps img", function () {
        $(this).addClass('selected').siblings().removeClass('selected');
        selected_back_image = $(this).attr("src");
    });

    // Add toggle contents of different steps
    function showStep2() {
        $('#step1Instruction').hide();
        $('#step1Content').hide();
        $('#step2Instruction').show();
        $('#step2Content').show();
        $('#step2Branch').hide();
        $('#step3Instruction').hide();
        $('#step3Content').hide();
        $('#step4Instruction').hide();
        $('#step4Content').hide();
        $('#step5Instruction').hide();
        $('#step5Content').hide();
        $('#step6Instruction').hide();
        $('#step6Content').hide();
    }

    function showStep3() {
        $('#step2Instruction').hide();
        $('#step2Content').hide();
        $('#step2Branch').hide();
        $('#step3Instruction').show();
        $('#step3Content').show();
        $('#step4Instruction').hide();
        $('#step4Content').hide();
        $('#step6Instruction').hide();
        $('#step6Content').hide();

    }

    function showStep4() {
        $('#step2Instruction').hide();
        $('#step2Content').hide();
        $('#step2Branch').hide();
        $('#step3Instruction').hide();
        $('#step3Content').hide();
        $('#step4Instruction').show();
        $('#step4Content').show();
        $('#step6Instruction').hide();
        $('#step6Content').hide();
    }

    function showStep6() {
        $('#step2Instruction').hide();
        $('#step2Content').hide();
        $('#step2Branch').hide();
        $('#step3Instruction').hide();
        $('#step3Content').hide();
        $('#step4Instruction').hide();
        $('#step4Content').hide();
        $('#step6Instruction').show();
        $('#step6Content').show();
    }


    // The following fuction is based on Image&Trove example on the course webstie 
    // http://deco1800.uqcloud.net/examples/troveImage.php
    // Changes have been made for myca's usage. 
    // For example, thumbnails are got for the stamp, and original pictures are for the picture on the front side
    var loadedImages = [];
    var urlPatterns = ["flickr.com", "nla.gov.au", "artsearch.nga.gov.au", "recordsearch.naa.gov.au", "images.slsa.sa.gov.au"];
    var found = 0;

    function waitForFlickr() {
        if (found == loadedImages.length) {
            printImages();
        } else {
            setTimeout(waitForFlickr, 250);
        }
    }

    function waitForFlickrSmall() {
        if (found == loadedImages.length) {
            printImagesSmall();
        } else {
            setTimeout(waitForFlickr, 250);
        }
    }

    function processImages(index, troveItem) {

        var imgUrl = troveItem.identifier[0].value;

        if (imgUrl.indexOf(urlPatterns[0]) >= 0) { // flickr

            found++;
            //            var flickr_imgUrl_small = troveItem.identifier[1].value.replace('_t.jpg', '_z.jpg');

            addFlickrItem(imgUrl, troveItem);

        } else if (imgUrl.indexOf(urlPatterns[1]) >= 0) { // nla.gov

            found++;
            loadedImages.push(
                imgUrl + "/representativeImage?wid=280" // change ?wid=900 to scale the image
            );

        } else if (imgUrl.indexOf(urlPatterns[2]) >= 0) { //artsearch

            found++;
            loadedImages.push(
                "http://artsearch.nga.gov.au/IMAGES/LRG/" + getQueryVariable("IRN", imgUrl) + ".jpg"
            );

        } else if (imgUrl.indexOf(urlPatterns[3]) >= 0) { //recordsearch

            found++;
            loadedImages.push(
                "http://recordsearch.naa.gov.au/NAAMedia/ShowImage.asp?T=P&S=1&B=" + getQueryVariable("Number", imgUrl)
            );

        } else if (imgUrl.indexOf(urlPatterns[4]) >= 0) { //slsa

            found++;
            loadedImages.push(
                imgUrl.slice(0, imgUrl.length - 3) + "jpg"
            );

        } else {

        }
    }

    function processSmallImages(index, troveItem) {
        if (troveItem.identifier.length > 1) {
            var imgUrl = troveItem.identifier[1].value;

            if (typeof (imgUrl) != 'undefined' && imgUrl.indexOf('.jpg') >= 0) {
                found++;
                loadedImages.push(imgUrl);
            }
        }
    }

    function addFlickrItem(imgUrl, troveItem) {
        var flickr_key = "185416d482b80527f23783028dfc4386";
        var flickr_secret = "c7e843e8ee70e1d8";

        var flickr_url = "https://api.flickr.com/services/rest/?method=flickr.photos.getSizes&api_key=" + flickr_key + "&photo_id=";

        var url_comps = imgUrl.split("/");
        var photo_id = url_comps[url_comps.length - 1];

        $.getJSON(flickr_url + photo_id + "&format=json&nojsoncallback=1", function (data) {
            if (data.stat == "ok") {
                var flickr_image_url = data.sizes.size[data.sizes.size.length - 1].source;
                //                flickr_image_url = flickr_image_url.replace("_o.jpg", "_z.jpg");
                loadedImages.push(
                    flickr_image_url
                );
            }
        });
    }

    function printImages() {
        for (var i in loadedImages) {
            var image = new Image();
            image.src = loadedImages[i];
            image.classList.add("swiper-slide");
            //            image.style.display = "inline-block ";
            //            image.style.maxWidth = "280px";
            //            image.style.maxHeight = "188px";
            //            image.style.margin = "30px";
            //            image.style.verticalAlign = "bottom";


            //            var image_html = '<div class="swiper-slide"><img scr="' + image.src + '" /></div>';
            //            var image_html_2 = '<div class="swiper-slide">' + image + '</div>';

            //            $('.swiper-slide').append(image);

            $("#mainPicture").append(image);
            //            $("#mainPicture").append(image_html);


        }

        var swiper2 = new Swiper('.large-group', {
            pagination: $('#step3Content').find(".swiper-pagination")[0],
            slidesPerView: 'auto',
            centeredSlides: true,
            paginationClickable: true,
            draggable: true,
            spaceBetween: 30,
            loop: false,
            // Navigation arrows
            // nextButton: '.swiper-button-next', // prevButton: '.swiper-button-prev',
            nextButton: $('#step3Content').find(".swiper-button-next")[0],
            prevButton: $('#step3Content').find(".swiper-button-prev")[0]
        })
    }

    function printImagesSmall() {
        for (var i in loadedImages) {
            var image = new Image();
            image.src = loadedImages[i];
            image.classList.add("swiper-slide");
            //            image.style.display = "inline-block ";
            //            image.style.maxWidth = "280px";
            //            image.style.maxHeight = "188px";
            //            image.style.margin = "30px";
            //            image.style.verticalAlign = "bottom";


            //            var image_html = '<div class="swiper-slide"><img scr="' + image.src + '" /></div>';
            //            var image_html_2 = '<div class="swiper-slide">' + image + '</div>';

            //            $('.swiper-slide').append(image);

            $("#stamps").append(image);
            //            $("#mainPicture").append(image_html);


        }


        var swiper1 = new Swiper('.small-group', {
            slidesPerView: 4,
            slidesPerColumn: 3,
            centeredSlides: true,
            spaceBetween: 10,
            loop: false,
            // Navigation arrows
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev'
        })
    }

    // Charater Count plugin for the form in design.php to count down the characters in the greeting textarea
    /*
     * 	Character Count Plugin - jQuery plugin
     * 	Dynamic character count for text areas and input fields
     *	written by Alen Grakalic	
     *	http://cssglobe.com/post/7161/jquery-plugin-simplest-twitterlike-dynamic-character-count-for-textareas
     *
     *	Copyright (c) 2009 Alen Grakalic (http://cssglobe.com)
     *	Dual licensed under the MIT (MIT-LICENSE.txt)
     *	and GPL (GPL-LICENSE.txt) licenses.
     *
     *	Built for jQuery library
     *	http://jquery.com
     *
     */
    $.fn.charCount = function (options) {

        // default configuration properties
        var defaults = {
            allowed: 140,
            warning: 25,
            css: 'counter right',
            counterElement: 'span',
            cssWarning: 'warning',
            cssExceeded: 'exceeded',
            counterText: ''
        };

        var options = $.extend(defaults, options);

        function calculate(obj) {
            var count = $(obj).val().length;
            var available = options.allowed - count;
            if (available <= options.warning && available >= 0) {
                $(obj).next().addClass(options.cssWarning);
            } else {
                $(obj).next().removeClass(options.cssWarning);
            }
            if (available < 0) {
                $(obj).next().addClass(options.cssExceeded);
            } else {
                $(obj).next().removeClass(options.cssExceeded);
            }
            $(obj).prev().html(options.counterText + available);
        };

        this.each(function () {
            $(this).prev().append('<' + options.counterElement + ' class="' + options.css + '">' + options.counterText + '</' + options.counterElement + '>');
            calculate(this);
            $(this).keyup(function () {
                calculate(this)
            });
            $(this).change(function () {
                calculate(this)
            });
        });

    };

    function getQueryVariable(variable, url) {
        var query = url.split("?");
        var vars = query[1].split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] == variable) {
                return pair[1];
            }
        }
        return (false);
    }
});

var currentLocation;
// Option 1: Auto-geolocating
$(document).ready(function geoFindMe() {
    var output = document.getElementById("map1"); // Get map by id = 'out'
    if (!navigator.geolocation) { // Error check
        output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
        return;
    }

    // Auto-geolocating success
    function success(position) {
        var latitude = position.coords.latitude; // Get current latitude
        var longitude = position.coords.longitude; // Get current longitude
        //output.innerHTML = '<p>Latitude is ' + latitude + ' <br>Longitude is ' + longitude + '</p>';  //*******need transform
        console.log("Latitude " + latitude + " Longitude " + longitude);
        getAddressFromLatLang(latitude, longitude);
        //Reference: https://stackoverflow.com/questions/36149830/how-to-pan-on-google-maps
    };

    // Transform current loocation to readable address
    function getAddressFromLatLang(lat, lng) {
        var geocoder = new google.maps.Geocoder();
        var latLng = new google.maps.LatLng(lat, lng);
        geocoder.geocode({
            'latLng': latLng
        }, function (results, status) { // The returning is a .json file include places information
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var district = results[0].formatted_address.split(','); // Only need districts name
                    output.innerHTML = district[1];
                    var district_without = district[1].split(' ');
                    district_without.splice(-1);
                    currentLocation = district_without.join(' ');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status); //Error check
            }
        });
        //Reference: http://wpcertification.blogspot.com.au/2012/05/getting-address-of-current-location.html
    }

    // Auto-geolocating failed
    function error() {
        output.innerHTML = "Geolocation is not supported by your browsers, please locate manually";
        $('#step2Content').hide();
        $('#step2Branch').show();
    };

    output.innerHTML = "<p>Locating…</p>"; // Word prompts on webpage when locating
    navigator.geolocation.getCurrentPosition(success, error);
})

// Option 2: If need to locating manually
function myMap() {
    var mapCanvas = document.getElementById("map2"); //Create canvas and get map by id = 'map2'
    var myCenter = new google.maps.LatLng(-27.468140, 153.027354); // Set default center of map(Brisbane in this situstion)
    var mapOptions = {
        center: myCenter, // Set the center and zoom for map
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(mapCanvas, mapOptions);

    // listen for the window resize event & trigger Google Maps to update as well
    $(document).ready(function () {
        google.maps.event.addListener(map, 'idle', function () {
            google.maps.event.trigger(map, 'resize');
        });
        //Reference:https://developers.google.com/maps/documentation/javascript/reference
    });

    var geocoder = new google.maps.Geocoder();
    // Reverse geocoding code(transform coordinates into address)  
    google.maps.event.addListener(map, 'click', function (event) {
        geocoder.geocode({
            'latLng': event.latLng
        }, function (results, status) { // The returning is a .json file include places information
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    // Restrict address to be only disrict and state
                    var district = results[0].formatted_address.split(',');
                    var district_without = district[1].split(' ');
                    district_without.splice(-1);
                    currentLocation = district_without.join(' ');
                    $('input[name=address]').attr('value', currentLocation);
                } else {
                    window.alert('No results found'); //Error check
                }
            } else {
                //window.alert('Geocoder failed due to: ' + status); //Error check
            }
        });
        placeMarker(map, event.latLng); // Add marker on map, call placemarker function
    });
    // Reference 1: http://stackoverflow.com/questions/36892826/click-on-google-maps-api-and-get-the-address
    // Reference 2: https://developers.google.com/maps/documentation/javascript/examples/geocoding-reverse
}

// Add marker at option 2 map
var markersArray = [];

function placeMarker(map, location) {
    if (markersArray.length >= 1) { // The amount of marker should be one
        //alert('Please mark only one address :)'); //If user clicked more than one times
        deleteOverlays(); // Call deleteOverlays function to clear all markers 
    }
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
    markersArray.push(marker); // Create an array to store all marker that user clicked
    console.log(markersArray);

    // Reference: http://www.w3schools.com/graphics/google_maps_overlays.asp	
}
// Clear marker at option 2 map
function deleteOverlays() {
    if (markersArray) {
        for (i in markersArray) {
            markersArray[i].setMap(null);
        }
        markersArray.length = 0;
    }
    // Reference:http://www.cnblogs.com/helloj2ee/archive/2013/01/10/2855645.html	
}

// Merge to canvas
function merge() {
    var current_location1 = $('input[name=address]').val();
    var img1_src = $('input[name=firstimg]').val(); // Picked up from trove as front-side
    var img2_src = $('input[name=secondimg]').val(); // Picked up from trove as back-side
    var img3_src = "img/stamp (2).jpg"; // Water-mark
    var Name1 = 'Dear ' + $('input[name=towhom_check]').val() + ','; // Picked up from user greeting
    var Greeting = $('textarea[name=greeting_check]').val();
    var Name2 = $('input[name=fromwhom_check]').val(); // Picked up from user greeting

    // Pstcard front-side
    var canvas1 = document.getElementById("canvas1");
    canvas1.width = 840;
    canvas1.height = 564;
    var ctx1 = canvas1.getContext("2d");
    var bg1 = document.getElementById("bg1");
    ctx1.drawImage(bg1, 0, 0, 840, 564);
    var img1 = new Image();
    img1.src = img1_src; // Front-side Image 
    img1.crossOrigin = "Anonymous";
    img1.onload = function () {
        ctx1.drawImage(img1, 100, 30, 639, 429)
    };
    ctx1.font = "26pt Neuton";
    ctx1.textAlign = "center";
    ctx1.fillText(current_location1, 420, 514); //Geolocation
    ctx1.save();
    // Reference: http://www.w3schools.com/tags/tryit.asp?filename=tryhtml5_canvas_textalign

    // Pstcard back-side
    var canvas2 = document.getElementById("canvas2");
    canvas2.width = 840;
    canvas2.height = 564;
    var ctx2 = canvas2.getContext("2d");
    var bg2 = document.getElementById("bg2");
    ctx2.drawImage(bg2, 0, 0, 840, 564);
    var img2 = new Image();
    img2.src = img2_src; // Back-side Image
    img2.crossOrigin = "Anonymous";
    img2.onload = function () {
        ctx2.drawImage(img2, 641, 36, 159, 115)
    };
    var img3 = new Image();
    img3.src = img3_src; // Water-mark Image
    img3.crossOrigin = "Anonymous";
    img3.onload = function () {
        ctx2.drawImage(img3, 0, 0, 840, 564)
    };
    var text1 = Name1;
    var text2 = Greeting;
    var text3 = Name2;
    ctx2.font = '18pt Neuton';
    wrapText(ctx2, text1, 54, 134, 500, 30); //TO Dear...
    wrapText(ctx2, text2, 54, 161.7, 284, 30); //Content
    wrapText(ctx2, text3, 284, 414, 500, 30); //From...
    ctx2.save();
}

// Greeting text wrap
function wrapText(ctx2, text, x, y, maxWidth, lineHeight) {
    var words = text.split(' ');
    var line = '';
    for (var n = 0; n < words.length; n++) {
        var testLine = line + words[n] + ' ';
        var metrics = ctx2.measureText(testLine);
        var testWidth = metrics.width;
        if (testWidth > maxWidth && n > 0) {
            ctx2.fillText(line, x, y);
            line = words[n] + ' ';
            y += lineHeight;
        } else {
            line = testLine;
        }
    }
    ctx2.fillText(line, x, y);
    //Reference: http://stackoverflow.com/questions/5026961/html5-canvas-ctx-filltext-wont-do-line-breaks
}

// Transfer canvas to image
function to_image() {
    var canvas1 = document.getElementById("canvas1");
    //    document.getElementById("theimage1").src = canvas1.toDataURL();
    var canvas2 = document.getElementById("canvas2");
    //    document.getElementById("theimage2").src = canvas2.toDataURL();
    var image_front = canvas1.toDataURL("image/jpeg", 0.7);
    var image_back = canvas2.toDataURL("image/jpeg", 0.7);
    $('textarea[name=frontimgdata]').val(image_front);
    $('textarea[name=backimgdata]').val(image_back);
}