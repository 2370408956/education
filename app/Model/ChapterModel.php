<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ChapterModel extends Model
{
    protected $primaryKey='chapterid';
    protected $table='chapter';

    public $timestamps=false;
}
