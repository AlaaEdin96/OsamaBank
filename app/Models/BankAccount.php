<?php

namespace App\Models;

use App\Trait\CretedByUserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory,CretedByUserTrait;
    protected  $table = 'bank_account';

    protected $fillable = [
        'name',
        'numder_id',
        'phone',
        'id_card',
        'note',
        'bank_id',
        'client_id',
        'creted_by_user_id',
        
     ];
     
     public function cards()
     {
         return $this->hasMany(BankCard::class,'bank_account_id');
     }

     public function statuses()
     {
         return $this->hasMany(Status::class,'bank_account_id');
     }

     public function bank()
     {
         return $this->belongsTo(Bank::class,'bank_id');
     }

     public function client()
     {
         return $this->belongsTo(Client::class,'client_id');
     }

     public function Finances()
     {
         return $this->hasMany(Finance::class,'bank_account_id');
     }
}
 