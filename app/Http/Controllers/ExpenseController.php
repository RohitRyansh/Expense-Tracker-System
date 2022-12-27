<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Month;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExpenseController extends Controller
{

    public function index(Month $month, Category $category) {

        return view ('expense.index', [
            'expenses' => Expense::VisibleTo($category->id)
                ->get(),
            'month' => $month,
            'category' => $category
        ]);
    } 

    public function create() {

        return view ('expense.create', [
            'categories' => Category::Visibleto()
                ->get(),
        ]);
    }

    public function store(Request $request) {

        $attributes = $request->validate ([
                'item_name' => 'required|string|min:3|max:255',
                'date_of_expense' => 'required|before:tomorrow',
                'cost' => 'required|integer|gt:0',
                'category_id' => ['required',
                Rule::in(Category::VisibleTo()
                    ->get()
                    ->pluck('id')
                    ->toArray()
                    ),
                ],
                'bill_path' => 'mimes:png,jpg,jpeg,pdf'
            ]
        );

        $attributes['bill_path'] = $request->file('bill_path')
            ->store('/attachements');

        Expense::create($attributes);
         
        return to_route ('dashboard')
            ->with('success', 'Expense Added Successfully.');
    }

    public function edit(Month $month, Category $category, Expense $expense) {
        
        return view ('expense.edit', [
            'category' => $category,
            'month' => $month,
            'expense' => $expense
        ]);
    }

    public function update(Request  $request, Month $month, Category $category, Expense $expense) {
        
        $attributes = $request->validate ([
            'item_name' => 'required|string|min:3|max:255',
            'date_of_expense' => 'required|before:tomorrow',
            'cost' => 'required|integer|gt:0',
            'bill_path' => 'mimes:png,jpg,jpeg,pdf'
        ]);

        $attributes['bill_path'] = $request->file('bill_path')
            ->store('/attachements');
        
        $expense->update($attributes);

        return to_route('categories.month.expenses', [$month, $category])
            ->with('success', 'Expense Updated Successfully.');
    }
}
