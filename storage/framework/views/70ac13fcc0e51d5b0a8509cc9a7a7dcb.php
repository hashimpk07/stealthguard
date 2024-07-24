
<?php $__env->startSection('content'); ?>

<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='<?php echo e(URL::route('salesmen')); ?>'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  Sales Details </h5>
</div>

<form action="javascript:void(0)" id="salesmenForm" name="salesmenForm"  method="post">
   
    <div class="card-body">
        
        <div class="form-group">
            <label for="salesmen">  Salesman <span style="color:#ff0000">*</span></label>
                <div class="input-group">
                <select class="form-control" id="salesmen" name="salesmen"> 
                    <option value="0">Select Salesman</option>
                    <?php $__currentLoopData = $salesmen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesmen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($salesmen->id); ?>"><?php echo e($salesmen->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                </select>
                </div>
                 <div class="error" id="salesmenErr"></div>
            </div>
        

            <div class="form-group">
                <label for="salesmen"> Amount (commission) <span style="color:#ff0000">*</span></label>
                <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter amount ">
                <div class="error" id="amountErr"></div>
            </div>
    </div>
    <!-- /.card-body -->
    

    <div class="card-footer">
        <button type="submit" class="salesmenForm-add btn btn-submit btn-primary" id="salesmenForm-add">Save</button>
    </div>
</form>
<form action="javascript:void(0)" id="commissionForm" name="commissionForm"  method="post">
   
    <div class="card-body">
<div class="container mt-4">
    
    
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Commission Percentage</th>
                <th>Commission Amount</th>
                <th>lavel</th>
            </tr>
        </thead>
        <tbody id="table-data">
            <!-- Table rows will be populated dynamically -->
        </tbody>
    </table>
    </div>
     
</div>
<div class="card-footer">
        <button type="button" class="btn btn-submit btn-primary" onclick="window.location='<?php echo e(URL::route('sales.add')); ?>'" > Clear </button>
    </div>
</form>
                                          
<div style="display: none;" class="pop-outer">
    <div class="pop-inner">
        <h2 class="pop-heading"> Added Successfully</h2>
    </div>
</div> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script type="text/javascript">  
        $( function() { 
            $('#commissionForm').hide();    
            $('#salesmen').on('input', function() {
                $('#salesmenErr').hide();
                $('#amountErr').hide();
            });
        });

        $(document).on('click', '.salesmenForm-add', function (e) {
        
        $('#salesmen').on('input', function() {
            $('salesmenErr').hide();
            $('#amountErr').hide();
        });
       
        var salesmenFlag  = 0;
        var amount        = $("#amount").val();
        var salesmen      = $('#salesmen option:selected').val();
        

        if(salesmen == 0) {   
            $("#salesmenErr").html("Please Enter Salesman Name");
            salesmenFlag = 1;
        }
        if(amount == "") {
            $("#amountErr").html("Please Enter amount");
            salesmenFlag = 1;
        }
        
        if( 1 == salesmenFlag ){
            return false;
        }else{
           
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:"<?php echo e(route('sales.create')); ?>",
                type: "POST",
                dataType: "json",
                data:{ 
                    salesmen:salesmen,
                    amount:amount
                },
                success:function(response){
                    $('#salesmenForm').hide();
                    $('#commissionForm').show();
                    $('#table-data').empty();
                    $.each(response, function(index, item){
                        var row = '<tr>' +
                        '<td>' + item.name + '</td>' +
                        '<td>' + item.commission_percentage + '</td>' +
                        '<td>' + item.commission + '</td>' +
                        '<td>' + item.lavel + '</td>' +
                        
                        '</tr>';
                        $('#table-data').append(row);
                    }); 
                },
                error: function(response) {
                    
                }
                 
            });
        }
    });
       

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\tt\resources\views/admin/sales-add.blade.php ENDPATH**/ ?>