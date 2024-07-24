<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salesmen;
use Carbon;
use Illuminate\Support\Facades\DB;

class SalesmenController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $salesmen = Salesmen::select('salesmens.*', 'parent.name as parent_name')
        ->leftJoin('salesmens as parent', 'salesmens.parent_id', '=', 'parent.id')
        ->orderBy('salesmens.id', 'desc') 
        ->paginate(10);
        return view('admin.salesmen-list', ['salesmen' => $salesmen]); 

    }
    /**
     * show the application of  create page
     *
     * @return void
    */
    public function create()
    {
        $salesmen  = Salesmen::all('id', 'name');
        return view('admin.salesmen-add',["salesmen" => $salesmen]);
    }
     /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function store(Request $request)
    {
        $input = $request->all();
        $today     = Carbon\Carbon::now();

        $validatedData = $request->validate([
            'salesmen'          => 'required'
        ]);
        if( $input['parentSalesman'] == 0 ){
            $parentSalesman   = NULL;
        }else{
            $parentSalesman   = $input['parentSalesman'];
            $parentIdSalesmen =  Salesmen::query()
                    ->where('parent_id', '=', $parentSalesman)
                    ->where('level', '=', $input['affiliate'])
                    ->get();
            if($parentIdSalesmen->isNotEmpty() ){
               return response()->json(['status'=>'error']); 
            }
                   
        }


        $code =  "SGD0".$this->generateEmployeeCode();
        $Salesmen = Salesmen::create([
            'name'         => $input['salesmen'],
            'code'         => $code,
            'parent_id'    => $parentSalesman,
            'level'         => $input['affiliate'],
            'created_at'    => $today,
            'updated_at'    => $today,
        ]);
        return response()->json(['status'=>'success']); 
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\request  $request
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $parent  = Salesmen::all('id', 'name');
        $salesmen = Salesmen::select('salesmens.*')
                    ->where('salesmens.id', '=',$id )
                    ->get();
        return view('admin.salesmen-edit', ['salesmen' => $salesmen[0],"parent" => $parent ]);
    } 
     /**
    * Display the specified resource.
    *
    * @param  \App\request  $request
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        
        $salesmen = Salesmen::select('salesmens.*', 'parent.name as parent_name')
                    ->leftJoin('salesmens as parent', 'salesmens.parent_id', '=', 'parent.id')
                    ->where('salesmens.id', '=',$id )
                    ->get();
        return view('admin.salesmen-show', ['salesmen' => $salesmen[0]]);
    } 
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserData  $userData
     * @return \Illuminate\Http\Response
    */
    public function update(Request $request)
    {
        $input     =   $request->all();
        $today     =   Carbon\Carbon::now();
        $aUpdate   =   [];
       
        $validatedData = $request->validate([
            'salesmen'          => 'required'
        ]);
        $id        =   $input['id'];
        if( $input['parentSalesman'] == 0 ){
            $parentSalesman   = NULL;
        }else{
            $parentSalesman   = $input['parentSalesman'];
            $parentIdSalesmen =  Salesmen::query()
                    ->where('parent_id', '=', $parentSalesman)
                    ->where('level', '=', $input['affiliate'])
                    ->where('id', '!=', $id )
                    ->get();
            if($parentIdSalesmen->isNotEmpty() ){
               return response()->json(['status'=>'error']); 
            }
                   
        }

        $aUpdate     = [
            'name'         => $input['salesmen'],
            'parent_id'    => $parentSalesman,
            'level'         => $input['affiliate'],
            'updated_at'    => $today,
        ];
      
        $salesmen = DB::table('salesmens')
            ->where('id', $id)
            ->update($aUpdate);
        return response()->json(['status'=>'success']);
    }
    /**
    * delete the specified resource.
    *
    * @param  \App\request  $request
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $parent = Salesmen::find($id);
        if ($parent) {
            $parent->delete();
            $children = Salesmen::where('parent_id', $id)->get();
            Salesmen::where('parent_id', $id)->delete();
        }
        return redirect()->back();
    }
    
    public function generateEmployeeCode()
    {
        return rand(pow(10, 4-1), pow(10, 4)-1);
    }
}
