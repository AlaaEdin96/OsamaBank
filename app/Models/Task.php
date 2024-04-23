<?php

namespace App\Models;

use App\Trait\CretedByUserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Task extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected  $table = 'tasks';

    protected $fillable = [
        'statuses_old',
        'statuses_now',
        'confirmation_by_user_id',
        'bank_account_id',
        'confirmation'
     ];

     public function user()
    {
        return $this->belongsTo(User::class,'confirmation_by_user_id');
    }
     public function bankAccount()
     {
         return $this->belongsTo(BankAccount::class);
     }

     public function StatusesOald()
     {
         return $this->belongsTo(Statuses::class,'statuses_old');
     }


     public function StatusesNow()
     {
         return $this->belongsTo(Statuses::class,'statuses_now');
     }

}
