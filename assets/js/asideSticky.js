define('asideSticky', ['jquery', 'scrollTo', 'waypoints', 'waypointsSticky', 'domready!'],
function($, scrollTo) {

	$('.aside-left.sticky').waypoint('sticky', {
		'wrapper': '<div class="aside-left-sticky-wrapper aside-sticky-wrapper" />'
	});
	$('.aside-right.sticky').waypoint('sticky', {
		'wrapper': '<div class="aside-right-sticky-wrapper aside-sticky-wrapper" />'
	});

	$('.aside a').each(function(k, v) {
		var $link = $(v);
		var $section = $($link.attr('href'));

		$link.on('click', function(ev) {
			ev.preventDefault();

			scrollTo.offsets(
				$section.offset().left,
				$section.offset().top - 100
			);
		});

		$section.waypoint(function(dir) {
			if (dir === 'down') {
				$('.aside .active').removeClass('active');
				$('.aside [href="#' + this.id + '"]').addClass('active');
			}
		}, {offset: 120});
		$section.waypoint(function(dir) {
			if (dir === 'up') {
				$('.aside .active').removeClass('active');
				$('.aside [href="#' + this.id + '"]').addClass('active');
			}
		}, {offset: -150});
	});
});
