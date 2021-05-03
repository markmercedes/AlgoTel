$(() => {
  $("#lightSlider").lightSlider();

  var today = new Date();

  $('#date-in').pickadate({
    formatSubmit: 'yyyy-mm-dd',
    onOpen: function () {
      var $input = $('#date-in').pickadate();
      if ($input.hasClass('picker__input--target')) {
        $input.pickadate().pickadate('picker').close(true);
      }
    },
    min: today,
    onSet: function (context) {
      var $input = $('#date-out').pickadate();
      var picker = $input.pickadate('picker');

      picker.set('min', new Date(context.select));

      picker.open();
    },
  });

  $('#date-out').pickadate({
    formatSubmit: 'yyyy-mm-dd',
    onClose: function () {
      $(document.activeElement).blur();
    },
    onOpen: function () {
      var $input = $('#date-out').pickadate();
      if ($input.hasClass('picker__input--target')) {
        $input.pickadate().pickadate('picker').close(true);
      }
    }
  });
})