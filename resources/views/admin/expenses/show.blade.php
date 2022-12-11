@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.expense.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.expenses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.expense.fields.id') }}
                        </th>
                        <td>
                            {{ $expense->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expense.fields.entry_date') }}
                        </th>
                        <td>
                            {{ $expense->entry_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expense.fields.amount') }}
                        </th>
                        <td>
                            {{ $expense->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expense.fields.description') }}
                        </th>
                        <td>
                            {{ $expense->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expense.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Expense::TYPE_SELECT[$expense->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expense.fields.note') }}
                        </th>
                        <td>
                            {{ $expense->note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expense.fields.user') }}
                        </th>
                        <td>
                            {{ $expense->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.expense.fields.category') }}
                        </th>
                        <td>
                            @foreach($expense->categories as $key => $category)
                                <span class="label label-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.expenses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection