<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $fillable = [
    //     'invoice_number',
    //     'invoice_date',
    //     'due_date',
    //     'product_id',
    //     'section_id',
    //     'collection_amount',
    //     'commission_amount',
    //     'discount',
    //     'value_vat',
    //     'rate_vat',
    //     'total',
    //     'status',
    //     'value_status',
    //     'note',
    //     'payment_date',
    // ];
    protected $guarded = ['id','created_at','updated_at','deleted_at'];

    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }


    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
