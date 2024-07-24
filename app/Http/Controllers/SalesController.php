<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salesmen;
use Carbon;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * show the application of  create page
     *
     * @return void
    */
    public function create()
    {
        $salesmen  = Salesmen::all('id', 'name');
        return view('admin.sales-add',["salesmen" => $salesmen]);
    }
     /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function store(Request $request)
    {
        $input     = $request->all();
        $today     = Carbon\Carbon::now();

        $parent_id = Salesmen::where('id', $input['salesmen'])->value('parent_id');
        $level     = Salesmen::where('id', $input['salesmen'])->value('level');
        $amount    = $input['amount'];
        $salesmens = Salesmen::where('level', '>=', 1)
                        ->where('level', '<=', $level)
                        ->where('parent_id', $parent_id)
                        ->orderBy('level', 'ASC')
                        ->get();
        foreach ($salesmens as $key => $value) {
            if( 1 == $value['level'] ){
                $takeAmount = 0.10*$amount;
                $commissionPercentage = '10%';
            }else if( 2 == $value['level'] ){
               $takeAmount = 0.05*$amount; 
                $commissionPercentage = '5%';
            }else if( 3 == $value['level'] ){
                $takeAmount = 0.03*$amount; 
                $commissionPercentage = '3%';
            }else if( 4 == $value['level'] ){
                $takeAmount = 0.02*$amount; 
                $commissionPercentage = '2%';
            }else if( 5 == $value['level'] ){
                $takeAmount = 0.01*$amount; 
                $commissionPercentage = '1%'; 
            }else{
                $takeAmount = 0;
                $commissionPercentage = '0%'; 
            }
            $result[$key]['name']   = $value['name'];
            $result[$key]['commission_percentage']   = $commissionPercentage;
            $result[$key]['commission'] = $takeAmount;
            $result[$key]['lavel']  = $value['level'];
        }
       
        return $result;
        
    }
}
