$(() => {
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $(input).parents('div.upload-preview').find('img').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $('.preview-file-on-upload').change(function () {
    readURL(this);
  });

  $('.date-input').pickadate({
    formatSubmit: 'yyyy-mm-dd',
    onClose: function () {
      $(document.activeElement).blur();
    }
  });

  $('.model-date-input').pickadate({
    formatSubmit: 'yyyy-mm-dd',
    format: 'yyyy-mm-dd',
    onClose: function () {
      $(document.activeElement).blur();
    }
  });
})