

<?php $__env->startSection('content'); ?>
    <h2>Inventory Movement Log</h2>

    <form method="GET" action="<?php echo e(route('reports.inventory')); ?>" style="margin-bottom: 20px;">
        <label>Start Date: <input type="date" name="start_date" value="<?php echo e($startDate); ?>" required></label>
        <label>End Date: <input type="date" name="end_date" value="<?php echo e($endDate); ?>" required></label>
        <button type="submit">Filter</button>
    </form>

    <table style="width: 100%; border-collapse: collapse;" border="1">
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 8px;">Date/Time</th>
            <th style="padding: 8px;">Item Name</th>
            <th style="padding: 8px;">Movement</th>
            <th style="padding: 8px;">Quantity</th>
            <th style="padding: 8px;">Processed By</th>
        </tr>
        <?php $__empty_1 = true; $__currentLoopData = $movements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td style="padding: 8px;"><?php echo e(\Carbon\Carbon::parse($movement->DateAdded)->format('Y-m-d H:i')); ?></td>
                <td style="padding: 8px;"><?php echo e($movement->inventory->ItemName ?? 'Unknown'); ?></td>
                <td style="padding: 8px;">
                    <?php if($movement->MovementType == 'Stock-In'): ?>
                        <span style="color: green;">In</span>
                    <?php else: ?>
                        <span style="color: red;">Out</span>
                    <?php endif; ?>
                </td>
                <td style="padding: 8px;"><?php echo e($movement->Quantity); ?></td>
                <td style="padding: 8px;"><?php echo e($movement->user->FullName ?? 'System'); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5" style="padding: 8px; text-align: center;">No inventory movements logged during this period.</td></tr>
        <?php endif; ?>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Evan\OneDrive\Desktop\IT12 Project\MommasBakeshop\resources\views/reports/inventory.blade.php ENDPATH**/ ?>