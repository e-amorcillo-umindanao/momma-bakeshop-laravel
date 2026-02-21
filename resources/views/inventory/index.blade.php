@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-stone-900 tracking-tight">Inventory Management</h1>
                <p class="mt-1 text-sm text-stone-500">Track raw materials and manage finished product stock levels.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('inventory.stock_out') }}"
                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-stone-700 bg-white border border-stone-300 rounded-lg hover:bg-stone-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-sm transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4M12 4l-8 8 8 8">
                        </path>
                    </svg>
                    Stock-Out
                </a>
                <a href="{{ route('inventory.stock_in') }}"
                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-orange-600 border border-transparent rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-sm transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16M12 4l8 8-8 8">
                        </path>
                    </svg>
                    Stock-In
                </a>
                <a href="{{ route('production.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-emerald-600 border border-transparent rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 shadow-sm transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                        </path>
                    </svg>
                    Record Batch
                </a>
            </div>
        </div>

        <!-- Low Stock Alerts -->
        @if($lowStockRawMaterials->count() > 0 || $lowStockProducts->count() > 0)
            <div class="bg-rose-50 border border-rose-200 rounded-xl p-5 flex items-start shadow-sm">
                <div class="shrink-0">
                    <svg class="h-6 w-6 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-bold text-rose-800">Critical Low Stock Alerts</h3>
                    <div class="mt-2 text-sm text-rose-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($lowStockRawMaterials as $item)
                                <li><strong>{{ $item->ItemName }}</strong> is at {{ $item->Quantity }} {{ $item->Measurement }}
                                    (Threshold: {{ $item->LowStockThreshold }})</li>
                            @endforeach
                            @foreach($lowStockProducts as $product)
                                <li><strong>{{ $product->ProductName }}</strong> is at {{ $product->Quantity }} units (Threshold:
                                    {{ $product->LowStockThreshold }})</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Raw Materials Section -->
            <div>
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-stone-800">Raw Materials</h2>
                    <span
                        class="bg-stone-100 text-stone-600 text-xs font-bold px-2.5 py-0.5 rounded-full">{{ $rawMaterials->count() }}
                        Items</span>
                </div>

                <x-table :headers="['Ingredient', 'Quantity', 'Status']" :search="false">
                    @foreach($rawMaterials as $item)
                        <tr class="hover:bg-stone-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-stone-900">{{ $item->ItemName }}</div>
                                <div class="text-xs text-stone-500">Threshold: {{ $item->LowStockThreshold }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-stone-700">{{ $item->Quantity }} <span
                                        class="text-xs font-normal text-stone-500">{{ $item->Measurement }}</span></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item->Quantity <= $item->LowStockThreshold)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">
                                        Low Stock
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        In Stock
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </x-table>
            </div>

            <!-- Finished Goods Section -->
            <div>
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-stone-800">Finished Goods</h2>
                    <span
                        class="bg-stone-100 text-stone-600 text-xs font-bold px-2.5 py-0.5 rounded-full">{{ $finishedGoods->count() }}
                        Products</span>
                </div>

                <x-table :headers="['Product Name', 'Quantity', 'Status']" :search="false">
                    @foreach($finishedGoods as $product)
                        <tr class="hover:bg-stone-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-stone-900">{{ $product->ProductName }}</div>
                                <div class="text-xs text-stone-500">₱{{ number_format($product->Price, 2) }} / unit</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-stone-700">{{ $product->Quantity }} <span
                                        class="text-xs font-normal text-stone-500">units</span></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($product->Quantity <= $product->LowStockThreshold)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">
                                        Low Stock
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        In Stock
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </x-table>
            </div>

        </div>

    </div>
@endsection