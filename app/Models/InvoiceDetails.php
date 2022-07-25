<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }


    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
