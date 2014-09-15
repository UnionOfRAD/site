/*!
 * Minimalistic Scroll To functionality
 *
 * Copyright (c) 2013 David Persson - All rights reserved.
 *
 * Use of this source code is governed by the 3-clause BSD license.
 */
define('scrollTo', ['jquery'], function($) {

  function toOffsets(x, y, speed, easing) {
    var result = new $.Deferred();

    $('html, body').animate(
      {
        scrollTop: y,
        scrollLeft: x
      },
      speed || 'normal',
      easing || 'swing',
      result.resolve
    );

     return result;
  }

  function toElement(element, speed, easing) {
    var $element = $(element);

    return toOffsets(
      $element.offset().left,
      $element.offset().top,
      speed,
      easing
    );
  }

  return {
    element: toElement,
    offsets: toOffsets
  };
});
