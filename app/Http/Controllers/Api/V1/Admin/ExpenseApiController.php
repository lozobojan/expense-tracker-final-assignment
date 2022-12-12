<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\Admin\ExpenseResource;
use App\Models\Expense;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpenseApiController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('expense_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenses = Expense::with(['categories'])
            ->where('user_id', auth()->id())
            ->when($request->has('type'), function ($query) use ($request){
                $query->where('type', $request->get('type'));
            })
            ->when($request->has('description'), function ($query) use ($request){
                $query->where('description', 'like', '%'.$request->get('description').'%');
            })
            ->when($request->has('entry_date'), function ($query) use ($request){
                $query->where('entry_date', $request->get('entry_date'));
            })
            ->when($request->has('category_id'), function ($query) use ($request){
                $query->whereHas('categories', function ($q) use ($request){
                    $q->where('id', $request->get('category_id'));
                });
            })
            ->get();

        return new ExpenseResource(
            $expenses
        );
    }

    public function store(StoreExpenseRequest $request)
    {
        $expense = Expense::create($request->all() + ['user_id' => auth()->id()]);
        $expense->categories()->sync($request->input('categories', []));

        return (new ExpenseResource($expense))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Expense $expense)
    {
        abort_if(Gate::denies('expense_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExpenseResource($expense->load(['user', 'categories']));
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->all());
        $expense->categories()->sync($request->input('categories', []));

        return (new ExpenseResource($expense))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Expense $expense)
    {
        abort_if(Gate::denies('expense_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
