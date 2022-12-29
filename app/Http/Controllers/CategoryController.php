<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Month;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index(Month $month) {

            return view ('category.index', [
            'categories' => Category::with('expenses')
            ->VisibleByMonth($month)
            ->get(),
            'month' => $month
        ]);
    } 
    
    public function create() {

        return view ('category.create');
    }

    public function store(Request $request) {
        
        $attributes = $request->validate ([
            'name' => 'required|string|min:3|max:255',
        ]);
        
        $attributes += [
            'month_id' => Carbon::parse(now())->format('m')
        ];

        Category::create($attributes);
        
        return back()->with('success', 'Category Created Successfully.');
    }

    public function edit(Month $month, Category $category) {
        
        return view ('category.edit', [
            'category' => $category,
            'month' => $month
        ]);
    }

    public function update(Request  $request, Month $month, Category $category) {
        
        $attributes = $request->validate ([
            'name' => ['required','string','min:3','max:255'],
        ]);
        
        $category->update($attributes);

        return to_route('categories.month', $month)
            ->with('success', 'Category Updated Successfully.');
    }
}
