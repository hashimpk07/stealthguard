
<?php $__env->startSection('content'); ?>

<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='<?php echo e(URL::route('salesmen')); ?>'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  New Salesmen Page</h5>
</div>

<form action="javascript:void(0)" id="salesmenForm" name="salesmenForm"  method="post">
   
    <div class="card-body">
        <div class="form-group">
            <label for="salesmen"> Name <span style="color:#ff0000">*</span></label>
                <input type="text" name="salesmen" class="form-control" id="salesmen" placeholder="Enter Name ">
            <div class="error" id="salesmenErr"></div>
        </div>

        <div class="form-group">
            <label for="salesmen"> Parent Salesman </label>
                <div class="input-group">
                <select class="form-control" id="parentSalesman" name="parentSalesman"> 
                    <option value="0">Select Paraent Salesman</option>
                    <?php $__currentLoopData = $salesmen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salesmen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($salesmen->id); ?>"><?php echo e($salesmen->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                </select>
                </div>
            </div>
        

        <div class="form-group">
            <label for="salesmen"> Affiliate Payouts</label>
             <div class="form-group">
                <div class="input-group">
                <select class="form-control" id="affiliate" name="affiliate"> 
                    <option value="0">Select</option>
                    <option value="1">Level 1</option>
                    <option value="2">Level 2</option>
                    <option value="3">Level 3</option>
                    <option value="4">Level 4</option>
                    <option value="5">Level 5</option>
                </select>
                </div>
                <div class="error" id="affiliateErr"></div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="salesmenForm-add btn btn-submit btn-primary" id="salesmenForm-add">Save</button>
    </div>
</form>
                                          
<div style="display: none;" class="pop-outer">
    <div class="pop-inner">
        <h2 class="pop-heading">Salesmen Added Successfully</h2>
    </div>
</div> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script type="text/javascript">  
        $( function() {     
            $('#salesmen').on('input', function() {
                $('#salesmenErr').hide();
            });
        });

        $(document).on('click', '.salesmenForm-add', function (e) {
        
        $('#salesmen').on('input', function() {
            $('salesmenErr').hide();
        });
       
        var salesmenFlag  = 0;
        var salesmen          = $("#salesmen").val();
        var parentSalesman= $('#parentSalesman option:selected').val();
        var affiliate     = $('#affiliate option:selected').val();

        if(salesmen == "") {
            $("#salesmenErr").html("Please Enter Salesman Name");
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
                url:"<?php echo e(route('salesmen.create')); ?>",
                type: "POST",
                dataType: "json",
                data:{ 
                    salesmen:salesmen,
                    parentSalesman:parentSalesman,
                    affiliate:affiliate
                },
                success:function(data){
                    if( data.status == 'success' ){
                        $(".pop-outer").fadeIn("slow");
                        setTimeout(function () {
                            window.location = '<?php echo e(route('salesmen')); ?>'
                        }, 2500);
                    }else{
                        $("#affiliateErr").html("Parent and Affiliate payouts already existing");
                    }
                    
                },
                error: function(response) {
                    
                }
                 
            });
        }
    });
       

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\tt\resources\views/admin/salesmen-add.blade.php ENDPATH**/ ?>