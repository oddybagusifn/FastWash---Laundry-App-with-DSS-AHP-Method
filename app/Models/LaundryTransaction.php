<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class LaundryTransaction extends Model
{
protected $fillable = [
'customer_id',
'transaction_date',
'laundry_weight',
'hpp_per_kg',
'total_hpp',
'total_price'
];


protected $casts = [
'transaction_date' => 'date'
];


public function customer(): BelongsTo
{
return $this->belongsTo(Customer::class);
}
}
