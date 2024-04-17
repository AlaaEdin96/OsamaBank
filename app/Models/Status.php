<?php

namespace App\Models;

use App\Trait\CretedByUserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory,CretedByUserTrait;
    protected  $table = 'statuses';
 
    protected $fillable = [
        'statuses',
        'creted_by_user_id',
        'bank_account_id',
      ];
     
     public function bankAccount()
     {
         return $this->belongsTo(BankAccount::class);
     }
    
}
