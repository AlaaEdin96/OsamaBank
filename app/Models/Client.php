<?php

namespace App\Models;

use App\Trait\CretedByUserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory,CretedByUserTrait;
    protected  $table = 'client';

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
