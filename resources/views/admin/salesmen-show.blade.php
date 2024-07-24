@extends('dashboard')
@section('content')

<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='{{ URL::route('salesmen'); }}'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  Details Salesmen Page</h5>
</div>
<form action="javascript:void(0)" id="sizeForm" name="sizeForm"  method="post">
    
    <div class="card-body">
        
        <div class="form-group">
            <label for="salesmen"> Name <span style="color:#ff0000">*</span></label>
                <input type="text" name="salesmen" class="form-control" id="salesmen" value="{{$salesmen->name}}" readonly >
            <div class="error" id="salesmenErr"></div>
        </div>

        <div class="form-group">
            <label for="salesmen"> Code <span style="color:#ff0000">*</span></label>
                <input type="text" name="salesmen" class="form-control" id="salesmen" value="{{$salesmen->code}}" readonly >
            <div class="error" id="salesmenErr"></div>
        </div>

          <div class="form-group">
            <label for="color"> Parent Salesman <span style="color:#ff0000">*</span></label>
                <input type="text" name="size" class="form-control" id="size" placeholder="Enter Color" value="{{$salesmen->parent_name}}" readonly>
            <div class="error" id="sizeErr"></div>
        </div>

          <div class="form-group">
            <label for="color"> Affiliate Payouts <span style="color:#ff0000">*</span></label>
                <input type="text" name="size" class="form-control" id="size" placeholder="Enter Color" value="{{$salesmen->level}}" readonly>
            <div class="error" id="sizeErr"></div>
        </div>
    </div>
    <!-- /.card-body -->
</form>
@endsection