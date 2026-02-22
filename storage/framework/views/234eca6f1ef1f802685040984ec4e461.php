

<?php $__env->startSection('content'); ?>
    <h2>Edit User</h2>
    
    <?php if($errors->any()): ?>
        <div style="color: red;">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('users.update', $user->ID)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div style="margin-bottom: 15px;">
            <label>Full Name:</label><br>
            <input type="text" name="FullName" value="<?php echo e(old('FullName', $user->FullName)); ?>" required>
        </div>
        <div style="margin-bottom: 15px;">
            <label>Username:</label><br>
            <input type="text" name="Username" value="<?php echo e(old('Username', $user->Username)); ?>" required>
        </div>
        <div style="margin-bottom: 15px;">
            <label>Password (Leave blank to keep current password):</label><br>
            <input type="password" name="Password">
        </div>
        <div style="margin-bottom: 15px;">
            <label>Role:</label><br>
            <select name="Role" required>
                <option value="Cashier" <?php echo e(old('Role', $user->Role) == 'Cashier' ? 'selected' : ''); ?>>Cashier</option>
                <option value="Inventory Clerk" <?php echo e(old('Role', $user->Role) == 'Inventory Clerk' ? 'selected' : ''); ?>>Inventory Clerk</option>
                <option value="Owner/Admin" <?php echo e(old('Role', $user->Role) == 'Owner/Admin' ? 'selected' : ''); ?>>Owner/Admin</option>
            </select>
        </div>
        <button type="submit">Update User</button>
        <a href="<?php echo e(route('users.index')); ?>">Cancel</a>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Evan\OneDrive\Desktop\IT12 Project\MommasBakeshop\resources\views\users\edit.blade.php ENDPATH**/ ?>