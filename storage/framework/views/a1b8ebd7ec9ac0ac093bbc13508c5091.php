

<?php $__env->startSection('content'); ?>
    <div class="student-layout">
        <!-- Student sidebar/navigation -->
        <?php echo $__env->yieldContent('student-content'); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Xamp\htdocs\wct project\student-project-showcase\resources\views/layouts/student.blade.php ENDPATH**/ ?>