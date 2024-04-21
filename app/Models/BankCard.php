<?php

namespace App\Models;

use App\Trait\CretedByUserTrait;
use App\Trait\HasNotes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankCard extends Model
{
    use HasFactory,CretedByUserTrait;
    use HasNotes;
    protected  $table = 'bank_card';

    protected $fillable = [
        'numder',
        'password',
        'note',
        'bank_account_id',
        'tayp',
     ];


     public function bankAccount()
     {
         return $this->belongsTo(BankAccount::class,'bank_account_id');
     }

     public function deportations()
     {
         return $this->hasMany(Deportations::class,'bank_card_id');
     }
}
 