<?php

use App\Actions\TaskActions;
use App\Models\BankAccount;
use App\Models\Statuses;
use App\Models\Task;
use Illuminate\Http\Request;
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
      $status=Statuses::all();

      BankAccount::query()->update(['statuses'=>null]);
return;

      foreach ($status as $value) {
         
          BankAccount::where('statuses',null)->first()
          ->update([
              'statuses'=>'تم التسجيل',
          ]);

      }

  });


Route::get('/test512512512', function () {
  TaskActions::run();
 });

  Route::get('/invo/{id?}', function ($id,Request $request) {
 //  dd($request->input());
  //  return $request->input();
      $pdf = app("laravel-mpdf")->loadView('pdf',['id'=>$id,'date'=>$request->input(),]);
     return $pdf->stream('document.pdf');
     return view('pdf',);
})->name('pdf');

