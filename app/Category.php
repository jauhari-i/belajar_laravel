<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['nama'];
    protected $dates =['deleted_at'];
    public function article() {
        
        return $this->hasMany('App\Article');
    }
}
