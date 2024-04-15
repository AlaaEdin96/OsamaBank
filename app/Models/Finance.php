<?php

namespace App\Models;

use App\Trait\CretedByUserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory,CretedByUserTrait;
    protected  $table = 'finances';
 
    protected $fillable = [
        'statuses',
        'creted_by_user_id',
        'bank_account_id',
        'value',
        'note',
     ];
}
