<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'headers' => [], 
    'pagination' => null, 
    'search' => true, 
    'filters' => []
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'headers' => [], 
    'pagination' => null, 
    'search' => true, 
    'filters' => []
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
    <!-- Table Toolbar (Search & Filters) -->
    <div class="px-5 py-4 border-b border-slate-200 bg-white flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        
        <!-- Filter Dropdowns Wrapper -->
        <div class="flex items-center gap-3">
            <?php if(count($filters) > 0): ?>
                <div class="font-medium text-sm text-slate-500 mr-2 hidden md:block">Filters:</div>
                <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filterName => $options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <select class="block w-full sm:w-auto pl-3 pr-8 py-1.5 text-sm border-slate-300 text-slate-700 bg-slate-50 transition-colors hover:bg-slate-100 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 border outline-none">
                        <option value=""><?php echo e($filterName); ?></option>
                        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($val); ?>"><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        
        <!-- Search Input -->
        <?php if($search): ?>
        <div class="relative group">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </span>
            <input type="text" 
                   placeholder="Search records..." 
                   class="block w-full sm:w-64 pl-9 pr-3 py-1.5 text-sm border border-slate-300 rounded-lg leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
        </div>
        <?php endif; ?>
        
    </div>

    <!-- Data Table Canvas -->
    <div class="overflow-x-auto w-full">
        <table class="min-w-full divide-y divide-slate-200 table-auto">
            <thead class="bg-slate-50">
                <tr>
                    <?php $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th scope="col" class="px-6 py-3.5 text-left text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                            <?php echo e($header); ?>

                        </th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-100 text-sm text-slate-600">
                <!-- Dynamically Injected Rows (via $slot) -->
                <?php echo e($slot); ?>

            </tbody>
        </table>
    </div>
    
    <!-- Fallback Empty State (if no slot content provided or explicitly empty) -->
    <?php if(trim($slot) === ''): ?>
        <div class="px-6 py-16 text-center bg-white flex flex-col items-center justify-center">
            <div class="bg-slate-50 rounded-full p-3 mb-3">
                <svg class="mx-auto h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <h3 class="text-sm font-semibold text-slate-900 mb-1">No records found</h3>
            <p class="text-sm text-slate-500 max-w-sm">There are no records matching your current filter criteria or the database is empty.</p>
        </div>
    <?php endif; ?>

    <!-- Laravel Native Pagination -->
    <?php if($pagination && method_exists($pagination, 'links')): ?>
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50 flex items-center justify-between">
            <!-- Utilizing Tailwind compilation natively supported by Laravel's paginator -->
            <div class="w-full">
                <?php echo e($pagination->links()); ?>

            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\Evan\OneDrive\Desktop\IT12 Project\MommasBakeshop\resources\views/components/table.blade.php ENDPATH**/ ?>