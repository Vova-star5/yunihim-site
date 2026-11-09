/* «Настройки сайта»: выбор фото из медиабиблиотеки */
(function ($) {
  'use strict';

  $('[data-nf-image]').each(function () {
    var box = $(this);
    var input = box.find('[data-nf-image-input]');
    var preview = box.find('[data-nf-image-preview]');
    var remove = box.find('[data-nf-image-remove]');
    var frame;

    box.find('[data-nf-image-choose]').on('click', function () {
      if (!frame) {
        frame = wp.media({ title: 'Выберите фото', button: { text: 'Выбрать' }, library: { type: 'image' }, multiple: false });
        frame.on('select', function () {
          var file = frame.state().get('selection').first().toJSON();
          var size = (file.sizes && (file.sizes.medium || file.sizes.full)) || file;
          input.val(file.id);
          preview.html($('<img>', { src: size.url, alt: '' }));
          remove.prop('hidden', false);
        });
      }
      frame.open();
    });

    remove.on('click', function () {
      input.val('');
      preview.empty();
      remove.prop('hidden', true);
    });
  });
})(jQuery);
