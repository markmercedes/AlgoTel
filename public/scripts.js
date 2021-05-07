function refreshSmallCart() {
  $.get('/SmallCart', function (data) {
    $('#small-cart').replaceWith(data);
  });
}

$(() => {
  $(document).on('click', '.remove-item-from-cart', function (e) {
    e.preventDefault();

    var itemId = $(this).data('id');

    var items = JSON.parse(Cookies.get('CART') || '[]');

    items = items.filter((item) => {
      return item.id != itemId
    });

    Cookies.set('CART', JSON.stringify(items));

    refreshSmallCart();
  });



  $('.btn-select-room-for-reservation').click(function (e) {
    e.preventDefault();

    var config = $(this).closest('.item-in-list').data('reservationConfig');

    var items = JSON.parse(Cookies.get('CART') || '[]');

    items.push(Object.assign({}, { id: Math.floor(Math.random() * 100000000) }, config));

    Cookies.set('CART', JSON.stringify(items));

    refreshSmallCart();
  });

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