(function ($) {
   "use strict";

  var GaviasElements = {
    init: function(){
      elementorFrontend.hooks.addAction('frontend/element_ready/gva-testimonials.default', GaviasElements.elementTestimonial);
      elementorFrontend.hooks.addAction('frontend/element_ready/gva-posts.default', GaviasElements.elementPosts);
      elementorFrontend.hooks.addAction('frontend/element_ready/gva-portfolio.default', GaviasElements.elementPortfolio);
      elementorFrontend.hooks.addAction('frontend/element_ready/gva-give-forms.default', GaviasElements.elementGiveForms);
      elementorFrontend.hooks.addAction('frontend/element_ready/gva-teams.default', GaviasElements.elementTeams);
      elementorFrontend.hooks.addAction('frontend/element_ready/gva-information.default', GaviasElements.elementInformation);
      elementorFrontend.hooks.addAction('frontend/element_ready/gva-gallery.default', GaviasElements.elementGallery);
      elementorFrontend.hooks.addAction('frontend/element_ready/gva-events.default', GaviasElements.elementGallery);
      elementorFrontend.hooks.addAction('frontend/element_ready/gva-brand.default', GaviasElements.elementBrand);
      elementorFrontend.hooks.addAction('frontend/element_ready/gva-counter.default', GaviasElements.elementCounter);
      elementorFrontend.hooks.addAction('frontend/element_ready/gva-services.default', GaviasElements.elementServices);
    },

    elementTestimonial: function($scope){
      var $carousel = $scope.find('.init-carousel-owl');
      if (!$carousel.length) { return; }
      GaviasElements.initCarousel($carousel);
    },

    elementPosts: function($scope){
      var $carousel = $scope.find('.init-carousel-owl');
      if (!$carousel.length) { return; }
      GaviasElements.initCarousel($carousel);
    },

    elementServices: function($scope){
      var $carousel = $scope.find('.init-carousel-owl');
      if (!$carousel.length) { return; }
      GaviasElements.initCarousel($carousel);
    },

    elementPortfolio: function($scope){
      var $carousel = $scope.find('.init-carousel-owl');
      GaviasElements.initCarousel($carousel);
      if ( $.fn.isotope ) {
        if($('.isotope-items').length){
          $( '.isotope-items' ).each(function() {
            var $el = $( this ),
                $filter = $( '.portfolio-filter a'),
                $loop =  $( this );

            $loop.isotope();
            
            $(window).load(function() {
              $loop.isotope( 'layout' );
            });
          
            if ( $filter.length > 0 ) {
              $filter.on( 'click', function( e ) {
                e.preventDefault();
                var $a = $(this);
                $filter.removeClass( 'active' );
                $a.addClass( 'active' );
                $loop.isotope({ filter: $a.data( 'filter' ) });
              });
            };
          });
        }
      };

    },

    elementGiveForms: function($scope){
      elementorFrontend.waypoint($scope.find('.give__progress-bar'), function () {
        var $progressbar = $(this);
        $progressbar.css('width', $progressbar.data('progress-max'));
      });
      var $carousel = $scope.find('.init-carousel-owl');
      GaviasElements.initCarousel($carousel);
    },

    elementTeams: function($scope){
      var $carousel = $scope.find('.init-carousel-owl');
      if (!$carousel.length) { return; }
      GaviasElements.initCarousel($carousel);
    },

    elementInformation: function($scope){
      var $carousel = $scope.find('.init-carousel-owl');
      if (!$carousel.length) { return; }
      GaviasElements.initCarousel($carousel);
    },

    elementGallery: function($scope){
      var $carousel = $scope.find('.init-carousel-owl');
      if (!$carousel.length) { return; }
      GaviasElements.initCarousel($carousel);
    },

    elementEvents: function($scope){
      var $carousel = $scope.find('.init-carousel-owl');
      if (!$carousel.length) { return; }
      GaviasElements.initCarousel($carousel);
    },

    elementBrand: function($scope){
      var $carousel = $scope.find('.init-carousel-owl');
      if (!$carousel.length) { return; }
      GaviasElements.initCarousel($carousel);
    },

    elementCounter: function($scope){
      var $block = $scope.find('.milestone-block');
      $block.appear(function() {
        var $endNum = parseInt(jQuery(this).find('.milestone-number').text());
        jQuery(this).find('.milestone-number').countTo({
          from: 0,
          to: $endNum,
          speed: 4000,
          refreshInterval: 60,
          formatter: function (value, options) {
            value = value.toFixed(options.decimals);
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            return value;
          }
        });
      },{accX: 0, accY: 0});
    },

    initCarousel: function($target){
      if (!$target.length) { return; }
      var items = $target.data('items') ? $target.data('items') : 5;
      var items_lg = $target.data('items_lg') ? $target.data('items_lg') : 4;
      var items_md = $target.data('items_md') ? $target.data('items_md') : 3;
      var items_sm = $target.data('items_sm') ? $target.data('items_sm') : 2;
      var items_xs = $target.data('items_xs') ? $target.data('items_xs') : 1;
      var loop = $target.data('loop') ? $target.data('loop') : false;
      var speed = $target.data('speed') ? $target.data('speed') : 200;
      var auto_play = $target.data('auto_play') ? $target.data('auto_play') : false;
      var auto_play_speed = $target.data('auto_play_speed') ? $target.data('auto_play_speed') : false;
      var auto_play_timeout = $target.data('auto_play_timeout') ? $target.data('auto_play_timeout') : 1000;
      var auto_play_hover = $target.data('auto_play_hover') ? $target.data('auto_play_hover') : false;
      var navigation = $target.data('navigation') ? $target.data('navigation') : false;
      var pagination = $target.data('pagination') ? $target.data('pagination') : false;
      var mouse_drag = $target.data('mouse_drag') ? $target.data('mouse_drag') : false;
      var touch_drag = $target.data('touch_drag') ? $target.data('touch_drag') : false;
      $target.owlCarousel({
        nav: navigation,
        autoplay: auto_play,// auto_play,
        autoplayTimeout: auto_play_timeout,
        autoplaySpeed: auto_play_speed,
        autoplayHoverPause: auto_play_hover,
        navText: [ '<i class="gv-icon-164"></i>', '<i class="gv-icon-165"></i>' ],
        autoHeight: false,
        loop: loop, 
        dots: pagination,
        rewind: true,
        smartSpeed: speed,
        mouseDrag: mouse_drag,
        touchDrag: touch_drag,
        responsive : {
          0 : {
            items: 1,
            nav: false
          },
          640 : {
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
    }
  };
  
  $(window).on('elementor/frontend/init', GaviasElements.init);   

}(jQuery));
