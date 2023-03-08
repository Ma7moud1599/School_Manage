<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasTranslations;

    public $translatable = ['Name'];

    protected $table = 'grades';

    protected $fillable = ['Name', 'Nots'];

    public $timestamps = true;

    public function sections()
    {
        return $this->hasMany('App\Models\Section', 'grade_id');
    }
}
