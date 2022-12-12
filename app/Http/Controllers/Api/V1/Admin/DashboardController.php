<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getReportsData(): array
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
}
