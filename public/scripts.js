$(() => {
  $("#lightSlider").lightSlider({
    item: 3,
    responsive: [
      {
        breakpoint: 800,
        settings: {
          item: 2,
          slideMove: 1,
          slideMargin: 6,
        }
      },
      {
        breakpoint: 480,
        settings: {
          item: 1,
          slideMove: 1
        }
      }
    ]
  });

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