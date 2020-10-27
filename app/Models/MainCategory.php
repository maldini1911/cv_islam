<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
  protected $table = 'main_categories';
  protected $fillable = ['translation_lang', 'translation_of', 'name', 'slug', 'photo', 'active', 'created_at', 'updated_at'];

  public function scopeActive($query)
  {
    return $query->where('active', '1');
  }

  public function getActiveAttribute($val)
  {
      return ($val == 1) ? 'مفعل' : 'غير مفعل';
  }

  public function getPhotoAttribute($val)
  {
      return ($val != null) ? asset($val) : "";
  }

}
