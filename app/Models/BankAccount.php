<?php

namespace App\Models;

use App\Trait\CretedByUserTrait;
use App\Trait\HasNotes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BankAccount extends Model implements HasMedia
{
    use HasFactory,CretedByUserTrait,InteractsWithMedia;
    use HasNotes;
    protected  $table = 'bank_account';
    
    protected $attributes = [
        'statuses_id' => 1 //Statuses::first()->id,
     ];

    protected $fillable = [
        'name',
        'numder_id',
        'phone',
        'id_card',
        'bank_id',
        'client_id',
        'creted_by_user_id',
        'email',
        'account_number',
        'iban_number',
        'phone_contact'
        ,'statuses_id'
     ];
   
     public function cards()
     {
         return $this->hasMany(BankCard::class,'bank_account_id');
     }

     public function tasks()
     {
         return $this->hasMany(Task::class,'bank_account_id');
     }

     public function statuses()
     {
         return $this->belongsTo(Statuses::class,'statuses_id');
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
 