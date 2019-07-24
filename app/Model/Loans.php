<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'duration', 'repayment_frequence_amount','repayment_frequence','interest_rate','fee','arrangement'
    ];

}
