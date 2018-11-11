<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotations extends Model
{
    protected $fillable = ['curr_source','usd','eur','gbp','ars','created_at', 'updated_at'];
    protected $guarded = ['id'];
    // Unnecessary declaration
    protected $table = 'Quotations';
}
