<?php

use App\Models\BankAccount;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bb', function () {
    $status=Status::all();
    foreach ($status as $value) {
         
        BankAccount::find($value->bank_account_id)->update([
            'statuses'=>$value->statuses,
        ]);

    }

});


Route::get('/test512512512', function () {
         $Account=BankAccount::where('statuses','!=','تم التنفيد')->get();
        
       // dd($Account[0]);
         if ($Account->count()>0) {
           
            foreach ($Account as $index) {
               $a= Task::where('bank_account_id',$index->id)->where('confirmation',0)->first();
           
             if (!is_null($a)) {
                return;
             }
               
                Task::create([
                    'statuses_old'=>$index->statuses,
                    'confirmation_by_user_id'=>1,
                    'bank_account_id'=>$index->id,
                    'confirmation'=>0
                ]);
            }
        } else {
            return "noting";
        }
        
        
 });
