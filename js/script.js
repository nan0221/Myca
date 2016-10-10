$(document).ready(function () {
    //    for every page
    $('.fullMask').hide();
    $('#languageDropDown').hide();
    $('#userDropDown').hide();
//    $('.user').click(function () {
//        $('.fullMask').toggle();
//        $('#userDropDown').toggle();
//    });
    $('.close').click(function () {
        $('.fullMask').toggle();
        $('#userDropDown').toggle();
    });


    //    for design page
    $('#taskList').hide();
    $('#step1Instruction').hide();
    $('#step1Content').hide();
    $('#step2Branch').hide();
    $('#step3Instruction').hide();
    $('#step3Content').hide();
    $('#step4Instruction').hide();
    $('#step4Content').hide();
    $('#step5Instruction').hide();
    $('#step5Content').hide();
    $('#step6Instruction').hide();
    $('#step6Content').hide();

    $('#step2Content').find('.button').click(function () {

        loadedImages = [];
        found = 0;
        //get input values
        //        var searchTerm = $('#step2Instruction>h1').val().trim();
        //        searchTerm = searchTerm.replace(/ /g, "%20");
        var searchTerm = 'st.lucia';
        //        var sortBy = $("#sortBy").val();
        var sortBy = 'dateasc';
        var apiKey = "kr6iv720kob8nph6";

        //create searh query
        var url = "http://api.trove.nla.gov.au/result?key=" + apiKey + "&l-availability=y%2Ff&encoding=json&zone=picture&sortby=" + sortBy + "&n=100&q=" + searchTerm + "&callback=?";


        //get the JSON information we need to display the images
        $.getJSON(url, function (data) {
            $('#mainPicture').empty();
            //            console.log(data);
            $.each(data.response.zone[0].records.work, processImages);
            //printImages();

            waitForFlickr(); // Waits for the flickr images to load
        });


        showStep3();
    });
    $('#step2Content').find('.alternativeOption').click(function () {
        $('#step2Content').hide();
        $('#step2Branch').show();
    });
    $('#step2Branch').find('.button').click(function () {
        showStep3();
    });
    $('#step3Content').find('.button').click(function () {
        loadedImages = [];
        found = 0;
        //get input values
        //        var searchTerm = $('#step2Instruction>h1').val().trim();
        //        searchTerm = searchTerm.replace(/ /g, "%20");
        var searchTerm = 'st.lucia';
        //        var sortBy = $("#sortBy").val();
        var sortBy = 'datedesc';
        var apiKey = "kr6iv720kob8nph6";

        //create searh query
        var url = "http://api.trove.nla.gov.au/result?key=" + apiKey + "&l-availability=y%2Ff&encoding=json&zone=picture&sortby=" + sortBy + "&n=100&q=" + searchTerm + "&callback=?";


        //get the JSON information we need to display the images
        $.getJSON(url, function (data) {
            $('#stamps').empty();
            //            console.log(data);
            $.each(data.response.zone[0].records.work, processSmallImages);
            //printImages();

            waitForFlickrSmall(); // Waits for the flickr images to load
        });

        showStep4();
    });
    $('#step4Content').find('.button').click(function () {
        showStep5();
    });
    $('#step5Content').find('.button').click(function () {
        showStep6();
    });

    $('#step6Content').find('.button').click(function () {
        window.location.href = "/share.html";
    });

    function showStep3() {
        $('#step2Instruction').hide();
        $('#step2Content').hide();
        $('#step2Branch').hide();
        $('#step3Instruction').show();
        $('#step3Content').show();
    }

    function showStep4() {
        $('#step3Instruction').hide();
        $('#step3Content').hide();
        $('#step4Instruction').show();
        $('#step4Content').show();
    }

    function showStep5() {
        $('#step4Instruction').hide();
        $('#step4Content').hide();
        $('#step6Instruction').show();
        $('#step6Content').show();
    }

    function showStep6() {
        $('#step5Instruction').hide();
        $('#step5Content').hide();
        $('#step6Instruction').show();
        $('#step6Content').show();
    }

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

        } else { // Could not reliably load image for item
            // UNCOMMENT FOR DEBUG: 
            // console.log("Not available: " + imgUrl);

        }
    }

    function processSmallImages(index, troveItem) {
        if (troveItem.identifier.length > 1) {
            var imgUrl = troveItem.identifier[1].value;
            //            console.log(imgUrl);

            if (typeof (imgUrl) != 'undefined' && imgUrl.indexOf('.jpg') >= 0) {
                //            console.log(imgUrl);
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

        //        var flickr_url_photoInfo = "https://api.flickr.com/services/rest/?method=flickr.photos.getInfo&api_key=" + flickr_key + "&photo_id=" + photo_id + "&format=json&nojsoncallback=1";
        //        var farm_id = flickr_url_photoInfo[0]["farm"];
        //        var server_id = flickr_url_photoInfo[0]["server"];
        //        var photo_secret = flickr_url_photoInfo[0]["secret"];
        //
        //        var flickr_image_url_small = "https://farm" + farm_id + ".staticflickr.com/" + server_id + "/" + photo_id + "_" + photo_secret + "_z.jpg";
        //
        //        loadedImages.push(
        //            flickr_image_url_small
        //        );




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
        //    $("#mainPicture").append("<h3>Image Search Results</h3>");

        // Print out all images
        //        console.log('love' + loadedImages);
        for (var i in loadedImages) {
            var image = new Image();
            //            console.log(loadedImages);
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
        var mySwiper_trove = $('#step3Content .swiper-container').swiper({
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

        // Print out all images
        //        console.log('love' + loadedImages);
        for (var i in loadedImages) {
            var image = new Image();
            //            console.log(loadedImages);
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

$(document).on("mousedown", "#mainPicture img", function () {
    $(this).addClass('selected').siblings().removeClass('selected');
    var selected_front_image = $(this).attr("src");
    console.log('front image:', selected_front_image);
});

$(document).on("mousedown", "#stamps img", function () {
    $(this).addClass('selected').siblings().removeClass('selected');
    var selected_back_image = $(this).attr("src");
    console.log('back image:', selected_back_image);
});

$(document).ready(function geoFindMe() {
    var output = document.getElementById("map1"); // Get map by id = 'out'
    if (!navigator.geolocation) { // Error check
        output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
        return;
    }

    function success(position) {
        var latitude = position.coords.latitude; // Get current latitude
        var longitude = position.coords.longitude; // Get current longitude
        //output.innerHTML = '<p>Latitude is ' + latitude + ' <br>Longitude is ' + longitude + '</p>';  //*******need transform
        console.log("Latitude " + latitude + " Longitude " + longitude);
        getAddressFromLatLang(latitude, longitude);
        // Present image screenshot by their current location for users to ensure(optional)
        // var img = new Image();
        // img.src = "https://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=400x400&sensor=false";
        // output.appendChild(img);
        //Reference: https://stackoverflow.com/questions/36149830/how-to-pan-on-google-maps
    };

    function getAddressFromLatLang(lat, lng) { // Transform current loocation to readable address
        var geocoder = new google.maps.Geocoder();
        var latLng = new google.maps.LatLng(lat, lng);
        geocoder.geocode({
            'latLng': latLng
        }, function (results, status) { // The returning is a .json file include places information
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var district = results[0].formatted_address.split(','); // Only need districts name
                    output.innerHTML = district[1];
					console.log(district[1]);
                }
            } else {
                window.alert('Geocoder failed due to: ' + status); //Error check
            }
        });
        //Reference: http://wpcertification.blogspot.com.au/2012/05/getting-address-of-current-location.html
    }

    function error() { //Error check
        output.innerHTML = "Geolocation is not supported by your browsers";
    };

    output.innerHTML = "<p>Locating…</p>"; // Word prompts on webpage when locating
    navigator.geolocation.getCurrentPosition(success, error);
})

// If users click I'm not here
function myMap() {
    var mapCanvas = document.getElementById("map2"); //Create canvas and get map by id = 'map2'
    var myCenter = new google.maps.LatLng(-27.438119, 152.989124); // Set default center of map(Brisbane in this situstion)
    var mapOptions = {
        center: myCenter, // Set the center and zoom for map
        zoom: 13
    };
    var map = new google.maps.Map(mapCanvas, mapOptions);
    var geocoder = new google.maps.Geocoder();
    // Reverse geocoding code(transform coordinates into address)  
    google.maps.event.addListener(map, 'click', function (event) {
        geocoder.geocode({
            'latLng': event.latLng
        }, function (results, status) { // The returning is a .json file include places information
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    // Ex: The address 10 Abingdon Street, Woolloongabba QLD 4102, Australian. We only want the keyword be Woolloongabba QLD
                    var district = results[0].formatted_address.split(',');  
					var district_without = district[1].split(' ');
					district_without.splice(-1);    
					console.log(district_without.join(' '));
                } else {
                    window.alert('No results found'); //Error check
                }
            } else {
                window.alert('Geocoder failed due to: ' + status); //Error check
            }
        });
        placeMarker(map, event.latLng); // Add marker on map, call placemarker function
    });
    // Reference 1: http://stackoverflow.com/questions/36892826/click-on-google-maps-api-and-get-the-address
    // Reference 2: https://developers.google.com/maps/documentation/javascript/examples/geocoding-reverse
}
var markersArray = [];
// Add marker
function placeMarker(map, location) {
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
    markersArray.push(marker); // Create an array to store all marker that user clicked
    console.log(markersArray);
    if (markersArray.length > 1) { // The amount of marker should be one
        alert('Please mark only one address :)'); //If user clicked more than one times
        deleteOverlays(); // Call deleteOverlays function to clear all markers 
    }
    // Reference: http://www.w3schools.com/graphics/google_maps_overlays.asp	
}
// Clear marker
function deleteOverlays() {
    if (markersArray) {
        for (i in markersArray) {
            markersArray[i].setMap(null);
        }
        markersArray.length = 0;
    }
    // Reference:http://www.cnblogs.com/helloj2ee/archive/2013/01/10/2855645.html	
}

var loadedImages = [];
var urlPatterns = ["flickr.com", "nla.gov.au", "artsearch.nga.gov.au", "recordsearch.naa.gov.au", "images.slsa.sa.gov.au"];
var found = 0;

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

(function ($) {

    $.fn.charCount = function (options) {

        // default configuration properties
        var defaults = {
            allowed: 140,
            warning: 25,
            css: 'counter',
            counterElement: 'div',
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
            $(obj).next().html(options.counterText + available);
        };

        this.each(function () {
            $(this).after('<' + options.counterElement + ' class="' + options.css + '">' + options.counterText + '</' + options.counterElement + '>');
            calculate(this);
            $(this).keyup(function () {
                calculate(this)
            });
            $(this).change(function () {
                calculate(this)
            });
        });

    };

})(jQuery);