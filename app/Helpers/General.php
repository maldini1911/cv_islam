<?php

function get_languages()
{
    return App\Models\Language::active()->get();
}

function get_default_language()
{
    return Config::get('app.locale');
}

function uploadImage($folder, $image)
{
  $image->store('/', $folder);
  $filename = $image->hashName();
  $path = 'assets/images/' . $folder . '/' . $filename;
  return $path;
}
