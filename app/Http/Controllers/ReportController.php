<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SoldProduct;
use App\Models\StockMovement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Get quick summaries for the dashboard
        $todaySales = Sale::whereDate('DateAdded', today())->sum('TotalAmount');
        $lowStockProducts = Product::where('Quantity', '<=', 10)->count(); // configurable threshold

        return view('reports.index', compact('todaySales', 'lowStockProducts'));
    }

    public function salesReport(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        // Get daily sales totals
        $dailySales = Sale::whereBetween(DB::raw('DATE(DateAdded)'), [$startDate, $endDate])
            ->select(DB::raw('DATE(DateAdded) as date'), DB::raw('SUM(TotalAmount) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Get top selling products
        $topProducts = SoldProduct::join('Sales', 'SoldProducts.SaleID', '=', 'Sales.ID')
            ->join('Products', 'SoldProducts.ProductID', '=', 'Products.ID')
            ->whereBetween(DB::raw('DATE(Sales.DateAdded)'), [$startDate, $endDate])
            ->select('Products.ProductName', DB::raw('SUM(SoldProducts.Quantity) as total_sold'))
            ->groupBy('Products.ProductName')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        return view('reports.sales', compact('dailySales', 'topProducts', 'startDate', 'endDate'));
    }

    public function inventoryReport(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        $movements = StockMovement::with(['inventory', 'user'])
            ->whereBetween(DB::raw('DATE(DateAdded)'), [$startDate, $endDate])
            ->orderByDesc('DateAdded')
            ->get();

        return view('reports.inventory', compact('movements', 'startDate', 'endDate'));
    }
}