<?php

namespace App\Models;

use App\Trait\CretedByUserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deportations extends Model
{
    use HasFactory,CretedByUserTrait;
    protected  $table = 'deportations';
 
    protected $fillable = [
        'deportations_to',
        'confirmation',
        'confirm_from',
        'note',
        'password',
        'bank_card_id',
        'creted_by_user_id'
     ];
 
     public function deportationsTo()
     {
         return $this->belongsTo(User::class,'deportations_to');
     }

     public function confirmFrom()
     {
         return $this->belongsTo(User::class,'confirm_from');
     }

     public function bankCard()
     {
         return $this->belongsTo(BankCard::class,'bank_card_id');
     }
}

