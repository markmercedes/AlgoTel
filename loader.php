<?php

function autoloadStrategy($fullClassName)
{
  $filePath = implode(DIRECTORY_SEPARATOR, explode('\\', $fullClassName)) . '.php';
  require_once __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $filePath;
}
