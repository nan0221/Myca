$(document).ready(function () {
    //    for every page
    $('.fullMask').hide();
    $('#languageDropDown').hide();
    $('#userDropDown').hide();
    $('.language').click(function () {
        $('.fullMask').toggle();
        $('#languageDropDown').toggle();
    });
    $('.user').click(function () {
        $('.fullMask').toggle();
        $('#userDropDown').toggle();
    });
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
            console.log(data);
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
            console.log(data);
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

    //    $('#step2Instruction').find('.arrowdown').click(function () {
    //        showStep3();
    //    });
    //    $('#step3Instruction').find('.arrowdown').click(function () {
    //        showStep4();
    //    });
    //    $('#step4Instruction').find('.arrowdown').click(function () {
    //        showStep5();
    //    });
    //    $('#step5Instruction').find('.arrowdown').click(function () {
    //        showStep6();
    //    });
    //    $('#step3Instruction').find('.arrowup').click(function () {
    //        showStep2();
    //    });
    //    $('#step4Instruction').find('.arrowup').click(function () {
    //        showStep3();
    //    });
    //    $('#step5Instruction').find('.arrowup').click(function () {
    //        showStep4();
    //    });
    //    $('#step6Instruction').find('.arrowup').click(function () {
    //        showStep4();
    //    });

    $('.swiper-slide img').click(function () {
        $(this).toggleClass('selected');
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
            console.log(imgUrl);

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
            console.log(loadedImages);
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
            console.log(loadedImages);
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




var loadedImages = [];
var urlPatterns = ["flickr.com", "nla.gov.au", "artsearch.nga.gov.au", "recordsearch.naa.gov.au", "images.slsa.sa.gov.au"];
var found = 0;


/* ========================================================================
 * Bootstrap: modal.js v3.3.7
 * http://getbootstrap.com/javascript/#modals
 * ========================================================================
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+ function ($) {
    'use strict';

    // MODAL CLASS DEFINITION
    // ======================

    var Modal = function (element, options) {
        this.options = options
        this.$body = $(document.body)
        this.$element = $(element)
        this.$dialog = this.$element.find('.modal-dialog')
        this.$backdrop = null
        this.isShown = null
        this.originalBodyPad = null
        this.scrollbarWidth = 0
        this.ignoreBackdropClick = false

        if (this.options.remote) {
            this.$element
                .find('.modal-content')
                .load(this.options.remote, $.proxy(function () {
                    this.$element.trigger('loaded.bs.modal')
                }, this))
        }
    }

    Modal.VERSION = '3.3.7'

    Modal.TRANSITION_DURATION = 300
    Modal.BACKDROP_TRANSITION_DURATION = 150

    Modal.DEFAULTS = {
        backdrop: true,
        keyboard: true,
        show: true
    }

    Modal.prototype.toggle = function (_relatedTarget) {
        return this.isShown ? this.hide() : this.show(_relatedTarget)
    }

    Modal.prototype.show = function (_relatedTarget) {
        var that = this
        var e = $.Event('show.bs.modal', {
            relatedTarget: _relatedTarget
        })

        this.$element.trigger(e)

        if (this.isShown || e.isDefaultPrevented()) return

        this.isShown = true

        this.checkScrollbar()
        this.setScrollbar()
        this.$body.addClass('modal-open')

        this.escape()
        this.resize()

        this.$element.on('click.dismiss.bs.modal', '[data-dismiss="modal"]', $.proxy(this.hide, this))

        this.$dialog.on('mousedown.dismiss.bs.modal', function () {
            that.$element.one('mouseup.dismiss.bs.modal', function (e) {
                if ($(e.target).is(that.$element)) that.ignoreBackdropClick = true
            })
        })

        this.backdrop(function () {
            var transition = $.support.transition && that.$element.hasClass('fade')

            if (!that.$element.parent().length) {
                that.$element.appendTo(that.$body) // don't move modals dom position
            }

            that.$element
                .show()
                .scrollTop(0)

            that.adjustDialog()

            if (transition) {
                that.$element[0].offsetWidth // force reflow
            }

            that.$element.addClass('in')

            that.enforceFocus()

            var e = $.Event('shown.bs.modal', {
                relatedTarget: _relatedTarget
            })

            transition ?
                that.$dialog // wait for modal to slide in
                .one('bsTransitionEnd', function () {
                    that.$element.trigger('focus').trigger(e)
                })
                .emulateTransitionEnd(Modal.TRANSITION_DURATION) :
                that.$element.trigger('focus').trigger(e)
        })
    }

    Modal.prototype.hide = function (e) {
        if (e) e.preventDefault()

        e = $.Event('hide.bs.modal')

        this.$element.trigger(e)

        if (!this.isShown || e.isDefaultPrevented()) return

        this.isShown = false

        this.escape()
        this.resize()

        $(document).off('focusin.bs.modal')

        this.$element
            .removeClass('in')
            .off('click.dismiss.bs.modal')
            .off('mouseup.dismiss.bs.modal')

        this.$dialog.off('mousedown.dismiss.bs.modal')

        $.support.transition && this.$element.hasClass('fade') ?
            this.$element
            .one('bsTransitionEnd', $.proxy(this.hideModal, this))
            .emulateTransitionEnd(Modal.TRANSITION_DURATION) :
            this.hideModal()
    }

    Modal.prototype.enforceFocus = function () {
        $(document)
            .off('focusin.bs.modal') // guard against infinite focus loop
            .on('focusin.bs.modal', $.proxy(function (e) {
                if (document !== e.target &&
                    this.$element[0] !== e.target &&
                    !this.$element.has(e.target).length) {
                    this.$element.trigger('focus')
                }
            }, this))
    }

    Modal.prototype.escape = function () {
        if (this.isShown && this.options.keyboard) {
            this.$element.on('keydown.dismiss.bs.modal', $.proxy(function (e) {
                e.which == 27 && this.hide()
            }, this))
        } else if (!this.isShown) {
            this.$element.off('keydown.dismiss.bs.modal')
        }
    }

    Modal.prototype.resize = function () {
        if (this.isShown) {
            $(window).on('resize.bs.modal', $.proxy(this.handleUpdate, this))
        } else {
            $(window).off('resize.bs.modal')
        }
    }

    Modal.prototype.hideModal = function () {
        var that = this
        this.$element.hide()
        this.backdrop(function () {
            that.$body.removeClass('modal-open')
            that.resetAdjustments()
            that.resetScrollbar()
            that.$element.trigger('hidden.bs.modal')
        })
    }

    Modal.prototype.removeBackdrop = function () {
        this.$backdrop && this.$backdrop.remove()
        this.$backdrop = null
    }

    Modal.prototype.backdrop = function (callback) {
        var that = this
        var animate = this.$element.hasClass('fade') ? 'fade' : ''

        if (this.isShown && this.options.backdrop) {
            var doAnimate = $.support.transition && animate

            this.$backdrop = $(document.createElement('div'))
                .addClass('modal-backdrop ' + animate)
                .appendTo(this.$body)

            this.$element.on('click.dismiss.bs.modal', $.proxy(function (e) {
                if (this.ignoreBackdropClick) {
                    this.ignoreBackdropClick = false
                    return
                }
                if (e.target !== e.currentTarget) return
                this.options.backdrop == 'static' ? this.$element[0].focus() : this.hide()
            }, this))

            if (doAnimate) this.$backdrop[0].offsetWidth // force reflow

            this.$backdrop.addClass('in')

            if (!callback) return

            doAnimate ?
                this.$backdrop
                .one('bsTransitionEnd', callback)
                .emulateTransitionEnd(Modal.BACKDROP_TRANSITION_DURATION) :
                callback()

        } else if (!this.isShown && this.$backdrop) {
            this.$backdrop.removeClass('in')

            var callbackRemove = function () {
                that.removeBackdrop()
                callback && callback()
            }
            $.support.transition && this.$element.hasClass('fade') ?
                this.$backdrop
                .one('bsTransitionEnd', callbackRemove)
                .emulateTransitionEnd(Modal.BACKDROP_TRANSITION_DURATION) :
                callbackRemove()

        } else if (callback) {
            callback()
        }
    }

    // these following methods are used to handle overflowing modals

    Modal.prototype.handleUpdate = function () {
        this.adjustDialog()
    }

    Modal.prototype.adjustDialog = function () {
        var modalIsOverflowing = this.$element[0].scrollHeight > document.documentElement.clientHeight

        this.$element.css({
            paddingLeft: !this.bodyIsOverflowing && modalIsOverflowing ? this.scrollbarWidth : '',
            paddingRight: this.bodyIsOverflowing && !modalIsOverflowing ? this.scrollbarWidth : ''
        })
    }

    Modal.prototype.resetAdjustments = function () {
        this.$element.css({
            paddingLeft: '',
            paddingRight: ''
        })
    }

    Modal.prototype.checkScrollbar = function () {
        var fullWindowWidth = window.innerWidth
        if (!fullWindowWidth) { // workaround for missing window.innerWidth in IE8
            var documentElementRect = document.documentElement.getBoundingClientRect()
            fullWindowWidth = documentElementRect.right - Math.abs(documentElementRect.left)
        }
        this.bodyIsOverflowing = document.body.clientWidth < fullWindowWidth
        this.scrollbarWidth = this.measureScrollbar()
    }

    Modal.prototype.setScrollbar = function () {
        var bodyPad = parseInt((this.$body.css('padding-right') || 0), 10)
        this.originalBodyPad = document.body.style.paddingRight || ''
        if (this.bodyIsOverflowing) this.$body.css('padding-right', bodyPad + this.scrollbarWidth)
    }

    Modal.prototype.resetScrollbar = function () {
        this.$body.css('padding-right', this.originalBodyPad)
    }

    Modal.prototype.measureScrollbar = function () { // thx walsh
        var scrollDiv = document.createElement('div')
        scrollDiv.className = 'modal-scrollbar-measure'
        this.$body.append(scrollDiv)
        var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth
        this.$body[0].removeChild(scrollDiv)
        return scrollbarWidth
    }


    // MODAL PLUGIN DEFINITION
    // =======================

    function Plugin(option, _relatedTarget) {
        return this.each(function () {
            var $this = $(this)
            var data = $this.data('bs.modal')
            var options = $.extend({}, Modal.DEFAULTS, $this.data(), typeof option == 'object' && option)

            if (!data) $this.data('bs.modal', (data = new Modal(this, options)))
            if (typeof option == 'string') data[option](_relatedTarget)
            else if (options.show) data.show(_relatedTarget)
        })
    }

    var old = $.fn.modal

    $.fn.modal = Plugin
    $.fn.modal.Constructor = Modal


    // MODAL NO CONFLICT
    // =================

    $.fn.modal.noConflict = function () {
        $.fn.modal = old
        return this
    }


    // MODAL DATA-API
    // ==============

    $(document).on('click.bs.modal.data-api', '[data-toggle="modal"]', function (e) {
        var $this = $(this)
        var href = $this.attr('href')
        var $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, ''))) // strip for ie7
        var option = $target.data('bs.modal') ? 'toggle' : $.extend({
            remote: !/#/.test(href) && href
        }, $target.data(), $this.data())

        if ($this.is('a')) e.preventDefault()

        $target.one('show.bs.modal', function (showEvent) {
            if (showEvent.isDefaultPrevented()) return // only register focus restorer if modal will actually get shown
            $target.one('hidden.bs.modal', function () {
                $this.is(':visible') && $this.trigger('focus')
            })
        })
        Plugin.call($target, option, this)
    })

}(jQuery);

var myLatlng = {lat:-27.497843895934665, lng: 153.0128788948059};
// Map display function
function myMap() {
  var mapCanvas = document.getElementById("map");
  var myCenter = new google.maps.LatLng( myLatlng );            // Longitude and latitude  location.lat()  location.lng()
  var mapOptions = {center: myCenter, zoom: 15};                       // Map zoom 
  var map = new google.maps.Map(mapCanvas, mapOptions);
  google.maps.event.addListener(map, 'click', function(event) {
    placeMarker(map, event.latLng);
  }); }

// Add marker & Get location by marker
function placeMarker(map, location) {
  var marker = new google.maps.Marker({
    position: location,
    map: map
  });

// Maker content
var infowindow = new google.maps.InfoWindow({
    content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
    });
  infowindow.open(map,marker);
  } 





