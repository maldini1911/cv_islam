<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';
    protected $fillable = ['abbr', 'locale', 'name', 'native', 'diraction', 'active', 'created_at', 'updated_at'];

    public function scopeActive($query)
    {
      return $query->where('active', '1');
    }

    public function getActive()
    {
        return $this->active == 1 ? 'مفعل' : 'غير مفعل';
    }

    public function getDiraction()
    {
        return $this->diraction == 'rtl' ? 'يمين' : 'شمال';
    }
}
