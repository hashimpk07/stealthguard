
<?php $__env->startSection('content'); ?>

<!-- /.card-header -->
<div class="card-header">
    <button type="button" class="btn btn-info" style="float: right"; onclick="window.location='<?php echo e(URL::route('salesmen.add')); ?>'" ><i class="fa fa-plus"></i> Add Salesmen </button>
</div>
<div class="card-body">
    <h5> Salesmen Table</h5>
   
    <div id="demo"> <?php echo $__env->make('admin.salesmen-data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div>
   
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    <input type="hidden" name="select_type" id="select_type" value="0" />

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\tt\resources\views/admin/index.blade.php ENDPATH**/ ?>