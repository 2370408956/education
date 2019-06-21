<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    protected $table='blog_info';
    protected $primaryKey='blog_id';
    public $timestamps=false;
}
