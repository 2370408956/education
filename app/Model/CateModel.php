<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CateModel extends Model
{
    protected $table='category';
    protected $primaryKey='cateid';
    public $timestamps=false;
}
