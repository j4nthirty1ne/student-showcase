

<?php $__env->startSection('title', 'Edit Profile'); ?>

<?php $__env->startSection('student-content'); ?>
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <h1 class="text-3xl font-bold mb-8">Edit Your Profile</h1>

    <?php if($errors->any()): ?>
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('student.profile.update')); ?>" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-8">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Name -->
        <div class="mb-6">
            <label for="name" class="block text-gray-700 font-bold mb-2">Full Name</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="<?php echo e(old('name', $user->name)); ?>"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Profile Image -->
        <div class="mb-6">
            <label for="profile_image" class="block text-gray-700 font-bold mb-2">Profile Image</label>
            <div class="flex items-center gap-4">
                <?php if($profile->profile_image): ?>
                    <img src="<?php echo e(asset('storage/' . $profile->profile_image)); ?>" alt="<?php echo e($user->name); ?>" class="w-20 h-20 rounded-full object-cover">
                <?php endif; ?>
                <input 
                    type="file" 
                    id="profile_image" 
                    name="profile_image"
                    accept="image/jpeg,image/png,image/jpg"
                    class="px-4 py-2 border border-gray-300 rounded-lg"
                >
            </div>
            <p class="text-sm text-gray-500 mt-2">Max 2MB, formats: JPEG, PNG</p>
            <?php $__errorArgs = ['profile_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Bio -->
        <div class="mb-6">
            <label for="bio" class="block text-gray-700 font-bold mb-2">Bio</label>
            <textarea 
                id="bio" 
                name="bio" 
                rows="5"
                maxlength="500"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Write a brief bio about yourself..."
            ><?php echo e(old('bio', $profile->bio)); ?></textarea>
            <p class="text-sm text-gray-500 mt-2"><?php echo e(strlen(old('bio', $profile->bio ?? ''))); ?>/500 characters</p>
            <?php $__errorArgs = ['bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Skills -->
        <div class="mb-6">
            <label for="skills" class="block text-gray-700 font-bold mb-2">Skills</label>
            <input 
                type="text" 
                id="skills" 
                name="skills" 
                value="<?php echo e(old('skills', implode(', ', $profile->skills ?? []))); ?>"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="e.g., PHP, Laravel, JavaScript, React (comma-separated)"
            >
            <?php $__errorArgs = ['skills'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end gap-4">
            <a href="<?php echo e(route('student.profile.show')); ?>" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</a>
            <button 
                type="submit"
                class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg"
            >
                Save Changes
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Xamp\htdocs\wct project\student-project-showcase\resources\views/student/profile/edit.blade.php ENDPATH**/ ?>