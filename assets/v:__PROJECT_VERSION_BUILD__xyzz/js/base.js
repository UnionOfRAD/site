
requirejs.config({
  waitSeconds: 15,
  baseUrl: '/assets/js',
  paths: {
    // Base
    'domready': '//cdnjs.cloudflare.com/ajax/libs/require-domReady/2.0.1/domReady.min',
    'jquery': '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min',
    'waypoints': '//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min',
    'recaptcha': 'https://www.google.com/recaptcha/api'

    // li3 docs
    // Because how this uses web workers it must directly be included in the head.
    // 'prism': '//cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min'
  },
  shim: {
    'jquery': { exports: '$' },
    'sticky': { deps: ['jquery'] },
    'waypoints': { deps: ['jquery'] },
    'waypointsSticky': { deps: ['waypoints'] },
    'balanceText': { deps: ['jquery'] },
    'recaptcha': { exports: 'grecaptcha' }
  }
});


require([
  'jquery',  'domready!'
], function(
  $
) {
  var $aside = $('.aside');
  var $content = $('#content > article');

  if ($('.aside.sticky').length) {
    require(['asideSticky'], function() {
      // ..
    });
  }
  if ($aside.length) {
    var aH = $aside.height();
    var cH = $content.height();

    if (aH > cH) {
      $content.css('min-height', aH + 'px');
    }
  }

  // Does not work with links inside headings.
  // if ($('.balance-text').length) {
  //  require(['balanceText'], function() {
  //    $('.balance-text').addClass('balanced');
  //  });
  // }

  $('.vis-toggler').on('click', function(ev) {
    ev.preventDefault();
    $($(this).attr('href')).toggleClass('hide');
  });
});
