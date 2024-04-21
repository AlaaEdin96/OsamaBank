<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeportationAccount extends Deportations
{
    use HasFactory;
    protected  $table = 'deportation_accounts';

    protected $fillable = [
        'deportations_to',
        'confirmation',
        'confirm_from',
        'note',
        'bank_account_id',
        'creted_by_user_id'
     ];

     public function bankAccount()
     {
         return $this->belongsTo(BankAccount::class,'bank_account_id');
     }

}
