<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ChequeIssuance extends Model
{
    use CrudTrait;
    // use HasFactory;

    protected $fillable = [
        'business_name',
        'bank',
        'cheque_number',
        'remarks',
    ];
}
