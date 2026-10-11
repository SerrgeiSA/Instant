    window.onload = function() {
        document.body.classList.add('loaded_hiding');
        window.setTimeout(function() {
            document.body.classList.add('loaded');
            document.body.classList.remove('loaded_hiding');
        }, 500);
    }
    var isMobile = /android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase());

    var icms = icms || {};

    icms.nm = (function($) {

        var self = this;



        this.onDocumentReady = function() {




            if ($('body').hasClass('user_logged')) {


                var allCountsForUserMenu = 0;

                if (isMobile) {
                    $('#nm_mobmenu_usermenu > li > a > .nm_mobmenu-counter').each(function(i, event) {
                        allCountsForUserMenu += parseInt($(this).text());
                    });
                    if (allCountsForUserMenu > 0) {
                        var icms_user_avatar = $('.nm-usermenu-toggle-btn');
                        icms_user_avatar.find('.counter').remove();
                        icms_user_avatar.append('<span class="counter badge badge-danger" style="right:-10px;top:4px;font-size:11px">' + allCountsForUserMenu + '</span>');
                    }
                } else {
                    $('.menu-personal > li > a > .counter').each(function(i, event) {
                        allCountsForUserMenu += parseInt($(this).text());
                    });
                    if (allCountsForUserMenu > 0) {
                        var icms_user_avatar = $('.icms-user-menu > div[data-toggle="dropdown"]');
                        icms_user_avatar.find('.counter').remove();
                        icms_user_avatar.append('<span class="counter badge badge-danger" style="position:absolute;left:35px;top:8px;font-size:11px">' + allCountsForUserMenu + '</span>');
                    }

                }




            }



            $('#nm_mobmenu').dcAccordion({
                eventType: 'click',
                autoClose: true,
                saveState: false,
                disableLink: false,
                showCount: false,
                speed: 'fast'
            });

            $('#nm_mobmenu_usermenu').dcAccordion({
                eventType: 'click',
                autoClose: true,
                saveState: false,
                disableLink: false,
                showCount: false,
                speed: 'fast'
            });

            $('.bi_date_pub svg').replaceWith('<svg class="icms-svg-icon w-16" fill="currentColor"><use href="/templates/nm/images/icons/regular.svg#clock"></use></svg>');
            $('.bi_comments svg').replaceWith('<svg class="icms-svg-icon w-16" fill="currentColor"><use href="/templates/nm/images/icons/regular.svg#comments"></use></svg>');




            $('.nm_mobmenu a').click(function(event) {
                if ($(event.target).hasClass('dcjq-icon')) {
                    return false;
                }
            });


            $(document).on("touchmove", ".nm_mobmenu, .nm_mobmenu *", function() {
                return false;
            });






            $('.nm-nav-usermenu .nav-link.dropdown-toggle').click(function(event) {




                if ($(event.target).hasClass('nav-item-toggler')) {

                    $('.nm-nav-usermenu .nav-link').not($(this)).removeClass('open');
                    $('.nm-nav-usermenu .nav-item').not($(this).closest('.nav-item')).removeClass('show');



                    if ($(this).hasClass('open')) {
                        $(this).closest('.nav-item').dropdown('hide');
                    } else {
                        $(this).closest('.nav-item').dropdown('show');
                    }

                    $(this).toggleClass('open');
                    $(this).closest('.nav-item').toggleClass('show');

                    return false;

                }



            });


            $(document).on("click", ".nm-toggle-btn", function() {


                if ($('body').is('.nm-nav-search-opened, .nm-main-search-opened, .nm-nav-usermenu-opened')) {
                    return false;
                }

                $('body').toggleClass('nm-main-nav-opened');
                $(this).toggleClass('show');
                if (!$(this).hasClass('show')) {
                    $('#target-main').removeClass('show');
                    $('body').removeClass('nm-main-nav-opened nm-nav-usermenu-opened');
                }

            });

            $(document).on("click", ".nm-search-toggle-btn", function() {

                if ($('body').is('.nm-main-nav-opened, .nm-nav-usermenu-opened')) {
                    return false;
                }

                $('body').toggleClass('nm-main-search-opened');
                $(this).toggleClass('morphed');

                $('body').removeClass('nm-nav-usermenu-opened');

            });



            $(document).on("click", ".nm-nav-search-toggle-btn", function() {

                if ($('body').is('.nm-main-nav-opened, .nm-nav-usermenu-opened')) {
                    return false;
                }

                $('body').toggleClass('nm-nav-search-opened');
                $(this).toggleClass('morphed');

                $('body').removeClass('nm-nav-usermenu-opened');

                return false;

            });


            $(document).on("click", ".nm-usermenu-toggle-btn", function() {

                if ($('body').is('.nm-main-nav-opened, .nm-nav-search-opened, .nm-main-search-opened')) {
                    return false;
                }


                if (!$('body').hasClass('user_logged') && !$('.nm-nav-questmenu').length) {



                    $.ajax({
                        url: '/auth/login',
                        data: false,
                        beforeSend: function(request) {
                            request.setRequestHeader('ICMS-Request-Type', 1);
                        },
                        success: function(result) {
                            $('<div class="nm-nav-usermenu nm-nav-questmenu links-on-dark text-on-dark">' + result + '</div>').appendTo('.nm-main-nav nav');
                        },
                        error: function(result) {

                        },
                        dataType: 'html'
                    });


                }


                $('body').toggleClass('nm-nav-usermenu-opened');
                $(this).toggleClass('morphed');

                return false;

            });





            setTimeout(function() {


                window.onscroll = function() { HeadStickyFunction() };

                var sticky = $('.nm-main-nav');
                var stickyTop = sticky.offset().top;

                function HeadStickyFunction() {

                    if (window.pageYOffset > sticky.height()) {


                        $('body').addClass("nm-main-nav-sticked");
                        $('#target-main form').addClass('compact');

                    } else {
                        $('body').removeClass("nm-main-nav-sticked");
                        $('#target-main form').removeClass('compact');
                    }
                }

                if ($('.nm-header-contacts.append-to-main-nav').length > 0) {

                    var mc = $('.nm-header-contacts').html();
                    $('<div class="d-flex justify-content-end align-items-center mm-nav-contacts">' + mc + '</div>').appendTo('#target-main');
                    $('#target-main').addClass('has-contacts');

                }


            }, 500);




            $(document).on("click", ".accordion_tabs .card-header", function() {

                $(this).closest('.accordion_tabs').find('.card.active').not($(this).closest('.card')).removeClass('active');
                $(this).closest('.card').toggleClass('active');

            });




            $(document).on("click", ".play-btn", function() {

                vId = getYoutubeId($(this).attr('data-video'));
                $("#modal_video_iframe").attr('src', '//www.youtube.com/embed/' + vId + '?autoplay=1');
                $("#modal_video").modal('show');

                return false;

            });


            $("#modal_video").on('hide.bs.modal', function(e) {
                $("#modal_video_iframe").attr('src', '');
            });

            function getYoutubeId(url) {
                const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
                const match = url.match(regExp);

                return (match && match[2].length === 11) ?
                    match[2] :
                    null;
            }




            $(document).on("change", "#fset_group_wrap #parent_id", function() {

                var value = $(this).val();

                $.ajax({
                    method: "POST",
                    url: '/nm/group_cats_ajax',
                    data: { id: value, fname: 'cats' },
                    dataType: 'json'
                }).done(function(response) {
                    if (!response.error) {


                        $('#f_group_category').remove();

                        $('#fset_group_wrap').append(response.html);


                    }

                });

            });




        };

        return this;

    }).call(icms.nm || {}, jQuery);





    (function($) {
        $.fn.dcAccordion = function(options) {
            var defaults = { classParent: 'dcjq-parent', classActive: 'active', classArrow: 'dcjq-icon', classCount: 'dcjq-count', classExpand: 'dcjq-current-parent', eventType: 'click', hoverDelay: 300, menuClose: true, autoClose: true, autoExpand: false, speed: 'slow', saveState: true, disableLink: true, showCount: false, cookie: 'dcjq-accordion' };
            var options = $.extend(defaults, options);
            this.each(function(options) {
                var obj = this;
                setUpAccordion();
                if (defaults.saveState == true) { checkCookie(defaults.cookie, obj) }
                if (defaults.autoExpand == true) { $('li.' + defaults.classExpand + ' > a').addClass(defaults.classActive) }
                resetAccordion();
                if (defaults.eventType == 'hover') {
                    var config = { sensitivity: 2, interval: defaults.hoverDelay, over: linkOver, timeout: defaults.hoverDelay, out: linkOut };
                    $('li a', obj).hoverIntent(config);
                    var configMenu = { sensitivity: 2, interval: 1000, over: menuOver, timeout: 1000, out: menuOut };
                    $(obj).hoverIntent(configMenu);
                    if (defaults.disableLink == true) { $('li a', obj).click(function(e) { if ($(this).siblings('ul').length > 0) { e.preventDefault() } }) }
                } else {
                    $('li a', obj).click(function(e) {
                        $activeLi = $(this).parent('li');
                        $parentsLi = $activeLi.parents('li');
                        $parentsUl = $activeLi.parents('ul');
                        if (defaults.disableLink == true) { if ($(this).siblings('ul').length > 0) { e.preventDefault() } }
                        if (defaults.autoClose == true) { autoCloseAccordion($parentsLi, $parentsUl) }
                        if ($('> ul', $activeLi).is(':visible')) {
                            $('ul', $activeLi).slideUp(defaults.speed);
                            $('a', $activeLi).removeClass(defaults.classActive)
                        } else {
                            $(this).siblings('ul').slideToggle(defaults.speed);
                            $('> a', $activeLi).addClass(defaults.classActive)
                        }
                        if (defaults.saveState == true) { createCookie(defaults.cookie, obj) }
                    })
                }

                function setUpAccordion() {
                    $arrow = '<span class="' + defaults.classArrow + '"></span>';
                    var classParentLi = defaults.classParent + '-li';
                    $('> ul', obj).show();
                    $('li', obj).each(function() {
                        if ($('> ul', this).length > 0) {
                            $(this).addClass(classParentLi);
                            $('> a', this).addClass(defaults.classParent).append($arrow)
                        }
                    });
                    $('> ul', obj).hide();
                    if (defaults.showCount == true) {
                        $('li.' + classParentLi, obj).each(function() {
                            if (defaults.disableLink == true) { var getCount = parseInt($('ul a:not(.' + defaults.classParent + ')', this).length) } else { var getCount = parseInt($('ul a', this).length) }
                            $('> a', this).append(' <span class="' + defaults.classCount + '">(' + getCount + ')</span>')
                        })
                    }
                }

                function linkOver() {
                    $activeLi = $(this).parent('li');
                    $parentsLi = $activeLi.parents('li');
                    $parentsUl = $activeLi.parents('ul');
                    if (defaults.autoClose == true) { autoCloseAccordion($parentsLi, $parentsUl) }
                    if ($('> ul', $activeLi).is(':visible')) {
                        $('ul', $activeLi).slideUp(defaults.speed);
                        $('a', $activeLi).removeClass(defaults.classActive)
                    } else {
                        $(this).siblings('ul').slideToggle(defaults.speed);
                        $('> a', $activeLi).addClass(defaults.classActive)
                    }
                    if (defaults.saveState == true) { createCookie(defaults.cookie, obj) }
                }

                function linkOut() {}

                function menuOver() {}

                function menuOut() {
                    if (defaults.menuClose == true) {
                        $('ul', obj).slideUp(defaults.speed);
                        $('a', obj).removeClass(defaults.classActive);
                        createCookie(defaults.cookie, obj)
                    }
                }

                function autoCloseAccordion($parentsLi, $parentsUl) {
                    $('ul', obj).not($parentsUl).slideUp(defaults.speed);
                    $('a', obj).removeClass(defaults.classActive);
                    $('> a', $parentsLi).addClass(defaults.classActive)
                }

                function resetAccordion() {
                    $('ul', obj).hide();
                    $allActiveLi = $('a.' + defaults.classActive, obj);
                    $allActiveLi.siblings('ul').show()
                }
            });

            function checkCookie(cookieId, obj) {
                var cookieVal = $.cookie(cookieId);
                if (cookieVal != null) {
                    var activeArray = cookieVal.split(',');
                    $.each(activeArray, function(index, value) {
                        var $cookieLi = $('li:eq(' + value + ')', obj);
                        $('> a', $cookieLi).addClass(defaults.classActive);
                        var $parentsLi = $cookieLi.parents('li');
                        $('> a', $parentsLi).addClass(defaults.classActive)
                    })
                }
            }

            function createCookie(cookieId, obj) {
                var activeIndex = [];
                $('li a.' + defaults.classActive, obj).each(function(i) {
                    var $arrayItem = $(this).parent('li');
                    var itemIndex = $('li', obj).index($arrayItem);
                    activeIndex.push(itemIndex)
                });
                $.cookie(cookieId, activeIndex, { path: '/' })
            }
        }
    })(jQuery);