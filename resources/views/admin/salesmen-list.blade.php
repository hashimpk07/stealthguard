@extends('dashboard')
@section('content')

<!-- /.card-header -->
<div class="card-header">
    <button type="button" class="btn btn-info" style="float: left"; onclick="window.location='{{ URL::route('sales.add'); }}'" ><i class="fa fa-plus"></i> Add Sales </button>
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='{{ URL::route('salesmen.add'); }}'" ><i class="fa fa-plus"></i> Add Salesman </button>
</div>
<div class="card-body">
    <h5> Salesmen Table</h5>
   
    <div id="demo"> @include('admin.salesmen-data') </div>
   
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    <input type="hidden" name="select_type" id="select_type" value="0" />

@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
@endsection