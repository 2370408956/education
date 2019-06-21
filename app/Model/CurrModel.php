<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CurrModel extends Model
{
    protected $table='curriculum';
    protected $primaryKey='cid';
    public $timestamps=false;

    public function cate(){
        return $this->belongsTo('App\Model\CateModel');
    }
}
