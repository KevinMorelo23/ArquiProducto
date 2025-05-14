<?php

namespace Report\Controllers;

use App\Http\Controllers\Controller;
use Sale\Model\Sale;
use Product\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('Report::index');
    }

    public function sales(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $sales = Sale::whereBetween('created_at', [$startDate, $endDate.' 23:59:59'])
                     ->get();

        $totalSales = $sales->sum('total');
        $salesCount = $sales->count();

        return view('Report::sales', compact('sales', 'totalSales', 'salesCount', 'startDate', 'endDate'));
    }

    public function products()
    {
        $products = Product::withCount(['sales' => function($query) {
                        $query->where('created_at', '>=', now()->subMonth());
                    }])
                    ->orderByDesc('sales_count')
                    ->take(10)
                    ->get();

        return view('Report::products', compact('products'));
    }

    public function customers()
    {
        $customers = DB::table('sales')
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->select('customers.name', 'customers.email', DB::raw('count(*) as total_orders'), DB::raw('sum(sales.total) as total_spent'))
            ->groupBy('customers.id', 'customers.name', 'customers.email')
            ->orderByDesc('total_spent')
            ->take(10)
            ->get();

        return view('Report::customers', compact('customers'));
    }
}