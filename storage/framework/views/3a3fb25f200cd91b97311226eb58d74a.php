
<?php $__env->startSection('content'); ?>
<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='<?php echo e(URL::route('salesmen')); ?>'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  Edit Salesmen Page</h5>
</div>
<form action="javascript:void(0)" id="salesmenForm" name="salesmenForm"  method="post">
    <div class="card-body">
        <div class="form-group">
            <input type="hidden" name="salesmen_id" class="form-control" id="salesmen_id"  value="<?php echo e($salesmen->id); ?>" >
          
             <label for="salesmen"> Name <span style="color:#ff0000">*</span></label>
                <input type="text" name="salesmen" class="form-control" id="salesmen" placeholder="Enter Name " value="<?php echo e($salesmen->name); ?>">
            <div class="error" id="salesmenErr"></div>
        </div>

        <div class="form-group">
            <label for="salesmen"> Salesman Code <span style="color:#ff0000">*</span></label>
                <input type="text" name="salesmencode" class="form-control" id="salesmencode"value="<?php echo e($salesmen->code); ?>" readonly>
          
        </div>

        <div class="form-group">
            <label for="salesmen"> Parent Salesman </label>
            <div class="input-group">
                <select class="form-control" id="parentSalesman" name="parentSalesman"> 
                    <option value="0">Select Size</option>
                    <?php $__currentLoopData = $parent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parents): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($parents->id); ?>" <?php echo e(( $salesmen->parent_id == $parents->id) ? 'selected' : ''); ?>><?php echo e($parents->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="salesmen"> Affiliate Payouts</label>
             <div class="form-group">
                <div class="input-group">
                <select class="form-control" id="affiliate" name="affiliate"> 
                    <option <?php echo e(( $salesmen->level) == '0' ? 'selected' : ''); ?>  value="0"> >Select</option>
                    <option <?php echo e(( $salesmen->level) == '1' ? 'selected' : ''); ?>  value="1" >Level 1</option>
                    <option <?php echo e(( $salesmen->level) == '2' ? 'selected' : ''); ?>  value="2">Level 2</option>
                    <option <?php echo e(( $salesmen->level) == '3' ? 'selected' : ''); ?>  value="3">Level 3</option>
                    <option <?php echo e(( $salesmen->level) == '4' ? 'selected' : ''); ?>  value="4">Level 4</option>
                    <option <?php echo e(( $salesmen->level) == '5' ? 'selected' : ''); ?>  value="5">Level 5</option>
                </select>
                </div>
               <div class="error" id="affiliateErr"></div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="salesmenForm-edit btn btn-submit btn-primary" id="salesmenForm-edit">Save</button>
    </div>
</form>
                                          
<div style="display: none;" class="pop-outer">
    <div class="pop-inner">
        <h2 class="pop-heading">Salesmen Updated Successfully</h2>
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

        $(document).on('click', '.salesmenForm-edit', function (e) {
        
        $('#salesmen').on('input', function() {
            $('#salesmenErr').hide();
        });
        salesmenFlag       = 0;
        var id             = $("#salesmen_id").val();
        var salesmen       = $("#salesmen").val();
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
                url:"<?php echo e(route('salesmen.update')); ?>",
                type: "POST",
                dataType: "json",
                data:{ 
                    id :id,
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
<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\tt\resources\views/admin/salesmen-edit.blade.php ENDPATH**/ ?>