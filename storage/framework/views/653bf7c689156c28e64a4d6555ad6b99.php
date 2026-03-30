

<?php $__env->startSection('title', 'My Profile'); ?>

<?php $__env->startSection('student-content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg p-8">
        <div class="flex justify-between items-start mb-6">
            <h1 class="text-3xl font-bold"><?php echo e($user->name); ?></h1>
            <a href="<?php echo e(route('student.profile.edit')); ?>" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Edit Profile</a>
        </div>

        <!-- Profile Header -->
        <div class="mb-8 pb-8 border-b">
            <div class="flex items-center gap-6">
                <?php if($profile->profile_image): ?>
                    <img src="<?php echo e(asset('storage/' . $profile->profile_image)); ?>" alt="<?php echo e($user->name); ?>" class="w-24 h-24 rounded-full object-cover">
                <?php else: ?>
                    <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                <?php endif; ?>
                <div>
                    <p class="text-gray-600"><strong>Email:</strong> <?php echo e($user->email); ?></p>
                    <p class="text-gray-600"><strong>Role:</strong> <?php echo e(ucfirst($user->role)); ?></p>
                    <p class="text-gray-600"><strong>Status:</strong> <span class="text-green-600 font-semibold"><?php echo e(ucfirst($user->status)); ?></span></p>
                </div>
            </div>
        </div>

        <!-- Bio -->
        <div class="mb-6">
            <h3 class="text-xl font-bold mb-2">Bio</h3>
            <p class="text-gray-600"><?php echo e($profile->bio ?? 'No bio added yet.'); ?></p>
        </div>

        <!-- Skills -->
        <div class="mb-6">
            <h3 class="text-xl font-bold mb-2">Skills</h3>
            <?php if($profile->skills && count($profile->skills) > 0): ?>
                <div class="flex flex-wrap gap-2">
                    <?php $__currentLoopData = $profile->skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm"><?php echo e($skill); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-gray-600">No skills added yet.</p>
            <?php endif; ?>
        </div>

        <!-- Member Since -->
        <div class="text-gray-500 text-sm">
            Member since <?php echo e($user->created_at->format('M d, Y')); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Xamp\htdocs\wct project\student-project-showcase\resources\views/student/profile/show.blade.php ENDPATH**/ ?>