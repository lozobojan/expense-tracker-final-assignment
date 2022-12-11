<?php

namespace App\Http\Requests;

use App\Models\Expense;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreExpenseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('expense_create');
    }

    public function rules()
    {
        return [
            'entry_date' => [
                'required',
            ],
            'entry_time' => [
                'required',
            ],
            'amount' => [
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'type' => [
                'required',
            ],
            'categories.*' => [
                'integer',
            ],
            'categories' => [
                'array',
            ],
        ];
    }
}
