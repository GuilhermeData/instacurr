<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotations extends Model
{
    protected $fillable = ['curr_source','usd','eur','gbp','ars'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    // Unnecessary declaration
    protected $table = 'Quotations';
}
