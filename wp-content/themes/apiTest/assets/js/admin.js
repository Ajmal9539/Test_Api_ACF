jQuery(function($) {
  $(document).on('mouseover', '.acf-fc-popup li a', function() {
    var $this = $(this);
    var parent = $this.closest('.acf-fc-popup');
    var filename = $this.attr('data-layout');

    if (parent.find('.preview').length > 0) {
      parent
        .find('.preview')
        .html(
          '<div class="inner-preview"><img src="' +
            theme_var.upload +
            filename +
            '.png"/></div>'
        );
    } else {
      parent.append(
        '<div class="preview"><div class="inner-preview"><img src="' +
          theme_var.upload +
          filename +
          '.png"/></div></div>'
      );
    }
  });
});
