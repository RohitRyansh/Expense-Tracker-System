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

            $category = Category::create($attributes);
        
        if ($request['create'] == 'create') {  

            return to_route('categories.edit', $category)
                ->with('success',  'Category Created Successfully.');
        }

        return back()->with('success', 'Category Created Successfully.');
    }

    public function edit(Category $category) {
        
        return view ('category.edit', [
            'category' => $category
        ]);
    }

    public function update(Request  $request, Category $category) {
        
        $attributes = $request->validate ([
            'name' => ['required','string','min:3','max:255'],
        ]);
        
        $category->update($attributes);

        return to_route('categories')
            ->with('success', 'Category Updated Successfully.');
    }
}