<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;

    public $translatable = ['Name_section'];

    protected $table = 'sections';

    protected $fillable = ['Name_section', 'Grade_id', 'Class_id'];

    public $timestamps = true;

    public function section_grade()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }

    public function section_class()
    {
        return $this->belongsTo('App\Models\Classroom', 'Class_id');
    }

    // علاقة الاقسام مع المعلمين
    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher', 'teacher_section');
    }

    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }
}
