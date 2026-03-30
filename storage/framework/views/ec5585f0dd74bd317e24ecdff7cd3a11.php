<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <a href="<?php echo e(route('home')); ?>" class="text-xl font-bold text-blue-600">Student Showcase</a>
        <div class="flex gap-4 items-center">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('student.dashboard')); ?>" class="text-gray-700 hover:text-blue-600 transition">Dashboard</a>
                <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-gray-700 hover:text-red-600 transition bg-none border-none cursor-pointer">Logout</button>
                </form>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="text-gray-700 hover:text-blue-600 transition">Login</a>
                <a href="<?php echo e(route('register')); ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<?php /**PATH D:\Xamp\htdocs\wct project\student-project-showcase\resources\views/components/navbar.blade.php ENDPATH**/ ?>