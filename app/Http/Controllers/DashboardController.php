<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $dateFrom = $request->get('date_from', Carbon::now()->subMonth()->format('Y-m-d'));
        $dateTo = $request->get('date_to', Carbon::now()->format('Y-m-d'));

        // Total records
        $total = Post::whereBetween('release_date', [$dateFrom, $dateTo])->count();

        // Category distribution (for pie chart)
        $categoryDistribution = Post::select('category', DB::raw('count(*) as count'))
            ->whereBetween('release_date', [$dateFrom, $dateTo])
            ->groupBy('category')
            ->get();

        // Daily aggregation (for column chart)
        $dailyData = Post::select(
            DB::raw('DATE(release_date) as date'),
            DB::raw('count(*) as count')
        )
            ->whereBetween('release_date', [$dateFrom, $dateTo])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top category
        $topCategory = Post::select('category', DB::raw('count(*) as count'))
            ->whereBetween('release_date', [$dateFrom, $dateTo])
            ->groupBy('category')
            ->orderByDesc('count')
            ->first();

        // Latest record
        $latestRecord = Post::whereBetween('release_date', [$dateFrom, $dateTo])
            ->latest('release_date')
            ->first();

        return response()->json([
            'total' => $total,
            'category_distribution' => $categoryDistribution,
            'daily_data' => $dailyData,
            'top_category' => $topCategory,
            'latest_record' => $latestRecord,
            'date_range' => [
                'from' => $dateFrom,
                'to' => $dateTo
            ]
        ]);
    }
}
