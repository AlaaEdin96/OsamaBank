<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Trait\CretedByUserTrait;


class Bank extends Model
{
    use HasFactory,CretedByUserTrait;
    protected  $table = 'bank';

    protected $fillable = [
        'name',
        'phone',
        'note',
        'creted_by_user_id'
     ];

     public function bankAccount()
     {
         return $this->hasMany(BankAccount::class,'bank_account_id');
     }

      
}
