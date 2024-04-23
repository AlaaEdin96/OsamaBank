<?php


namespace App\Actions;

use App\Models\BankAccount;
use App\Models\Statuses;
use App\Models\Task;
use Lorisleiva\Actions\Concerns\AsAction;

class TaskActions
{
    use AsAction;

    public function handle()
    {
        $Account=BankAccount::
        where('statuses_id','!=',Statuses::latest()->first()->id)
        //->where('statuses_id','!=',Statuses::first()->id)

        ->get();
    //  dd($Account);
           if ($Account->count()>0) {  
             foreach ($Account as $index) {
                $a= Task::where('bank_account_id',$index->id)
                ->whereDate('created_at', now()->today())
                //->where('confirmation',0)
                ->first();
            
              if (!is_null($a)) {
                 return;
              }
                
                 Task::create([
                     'statuses_old'=>$index->statuses_id,
                     'bank_account_id'=>$index->id,
                     'confirmation'=>0
                 ]);
             }
         } else {
             return "noting";
         }
         
         
    }
}