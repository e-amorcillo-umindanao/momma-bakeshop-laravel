@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header & Filters -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-stone-800 tracking-tight">Sales Report</h2>
                <p class="text-sm text-stone-500 mt-1">Comprehensive overview of revenue and top products.</p>
            </div>

            <form method="GET" action="{{ route('reports.sales') }}"
                class="flex items-end gap-3 bg-white p-3 rounded-xl shadow-sm border border-stone-200">
                <div>
                    <label class="block text-xs font-semibold text-stone-500 uppercase tracking-wider mb-1">Start
                        Date</label>
                    <input type="date" name="start_date" value="{{ $startDate }}" required
                        class="block w-full text-sm border-stone-200 rounded-lg focus:ring-orange-500 focus:border-orange-500 bg-stone-50">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-stone-500 uppercase tracking-wider mb-1">End Date</label>
                    <input type="date" name="end_date" value="{{ $endDate }}" required
                        class="block w-full text-sm border-stone-200 rounded-lg focus:ring-orange-500 focus:border-orange-500 bg-stone-50">
                </div>
                <button type="submit"
                    class="px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors h-[38px] flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Daily Revenue Table -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden flex flex-col">
                <div class="px-6 py-4 border-b border-stone-100 bg-stone-50/50">
                    <h3 class="text-base font-semibold text-stone-800">Daily Revenue Array</h3>
                </div>
                <div class="flex-1 overflow-x-auto">
                    <table class="min-w-full divide-y divide-stone-200">
                        <thead class="bg-stone-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">
                                    Date</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-semibold text-stone-500 uppercase tracking-wider">
                                    Total Revenue</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-stone-100">
                            @forelse($dailySales as $sale)
                                <tr class="hover:bg-stone-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-stone-900">
                                        {{ \Carbon\Carbon::parse($sale->date)->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-orange-600 text-right">
                                        ₱{{ number_format($sale->total, 2) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-12 text-center text-sm text-stone-500 bg-stone-50/50">
                                        <svg class="mx-auto h-12 w-12 text-stone-300 mb-3" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        No sales records found for this period.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if($dailySales->isNotEmpty())
                            <tfoot class="bg-stone-50 border-t border-stone-200">
                                <tr>
                                    <td class="px-6 py-4 text-sm font-bold text-stone-700 text-right">Grand Total:</td>
                                    <td class="px-6 py-4 text-base font-black text-orange-700 text-right">
                                        ₱{{ number_format($dailySales->sum('total'), 2) }}
                                    </td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>

            <!-- Top Products List -->
            <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden flex flex-col h-full">
                <div class="px-6 py-4 border-b border-stone-100 bg-stone-50/50 flex items-center justify-between">
                    <h3 class="text-base font-semibold text-stone-800">Top 5 Products</h3>
                    <span class="bg-orange-100 text-orange-700 text-xs font-bold px-2 py-0.5 rounded-full">By Volume</span>
                </div>
                <div class="p-4 flex-1">
                    @if($topProducts->isEmpty())
                        <div class="h-full flex flex-col items-center justify-center text-stone-400 py-8 text-sm">
                            No products sold.
                        </div>
                    @else
                        <ul class="space-y-3">
                            @foreach($topProducts as $index => $item)
                                <li
                                    class="flex items-center p-3 rounded-xl border border-stone-100 bg-stone-50/50 hover:bg-white hover:shadow-sm transition-all group">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold
                                                        @if($index == 0) bg-amber-100 text-amber-700 border border-amber-200
                                                        @elseif($index == 1) bg-stone-200 text-stone-600 border border-stone-300
                                                        @elseif($index == 2) bg-amber-50 text-amber-800 border border-amber-100
                                                        @else bg-stone-100 text-stone-500 border border-stone-200
                                                        @endif">
                                            #{{ $index + 1 }}
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-stone-800 truncate">{{ $item->ProductName }}</p>
                                        <p class="text-xs text-stone-500 font-medium mt-0.5 uppercase tracking-wider">Unit Sales</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-black text-orange-600">{{ $item->total_sold }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection