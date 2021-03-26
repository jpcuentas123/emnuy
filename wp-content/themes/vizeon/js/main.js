(function($) {
  "use strict";
  var GaviasTheme = {
    init: function(){
      GaviasTheme.initCarousel();
      GaviasTheme.menuMobile();
      GaviasTheme.postMasonry();
      GaviasTheme.scrollTop();
      GaviasTheme.carouselProductThumbnial();
      GaviasTheme.stickyMenu();
      GaviasTheme.other();
      $('.team__progress-bar').each(function(){
        var $progressbar = $(this);
        $progressbar.css('width', $progressbar.data('progress-max'));
      })
    },
    
    initCarousel: function(){
      $('.init-carousel-owl-theme').each(function(){
        var items = $(this).data('items') ? $(this).data('items') : 5;
        var items_lg = $(this).data('items_lg') ? $(this).data('items_lg') : 4;
        var items_md = $(this).data('items_md') ? $(this).data('items_md') : 3;
        var items_sm = $(this).data('items_sm') ? $(this).data('items_sm') : 2;
        var items_xs = $(this).data('items_xs') ? $(this).data('items_xs') : 1;
        var loop = $(this).data('loop') ? $(this).data('loop') : false;
        var speed = $(this).data('speed') ? $(this).data('speed') : 200;
        var auto_play = $(this).data('auto_play') ? $(this).data('auto_play') : false;
        var auto_play_speed = $(this).data('auto_play_speed') ? $(this).data('auto_play_speed') : false;
        var auto_play_timeout = $(this).data('auto_play_timeout') ? $(this).data('auto_play_timeout') : 1000;
        var auto_play_hover = $(this).data('auto_play_hover') ? $(this).data('auto_play_hover') : false;
        var navigation = $(this).data('navigation') ? $(this).data('navigation') : false;
        var rewind_nav = $(this).data('rewind_nav') ? $(this).data('rewind_nav') : false;
        var pagination = $(this).data('pagination') ? $(this).data('pagination') : false;
        var mouse_drag = $(this).data('mouse_drag') ? $(this).data('mouse_drag') : false;
        var touch_drag = $(this).data('touch_drag') ? $(this).data('touch_drag') : false;

        $(this).owlCarousel({
          nav: navigation,
          autoplay: auto_play,
          autoplayTimeout: auto_play_timeout,
          autoplaySpeed: auto_play_speed,
          autoplayHoverPause: auto_play_hover,
          navText: [ '<i class="gv-icon-164"></i>', '<i class="gv-icon-165"></i>' ],
          autoHeight: false,
          loop: loop, 
          dots: pagination,
          rewind: rewind_nav,
          smartSpeed: speed,
          mouseDrag: mouse_drag,
          touchDrag: touch_drag,
          responsive : {
            0 : {
              items: 1,
              nav: false
            },
            580 : {
              items : items_xs,
              nav: false
            },
            768 : {
              items : items_sm,
              nav: false
            },
            992: {
              items : items_md
            },
            1200: {
              items: items_lg
            },
            1400: {
              items: items
            }
          }
        }); 
      }); 
    },

    menuMobile: function(){
      $('.gva-offcanvas-content ul.gva-mobile-menu > li:has(ul)').addClass("has-sub");
      $('.gva-offcanvas-content ul.gva-mobile-menu > li:has(ul) > a').after('<span class="caret"></span>');
      $( document ).on('click', '.gva-offcanvas-content ul.gva-mobile-menu > li > .caret', function(e){
        e.preventDefault();
        var checkElement = $(this).next();
        $('.gva-offcanvas-content ul.gva-mobile-menu > li').removeClass('menu-active');
        $(this).closest('li').addClass('menu-active'); 
        
        if((checkElement.is('.submenu-inner')) && (checkElement.is(':visible'))) {
          $(this).closest('li').removeClass('menu-active');
          checkElement.slideUp('normal');
        }
        
        if((checkElement.is('.submenu-inner')) && (!checkElement.is(':visible'))) {
          $('.gva-offcanvas-content ul.gva-mobile-menu .submenu-inner:visible').slideUp('normal');
          checkElement.slideDown('normal');
        }
        
        if (checkElement.is('.submenu-inner')) {
          return false;
        } else {
          return true;  
        }   
      })

      $( document ).on( 'click', '.canvas-menu.gva-offcanvas > a.dropdown-toggle', function(e) {
        e.preventDefault();
        var $style = $(this).data('canvas');
        if($('.gva-offcanvas-content' + $style).hasClass('open')){
          $('.gva-offcanvas-content' + $style).removeClass('open');
          $('#gva-overlay').removeClass('open');
          $('#wp-main-content').removeClass('blur');
        }else{
          $('.gva-offcanvas-content' + $style).addClass('open');
          $('#gva-overlay').addClass('open');
          $('#wp-main-content').addClass('blur');
        }
      });
      $( document ).on( 'click', '#gva-overlay', function(e) {
        e.preventDefault();
        $(this).removeClass('open');
        $('.gva-offcanvas-content').removeClass('open');
        $('#wp-main-content').removeClass('blur');
      })
      $( document ).on( 'click', '.close-canvas', function(e) {
        e.preventDefault();
        $('.gva-offcanvas-content').removeClass('open');
        $('#gva-overlay').removeClass('open');
        $('#wp-main-content').removeClass('blur');
      })

    },

    postMasonry: function(){
      var $container = $('.post-masonry-style');
      $container.imagesLoaded( function(){
        $container.masonry({
          itemSelector : '.item-masory',
          gutterWidth: 0,
          columnWidth: 1,
        }); 
      });
    },

    scrollTop: function(){
      var offset = 300;
      var duration = 500;

      jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
          jQuery('.return-top').fadeIn(duration);
        } else {
          jQuery('.return-top').fadeOut(duration);
        }
      });

      $( document ).on('click', '.return-top', function(event){
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
      });
    },

    carouselProductThumbnial: function(){
      $('.flex-control-nav.flex-control-thumbs').owlCarousel({
        nav: true,
        navText: [ '<i class="gv-icon-164"></i>', '<i class="gv-icon-165"></i>' ],
        margin: 10,
        dots: false,
        responsive : {
          0 : {
            items: 1,
            nav: false
          },
          640 : {
            items : 3,
            nav: false
          },
          768 : {
            items : 3,
            nav: false
          },
          992: {
            items : 4
          },
          1200: {
            items: 4
          },
          1400: {
            items: 4
          }
        }
      });
    },

    stickyMenu: function(){
      if($('.gv-sticky-mobile').length > 0){
        var sticky = new Waypoint.Sticky({
          element: $('.gv-sticky-mobile')[0],
          wrapper: '<div class="sticky-wrapper-mobile" />',
        });
      } 

      if($('.gv-sticky-menu').length > 0){
        var sticky = new Waypoint.Sticky({
          element: $('.gv-sticky-menu')[0],
          offset: 0
        });
      }
    },

    other: function(){
      $('.popup-video').magnificPopup({
        type: 'iframe',
        fixedContentPos: false
      });
      $(".lightGallery").lightGallery({
        selector: '.image-item .zoomGallery'
      });

      $( document ).on( 'click', '.yith-wcwl-add-button.show a', function() {
        $(this).addClass('loading');
      });

      $(document).on('click', '.gva-search > a.control-search', function(){
        if($(this).hasClass('search-open')){
          $(this).parents('.gva-search').removeClass('open');
          $(this).removeClass('search-open');
        }else{
          $(this).parents('.gva-search').addClass('open');
          $(this).addClass('search-open');
        }
      });

      $('.gva-offcanvas-content .sidebar, .mini-cart-header .dropdown .minicart-content').perfectScrollbar();

      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
    }

  }

  $(document).ready(function(){
    GaviasTheme.init();
  })

})(jQuery);

