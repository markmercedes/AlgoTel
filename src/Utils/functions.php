<?php

use Web\Params;

const DS = DIRECTORY_SEPARATOR;

$GLOBALS['CONTENTS'] = [];

function contentFor($key, $value)
{
  $GLOBALS['CONTENTS'][$key] = $value;
}

function yieldContent($key, $default = null)
{
  return $GLOBALS['CONTENTS'][$key] ?? $default;
}

function parameterize($string, $sep = '-')
{

  # Get rid of anything thats not a valid letter, number, dash and underscore and
  # replace with a dash
  $paramterized_string = preg_replace("/[^a-z0-9\-_]/i", $sep, $string);

  # Remove connected dahses so we don't end up with -- anyhwere.
  $paramterized_string = preg_replace("/$sep{2,}/", $sep, $paramterized_string);

  # Remove any trailing spaces from the string
  $paramterized_string = preg_replace("/^$sep|$sep$/", '', $paramterized_string);

  # Downcase the string
  return strtolower($paramterized_string);
}

function linkTo($path = [], $params = [])
{
  $url = implode('/', $path);

  if (count($params)) {
    $queryParams = http_build_query($params);
    $url .= '?' . $queryParams;
  }
  return '/' . $url;
}

function lintoToReservation($path = [], $params = [])
{
  return linkTo(
    $path,
    array_merge([
      'date-in_submit' => Params::get('date-in_submit'),
      'date-out_submit' => Params::get('date-out_submit'),
      'guests' => Params::get('guests'),
      'children' => Params::get('children'),
    ], $params)
  );
}

function checkinDate()
{
  return Params::get('date-in_submit', date('Y-m-d', strtotime("+2 days")));
}

function checkoutDate()
{
  return Params::get('date-out_submit', date('Y-m-d', strtotime("+3 days")));
}

function roomReservationConfig($room)
{
  $dateIn = checkinDate();
  $dateOut = checkoutDate();

  $in = DateTime::createFromFormat('Y-m-d', $dateIn);
  $out = DateTime::createFromFormat('Y-m-d', $dateOut);

  return json_encode(
    [
      'room_id' => $room->id,
      'qty' => 1,
      'per_night' => $room->averagePrice($in, $out),
      'total' => $room->totalPrice($in, $out),
      'date-in' => $dateIn,
      'date-out' => $dateOut,
      'guests' => Params::get('guests', '2'),
      'children' => Params::get('children', '0')
    ]
  );
}

function uploadsPath()
{
  return implode(DS, [appPath(), 'public', 'uploads']);
}

function uploadsUrl($path)
{
  return '/uploads/'  . $path;
}


function appPath()
{
  return dirname(realpath('.'));
}

function select_tag($name, $id, $options, $placeholder = null, $selected = null)
{
?>
  <select class="form-select" id='<?= $id ?>' name='<?= $name ?>'>
    <option><?= $placeholder ?></option>
    <?php foreach ($options as $key => $value) : ?>
      <option <?= $key == $selected ? "selected='selected'" : null ?> value='<?= $key ?>'><?= htmlspecialchars($value) ?></option>
    <?php endforeach; ?>
  </select>
<?php
}
