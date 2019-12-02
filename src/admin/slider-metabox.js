jQuery(document).ready(function ($) {
  if (typeof wp === 'undefined' || typeof wp.media === 'undefined') {
    return false;
  }

  /**
   * Check required metabox options
   */
  if (typeof eul_slider_metabox === 'undefined') {
    return false;
  }


  /**
   * Click on choose image button
   */
  $('#eul-slider-choose').on('click', function (e) {
    e.preventDefault();

    // Create custom state
    var state = wp.media.controller.Library.extend({
      defaults: _.defaults({
        filterable: 'all',
      }, wp.media.controller.Library.prototype.defaults)
    });

    // Open default wp.media image frame
    var frame = wp.media({
      title: eul_slider_metabox.choose || '',
      multiple: false,
      states: [
        new state()
      ]
    });

    // On open frame select current attachment
    frame.on('open', function () {
      var selection = frame.state().get('selection');
      var attachment = $('#eul-slider-attachment').val();

      selection.add(wp.media.attachment(attachment));
    });

    // On image select
    frame.on('select', function () {
      var selection = frame.state().get('selection').first().toJSON();

      // Set hidden input attachment id
      $('#eul-slider-attachment').val(selection.id);

      if (typeof selection.sizes.slider !== 'undefined') {
        selection = selection.sizes.slider;
      }

      if ($('#eul-slider-image').length === 0) {
        var image = $('<figure><img id="eul-slider-image" /></figure>');

        // Add image before choose button
        $('#eul-slider-choose').before(image)
      }

      $('#eul-slider-image').attr('src', selection.url);
    });

    frame.open();
  });


  /**
   * Click on remove image button
   */
  $('#eul-slider-remove').on('click', function (e) {
    e.preventDefault();

    // Remove img with figure tag
    $('#eul-slider-image').closest('figure').remove();

    // Set blank attachment value
    $('#eul-slider-attachment').val('');
  });
});