<?php

namespace App\Http\Controllers;

use App\Models\Month;

class UserController extends Controller
{
    public function index() {

        $j=0;
        $comparisions = [];

        $months = Month::with('categories','expenses')
            ->orderby('id','desc')
            ->get();

            for ($i= 1; $i <= $months->count(); $i++) {

                if ($i == 12) {

                    if ($months[$j]->total_expenses == 0) {
                        $comparisions[] += 0;
                    }
                    else {
                        $comparisions[] += 100;
                    }
                    break;
                }

                $current_month =  $months[$j];
                $previous_month =  $months[$i];
                $j++;
                
                if ($current_month->total_expenses == 0) {
                    
                    $comparisions[] = $current_month->total_expenses;
                    continue;
                }
                
                $comparisions[] = ($current_month->total_expenses
                    - $previous_month->total_expenses)
                    / $current_month->total_expenses * 100;    
            }

        for ($i = 0; $i <= $months->count()-1; $i++) {

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
