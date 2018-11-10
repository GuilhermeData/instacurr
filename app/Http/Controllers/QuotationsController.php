<?php

namespace App\Http\Controllers;

use App\Quotations;

class QuotationsController extends Controller
{
    public function getLastQuot()
    {
        return Quotations::where('id', '>', 0)->orderBy('created_at', 'desc')->first();
    }
}
