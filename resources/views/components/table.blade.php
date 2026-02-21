@props([
    'headers' => [], 
    'pagination' => null, 
    'search' => true, 
    'filters' => []
])

<div class="bg-white rounded-xl shadow-sm border border-stone-200 overflow-hidden flex flex-col">
    <!-- Table Toolbar (Search & Filters) -->
    <div class="px-5 py-4 border-b border-stone-200 bg-white flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        
        <!-- Filter Dropdowns Wrapper -->
        <div class="flex items-center gap-3">
            @if(count($filters) > 0)
                <div class="font-medium text-sm text-stone-500 mr-2 hidden md:block">Filters:</div>
                @foreach($filters as $filterName => $options)
                    <select class="block w-full sm:w-auto pl-3 pr-8 py-1.5 text-sm border-stone-300 text-stone-700 bg-stone-50 transition-colors hover:bg-stone-100 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 border outline-none">
                        <option value="">{{ $filterName }}</option>
                        @foreach($options as $val => $label)
                            <option value="{{ $val }}">{{ $label }}</option>
                        @endforeach
                    </select>
                @endforeach
            @endif
        </div>
        
        <!-- Search Input -->
        @if($search)
        <div class="relative group">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-stone-400 group-focus-within:text-orange-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </span>
            <input type="text" 
                   placeholder="Search records..." 
                   class="block w-full sm:w-64 pl-9 pr-3 py-1.5 text-sm border border-stone-300 rounded-lg leading-5 bg-white placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all">
        </div>
        @endif
        
    </div>

    <!-- Data Table Canvas -->
    <div class="overflow-x-auto w-full">
        <table class="min-w-full divide-y divide-stone-200 table-auto">
            <thead class="bg-stone-50">
                <tr>
                    @foreach($headers as $header)
                        <th scope="col" class="px-6 py-3.5 text-left text-[11px] font-bold text-stone-500 uppercase tracking-wider">
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-stone-100 text-sm text-stone-600">
                <!-- Dynamically Injected Rows (via $slot) -->
                {{ $slot }}
            </tbody>
        </table>
    </div>
    
    <!-- Fallback Empty State (if no slot content provided or explicitly empty) -->
    @if(trim($slot) === '')
        <div class="px-6 py-16 text-center bg-white flex flex-col items-center justify-center">
            <div class="bg-stone-50 rounded-full p-3 mb-3">
                <svg class="mx-auto h-8 w-8 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <h3 class="text-sm font-semibold text-stone-900 mb-1">No records found</h3>
            <p class="text-sm text-stone-500 max-w-sm">There are no records matching your current filter criteria or the database is empty.</p>
        </div>
    @endif

    <!-- Laravel Native Pagination -->
    @if($pagination && method_exists($pagination, 'links'))
        <div class="px-6 py-4 border-t border-stone-200 bg-stone-50 flex items-center justify-between">
            <!-- Utilizing Tailwind compilation natively supported by Laravel's paginator -->
            <div class="w-full">
                {{ $pagination->links() }}
            </div>
        </div>
    @endif
</div>
