<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpensesListingController extends Controller
{
    public function index() {

        return view ('user.listing', [
            'expenses' => Expense::ListingAllExpenses()
            ->DataFilter (
                request ([
                    'this_week',
                    'last_week',
                    'this_month',
                    'last_month',
                ]))
            ->simplePaginate(5)
        ]);
    }

    public function filterByDate(Request $request) {

        $request->validate ([
            'to' => 'required|before:tomorrow',
            'from' => 'required|after:to'
        ]);

        return view ('user.listing', [
            'expenses' => Expense::ListingAllExpenses()
            ->FilterByDate (
                request ([
                    'to',
                    'from',
                    'apply'
                ]))
            ->simplePaginate(5)
        ]);
    }
}