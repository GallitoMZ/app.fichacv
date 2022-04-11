<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Else_;

class data_req_s1 extends Model
{
    protected $connection= 'mysql';
    protected $table = 'data_req';
    public $timestamps = false;
    protected $fillable = ['DR_DATA','DR_ABREV'];
    protected $primaryKey = 'DR_CODIGO';

    public function getIdAttribute()
    {
        return $this->DR_CODIGO;
    }


}
