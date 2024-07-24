
<?php $__env->startSection('content'); ?>

<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='<?php echo e(URL::route('salesmen')); ?>'" ><i class="fa fa-arrow-left"></i> Back </button>
</div>
<div class="card-body">
   <h5>  Details Salesmen Page</h5>
</div>
<form action="javascript:void(0)" id="sizeForm" name="sizeForm"  method="post">
    
    <div class="card-body">
        
        <div class="form-group">
            <label for="salesmen"> Name <span style="color:#ff0000">*</span></label>
                <input type="text" name="salesmen" class="form-control" id="salesmen" value="<?php echo e($salesmen->name); ?>" readonly >
            <div class="error" id="salesmenErr"></div>
        </div>

        <div class="form-group">
            <label for="salesmen"> Code <span style="color:#ff0000">*</span></label>
                <input type="text" name="salesmen" class="form-control" id="salesmen" value="<?php echo e($salesmen->code); ?>" readonly >
            <div class="error" id="salesmenErr"></div>
        </div>

          <div class="form-group">
            <label for="color"> Parent Salesman <span style="color:#ff0000">*</span></label>
                <input type="text" name="size" class="form-control" id="size" placeholder="Enter Color" value="<?php echo e($salesmen->parent_name); ?>" readonly>
            <div class="error" id="sizeErr"></div>
        </div>

          <div class="form-group">
            <label for="color"> Affiliate Payouts <span style="color:#ff0000">*</span></label>
                <input type="text" name="size" class="form-control" id="size" placeholder="Enter Color" value="<?php echo e($salesmen->level); ?>" readonly>
            <div class="error" id="sizeErr"></div>
        </div>
    </div>
    <!-- /.card-body -->
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\tt\resources\views/admin/salesmen-show.blade.php ENDPATH**/ ?>