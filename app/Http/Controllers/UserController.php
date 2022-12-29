<?php

namespace App\Http\Controllers;

use App\Models\Month;

class UserController extends Controller
{
    public function index() {

        $j = 0;
        $comparisions = [];

        $months = Month::with('categories','expenses')
            ->get();

            for ($i= 0; $i < $months->count() ; $i++) {

                if ($i == 0) {
                    $comparisions[] += 0;
                    continue;
                }
                
                $previous_month =  $months[$j];
                $current_month =  $months[$i];
                $j++;
                
                if ($current_month->total_expenses == 0) {
                    
                    $comparisions[] = $current_month->total_expenses;
                    continue;
                }
                
                $comparisions[] = ($current_month->total_expenses
                    - $previous_month->total_expenses)
                    / $current_month->total_expenses * 100;    
            }

        for ($i = 0; $i < $months->count(); $i++) {

            $months[$i]->update([
                'total_expenses' => $months[$i]->expenses->sum('cost'),
                'comparisions' => $comparisions[$i]
            ]);
        }

        return view ('user.dashboard',[
            'months' => $months,
        ]);
    }
}
