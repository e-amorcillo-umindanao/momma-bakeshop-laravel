@extends('layouts.app')

@section('content')
    <div class="h-[calc(100vh-8rem)] flex flex-col md:flex-row gap-6" x-data="posSystem({{ $products->toJson() }})">

        <!-- Left Side: Product Browser (Flex-1 allows it to take remaining space) -->
        <div class="flex-1 flex flex-col bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">

            <!-- POS Header & Search -->
            <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between bg-white shrink-0">
                <h2 class="text-lg font-bold text-stone-800">Available Inventory</h2>
                <div class="relative w-64">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" x-model="searchQuery" placeholder="Search products..."
                        class="block w-full pl-9 pr-3 py-2 border border-stone-300 rounded-lg text-sm focus:ring-orange-500 focus:border-orange-500 bg-stone-50 transition-colors">
                </div>
            </div>

            <!-- Product Grid (Scrollable) -->
            <div class="flex-1 overflow-y-auto p-6 bg-stone-50/50">
                @if($products->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-stone-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-stone-900">No products available</h3>
                        <p class="mt-1 text-sm text-stone-500">Inventory shipments are required before selling.</p>
                    </div>
                @else
                    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        <template x-for="product in filteredProducts" :key="product.ID">
                            <button @click="addToCart(product)"
                                class="relative bg-white border border-stone-200 rounded-xl p-4 text-left shadow-sm hover:shadow-md hover:border-orange-300 transition-all focus:outline-none focus:ring-2 focus:ring-orange-500 group overflow-hidden flex flex-col h-full transform hover:-transtone-y-0.5">
                                <div
                                    class="w-full aspect-video bg-orange-50/50 rounded-lg mb-3 flex items-center justify-center text-orange-300 group-hover:bg-orange-100 group-hover:text-orange-500 transition-colors">
                                    <svg class="w-10 h-10 transform group-hover:scale-110 transition-transform duration-300"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <!-- Bakery/Bread/Croissant Icon -->
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 21c-4.97 0-9-2.239-9-5V9.5C3 6.462 7.03 4 12 4s9 2.462 9 5.5V16c0 2.761-4.03 5-9 5z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 13.5c4.5 3 13.5 3 18 0" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v4" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M8.5 5.5v3" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M15.5 5.5v3" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-stone-800 leading-tight mb-1" x-text="product.ProductName">
                                </h3>
                                <div class="mt-auto flex items-end justify-between">
                                    <span class="text-orange-600 font-bold"
                                        x-text="'₱' + Number(product.Price).toFixed(2)"></span>
                                    <span class="text-xs font-medium px-2 py-0.5 rounded-full"
                                        :class="product.Quantity <= 5 ? 'bg-rose-100 text-rose-700' : 'bg-stone-100 text-stone-600'"
                                        x-text="product.Quantity + ' left'"></span>
                                </div>
                            </button>
                        </template>

                        <div x-show="filteredProducts.length === 0"
                            class="col-span-full py-8 text-center text-stone-500 text-sm">
                            No products match your search.
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Side: Order Sidebar (Fixed Width) -->
        <div
            class="w-full md:w-96 flex flex-col bg-white rounded-2xl shadow-lg border border-stone-200 overflow-hidden shrink-0 z-10 relative">

            <!-- Cart Header -->
            <div class="px-6 py-4 bg-stone-900 text-white shrink-0">
                <h2 class="text-lg font-bold flex items-center gap-2">
                    <svg class="w-5 h-5 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    Current Order
                </h2>
                <p class="text-xs text-stone-400 mt-1"><span
                        x-text="new Date().toLocaleDateString() + ' — ' + new Date().toLocaleTimeString()"></span></p>
            </div>

            <!-- Cart Items (Scrollable) -->
            <div class="flex-1 overflow-y-auto p-4 bg-stone-50">
                <template x-if="cart.length === 0">
                    <div class="h-full flex flex-col items-center justify-center text-stone-400 space-y-3">
                        <svg class="w-12 h-12 stroke-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <p class="text-sm font-medium">Cart is empty</p>
                    </div>
                </template>

                <ul class="space-y-3">
                    <template x-for="(item, index) in cart" :key="item.id">
                        <li
                            class="bg-white p-3 rounded-xl border border-stone-200 shadow-sm flex items-start justify-between group">
                            <div class="flex-1 pr-3">
                                <h4 class="text-sm font-bold text-stone-800 leading-tight mb-1" x-text="item.name"></h4>
                                <div class="text-xs text-stone-500" x-text="'₱' + Number(item.price).toFixed(2) + ' each'">
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <span class="text-sm font-bold text-orange-700"
                                    x-text="'₱' + (item.price * item.quantity).toFixed(2)"></span>
                                <div class="flex items-center bg-stone-100 rounded-lg p-0.5 border border-stone-200 mt-1">
                                    <button @click="updateQuantity(index, -1)"
                                        class="w-6 h-6 flex items-center justify-center text-stone-600 hover:bg-white hover:rounded-md hover:shadow-sm transition-all focus:outline-none">−</button>
                                    <input type="text" x-model.number="item.quantity" min="1"
                                        @change="clampQuantity(index)"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value === '0') this.value = '1';"
                                        class="w-10 text-center text-xs font-bold text-stone-800 bg-transparent border-0 focus:ring-0 p-0 m-0 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    <button @click="updateQuantity(index, 1)"
                                        class="w-6 h-6 flex items-center justify-center text-stone-600 hover:bg-white hover:rounded-md hover:shadow-sm transition-all focus:outline-none">+</button>
                                </div>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>

            <!-- Checkout Section (Fixed Bottom) -->
            <div class="bg-white border-t border-stone-200 p-5 shrink-0 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">

                <div class="flex justify-between items-center mb-4 text-sm">
                    <span class="text-stone-500 font-medium">Subtotal</span>
                    <span class="text-stone-800 font-bold" x-text="'₱' + cartTotal.toFixed(2)"></span>
                </div>
                <div class="flex justify-between items-end mb-6">
                    <span class="text-base text-stone-800 font-bold tracking-tight">Total Due</span>
                    <span class="text-3xl font-black text-orange-600 tracking-tighter"
                        x-text="'₱' + cartTotal.toFixed(2)"></span>
                </div>

                <form action="{{ route('pos.checkout') }}" method="POST" id="checkoutForm"
                    @submit="processCheckout($event)">
                    @csrf
                    <input type="hidden" name="cart" :value="JSON.stringify(cart)">

                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-stone-600 mb-1">Type</label>
                            <select name="transaction_type" x-model="transactionType"
                                class="block w-full rounded-lg border-stone-300 py-2.5 px-3 text-sm focus:ring-orange-500 focus:border-orange-500 bg-stone-50 border transition-colors shadow-sm text-stone-700">
                                <option value="Walk-in">Walk-in</option>
                                <option value="B2B">B2B Order</option>
                            </select>
                        </div>
                        <div class="mb-4" x-show="transactionType === 'Walk-in'" x-transition>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Cash Given ₱</label>
                            <input type="number" name="amount_tendered" x-model="amountTendered" min="0" step="0.01"
                                class="block w-full rounded-lg border-stone-300 py-2.5 px-3 text-sm focus:ring-orange-500 focus:border-orange-500 bg-stone-50 border transition-colors shadow-sm font-bold text-stone-800"
                                placeholder="0.00" required>
                        </div>
                    </div>

                    <button type="submit" :disabled="cart.length === 0"
                        class="w-full relative flex items-center justify-center gap-2 py-3.5 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white transition-all disabled:opacity-50 disabled:cursor-not-allowed overflow-hidden"
                        :class="cart.length > 0 ? 'bg-orange-600 hover:bg-orange-500 active:bg-orange-700 hover:shadow-lg hover:-transtone-y-0.5' : 'bg-stone-400'">

                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        Pay & Complete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('posSystem', (initialProducts) => ({
                products: initialProducts,
                searchQuery: '',
                cart: [],
                amountTendered: '',
                transactionType: 'Walk-in',

                get filteredProducts() {
                    if (this.searchQuery === '') return this.products;
                    return this.products.filter(p =>
                        p.ProductName.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                },

                get cartTotal() {
                    return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
                },

                addToCart(product) {
                    let existing = this.cart.find(item => item.id === product.ID);
                    if (existing) {
                        if (existing.quantity < product.Quantity) {
                            existing.quantity++;
                        } else {
                            alert('Insufficient stock!');
                        }
                    } else {
                        this.cart.push({
                            id: product.ID,
                            name: product.ProductName,
                            price: product.Price,
                            quantity: 1,
                            max: product.Quantity
                        });
                    }
                },

                updateQuantity(index, delta) {
                    let item = this.cart[index];
                    let newQuant = item.quantity + delta;

                    if (newQuant > 0 && newQuant <= item.max) {
                        item.quantity = newQuant;
                    } else if (newQuant <= 0) {
                        this.cart.splice(index, 1);
                    } else {
                        alert('Maximum available stock reached.');
                    }
                },

                clampQuantity(index) {
                    let item = this.cart[index];
                    if (item.quantity > item.max) {
                        item.quantity = item.max;
                        alert('Quantity clamped to maximum available stock (' + item.max + ').');
                    }
                    if (item.quantity <= 0 || isNaN(item.quantity)) {
                        this.cart.splice(index, 1);
                    }
                },

                processCheckout(e) {
                    if (this.cart.length === 0) {
                        e.preventDefault();
                        return alert("Cart is empty!");
                    }

                    if (this.transactionType === 'Walk-in') {
                        let tendered = parseFloat(this.amountTendered);
                        if (!tendered || tendered < this.cartTotal) {
                            e.preventDefault();
                            return alert("Amount tendered must be greater than or equal to the total amount.");
                        }
                    }
                    // Form submits naturally
                }
            }))
        })
    </script>
@endsection