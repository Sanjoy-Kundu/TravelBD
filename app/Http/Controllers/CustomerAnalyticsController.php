<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Package;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerAnalyticsController extends Controller
{
    public function monthlyCustomerGrowth()
    {
        $customers = Customer::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->whereNull('deleted_at') // Soft delete check
            ->groupByRaw('MONTH(created_at)')
            ->orderBy('month')
            ->get();

        $monthlyData = array_fill(1, 12, 0); // Jan to Dec

        foreach ($customers as $row) {
            $monthlyData[$row->month] = $row->count;
        }

        return response()->json([
            'labels' => array_map(function ($month) {
                return Carbon::create()->month($month)->format('F');
            }, range(1, 12)),
            'data' => array_values($monthlyData),
        ]);
    }

    public function packageSalesData(Request $request)
    {
        $year = now()->year;

        // মাসভিত্তিক প্যাকেজ সেলস ডেটা নিচ্ছি approval = 'Complete' যারা
        $sales = Customer::selectRaw(
            '
        MONTH(customers.created_at) as month,
        COUNT(*) as total_sales,
        GROUP_CONCAT(DISTINCT packages.title SEPARATOR ", ") as package_names
    ',
        )
            ->join('packages', 'customers.package_id', '=', 'packages.id')
            ->whereYear('customers.created_at', $year)
            ->where('customers.approval', 'Complete')
            ->groupBy(DB::raw('MONTH(customers.created_at)'))
            ->orderBy('month')
            ->get();

        // ডিফল্ট ডাটা তৈরি (১ থেকে ১২ মাস)
        $salesCount = array_fill(1, 12, 0);
        $salesPackages = array_fill(1, 12, '');

        foreach ($sales as $row) {
            $salesCount[$row->month] = $row->total_sales;
            $salesPackages[$row->month] = $row->package_names;
        }

        // মাসের নাম গুলো তৈরি
        $labels = collect(range(1, 12))->map(fn($m) => Carbon::create()->month($m)->format('F'));

        return response()->json([
            'labels' => $labels,
            'sales_count' => array_values($salesCount),
            'package_names' => array_values($salesPackages),
        ]);
    }
}
