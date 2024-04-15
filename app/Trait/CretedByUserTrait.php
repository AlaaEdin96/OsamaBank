<?php

 
namespace App\Trait;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

 trait CretedByUserTrait 
{
     
 
private $UserId=1;

     protected static function boot()
{

    //تخزي الشخص المدخل للبيانات بشكل تلقائي
    parent::boot();

    // auto-sets values on creation
    static::creating(function ($query) {
         
        $query->creted_by_user_id =Auth::id();
    });
}
    public function user()
    {
        return $this->belongsTo(User::class,'creted_by_user_id');
    }

}
