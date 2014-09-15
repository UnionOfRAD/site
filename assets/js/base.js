
requirejs.config({
  waitSeconds: 15,
  baseUrl: '/assets/js',
  paths: {
    // Base
    'domready': '//cdnjs.cloudflare.com/ajax/libs/require-domReady/2.0.1/domReady.min',
    'jquery': '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min',
    'waypoints': '//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min',

    // li3 docs
	'jqueryUi': '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min',
	'showdown': '//cdnjs.cloudflare.com/ajax/libs/showdown/0.3.1/showdown.min',
	'highlight': '//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.0/highlight.min',
	'highlightPhp': '//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.0/languages/php.min',
  },
  shim: {
    'jquery': { exports: '$' },
    'sticky': { deps: ['jquery'] },
    'waypoints': { deps: ['jquery'] },
    'waypointsSticky': { deps: ['waypoints'] },
    'showdown': { exports: 'Showdown' },
    'highlight': { exports: 'hljs' },
    'highlightPhp': { deps: ['highlight'] },
  }
});


require([
  'jquery',  'domready!'
], function(
  $
) {
  var $aside = $('.aside');
  var $content = $('#content > article');

  if ($('code').length) {
    require(['highlight', 'highlightPhp'], function(Highlight) {
      Highlight.initHighlighting();
    });
  }
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
});
