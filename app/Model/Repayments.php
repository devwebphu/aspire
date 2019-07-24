<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Repayments extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'loan_id', 'amount','description'
    ];
    protected $table = "transaction_payments";

}
