<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasTranslations;

    public $translatable = ['Name_class'];

    protected $table = 'classrooms';

    protected $fillable = ['Name_class', 'grade_id'];

    public $timestamps = true;

    public function grades()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }
}
