var icms = icms || {};
icms.neoimages = (function ($) {

    this.resizeBinded = false;
    this.pswpRootAppended = false;

    this.init = function (thumbsID) {
        if (!this.pswpRootAppended) {
            var pswpHtml = $('#neoimages-pswp-root-' + thumbsID).html();
            if (pswpHtml) {
                $('body').append(pswpHtml);
                this.pswpRootAppended = true;
            }
        }
        if (!this.resizeBinded) {
            $(window).on('resize', icms.neoimages.calculateSizes);
            this.resizeBinded = true;
        }
        this.calculateSizes();
    };

    this.openPhotoSwipe = function (index, galleryElement, disableAnimation) {
        var pswpElement = document.querySelectorAll('.neoimages-pswp')[0];
        var items = this.parseThumbnailElements(galleryElement);

        var options = {
            getThumbBoundsFn: function(index) {
                var thumbnail = items[index].el,
                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                    rect = thumbnail.getBoundingClientRect();

                return { x: rect.left, y: rect.top + pageYScroll, w: rect.width };
            },
            history: false,
            shareButtons: [
                {
                    id: 'download',
                    label: 'Скачать изображение',
                    url: '{{raw_image_url}}',
                    download: true
                }
            ],
            showHideOpacity: true
        };

        options.index = parseInt(index, 10);

        if (isNaN(options.index)) {
            return;
        }

        if (disableAnimation) {
            options.showAnimationDuration = 0;
        }

        var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);

        var useLargeImages = false;
        var imageSrcWillChange = false;
        var firstResize = true;

        gallery.listen('beforeResize', function() {

            var dpiRatio = window.devicePixelRatio ? window.devicePixelRatio : 1;
            dpiRatio = Math.min(dpiRatio, 2.5);

            var realViewportWidth = gallery.viewportSize.x * dpiRatio;

            if (realViewportWidth >= 1200 || (!gallery.likelyTouchDevice && realViewportWidth > 800) || screen.width > 1200) {
                if (!useLargeImages) {
                    useLargeImages = true;
                    imageSrcWillChange = true;
                }
            } else {
                if (useLargeImages) {
                    useLargeImages = false;
                    imageSrcWillChange = true;
                }
            }

            if (imageSrcWillChange && !firstResize) {
                gallery.invalidateCurrItems();
            }

            if (firstResize) {
                firstResize = false;
            }

            imageSrcWillChange = false;

        });

        gallery.listen('gettingData', function(index, item) {
            item.src = item.full.src;
            item.w   = item.full.width;
            item.h   = item.full.height;
        });

        gallery.init();
    };

    this.parseThumbnailElements = function (thumbsEl) {
        var items = [];
        var thumbElements = thumbsEl.childNodes;

        for (var i = 0; i < thumbElements.length; i++) {
            var el = thumbElements[i];
            
            if (el.nodeType !== 1) {
                continue;
            }

            var size       = el.getAttribute('data-size').split('x');
            var thumb_size = el.getAttribute('data-thumb-size').split('x');

            var item = {
                src: el.getAttribute('data-thumb-src'),
                width: parseInt(thumb_size[0], 10),
                height: parseInt(thumb_size[1], 10),
                full: {
                    src: el.getAttribute('data-src'),
                    width: parseInt(size[0], 10),
                    height: parseInt(size[1], 10)
                }
            };

            item.el = el;

            items.push(item);
        }

        return items;
    };

    this.onThumbnailsClick = function (e) {
        e.preventDefault();

        var clickedEl = e.target;
        var galleryElement = clickedEl.parentNode;
        var childNodes = galleryElement.childNodes;
        var nodeIndex = 0, index;

        for (var i = 0; i < childNodes.length; i++) {
            if (childNodes[i].nodeType !== 1) { 
                continue; 
            }

            if (childNodes[i] === clickedEl) {
                index = nodeIndex;
                break;
            }

            nodeIndex++;
        }

        if (index >= 0) {
            this.openPhotoSwipe(index, galleryElement);
        }

        return false;
    };

    this.photoShow = function (el, e) {
        this.onThumbnailsClick(e);
    };

    this.calculateSizes = function () {
        $('.neoimages-images').each(function (i, thumbsEl) {
            var thumbs = icms.neoimages.parseThumbnailElements(thumbsEl);
            icms.neoimages.renderThumbs(thumbs, thumbsEl);
        });
    };

    this.renderThumbs = function (thumbs, thumbsEl) {
        var margin = parseInt(thumbsEl.getAttribute('data-margin'), 10);
        var width = thumbsEl.getBoundingClientRect().width;
        var thumbsEdit = new NmThumbsEdit(width, margin);
        var result = thumbsEdit.processThumbs(thumbs);

        for (let i = 0; i < result.items.length; i++) {
            var item = result.items[i];

            $(item.el).removeClass('neoimages-image-single neoimages-image-last-row neoimages-image-last-column');

            if (item['single']) {
                $(item.el).addClass('neoimages-image-single');
            } else {
                if (item['lastRow']) {
                    $(item.el).addClass('neoimages-image-last-row');
                }

                if (item['lastColumn']) {
                    $(item.el).addClass('neoimages-image-last-column');
                }
            }

            $(item.el).css({
                width: item.width,
                height: item.height,
            });
        }
        
        $(thumbsEl).css({ 'height': result.height });
    };

    return this;

}).call({}, jQuery);