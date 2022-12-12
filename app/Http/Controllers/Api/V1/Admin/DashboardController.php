<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getBasicReportData(): array
    {
        $incomes = Expense::query()
            ->where('user_id', auth()->id())
            ->where('type', 'like', 'income')
            ->sum('amount');

        $expenses = Expense::query()
            ->where('user_id', auth()->id())
            ->where('type', 'like', 'expense')
            ->sum('amount');

        return [
            'incomes' => number_format($incomes, 2),
            'expenses' => number_format($expenses, 2),
            'balance' => number_format($incomes - $expenses, 2)
        ];
    }

    public function getBarChartReportData(Request $request): array
    {
        return Expense::query()
            ->join('category_expense', 'expense_id', '=', 'expenses.id')
            ->join('categories', 'categories.id', '=', 'category_expense.category_id')
            ->where('user_id', auth()->id())
            ->when($request->has('type'), function ($query) use ($request){
                $query->where('type', 'like', $request->get('type'));
            })
            ->when($request->has('month'), function ($query) use ($request){
                $query->whereMonth('entry_date', $request->get('month'));
            })
            ->select('categories.name')
            ->selectRaw('sum(amount) as total')
            ->groupByRaw('categories.name')
            ->get()->toArray();
    }
}
