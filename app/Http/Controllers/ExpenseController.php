<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExpenseController extends Controller
{

    public function index(Category $category) {

        return view ('expense.index', [
            'expenses' => Expense::VisibleTo($category->id)
                ->get(),
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
                'date_of_expense' => 'required|before:today',
                'cost' => 'required|integer|gt:0',
                'category_id' => ['required',
                Rule::in(Category::Visibleto()
                    ->get()
                    ->pluck('id')
                    ->toArray()
                    ),
                ],
                'bill' => 'mimes:png,jpg,jpeg,pdf'
            ]
        );

        $request->file('bill')
            ->store('/images');

        Expense::create($attributes);
         
        return to_route ('dashboard')
            ->with('success', 'Expense Added Successfully.');
    }
}
