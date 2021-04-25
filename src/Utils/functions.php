<?php

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
