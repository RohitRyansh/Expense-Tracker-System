<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'item_name',
        'category_id',
        'date_of_expense',
        'cost',
        'bill_path',
        'month_id'
    ];

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'item_name'
            ]   
        ];
    }

    public function category() {

        return $this->belongsTo(Category::class);
    }

    public function month() {

        return $this->belongsTo(Month::class);
    }

    public function scopeVisibleTo($query, $category, $month) {
                
        return  $query->where('category_id', $category->id)
            ->whereMonth('date_of_expense', $month->id);
    }

    public function scopeListingAllExpenses($query) {
        
        return  $query->orderby('date_of_expense', 'desc');
    }

    public function scopeDataFilter($query, $filter) {

        $query->when($filter['search'] ?? false, function($query, $search) {

            return $query->where('item_name', 'like', '%'. $search . '%');
        });

        $query->when($filter['this_week'] ?? false, function($query) {

            return $query->whereBetween('date_of_expense', [Carbon::now()->startOfWeek()->format("Y-m-d"), Carbon::now()]);
        });

        $query->when($filter['last_week'] ?? false, function($query) {
            
            $previous_week = strtotime("-1 week");
            $start_week = strtotime("last monday midnight", $previous_week);
            $start_week = date("Y-m-d", $start_week);

            $end_week = strtotime("next sunday", $previous_week);
            $end_week = date("Y-m-d", $end_week);

            return $query->whereBetween('date_of_expense', [$start_week, $end_week]);
        });

        $query->when($filter['this_month'] ?? false, function($query) {

            return $query->whereMonth('date_of_expense', Carbon::now()->startOfMonth()->format("m"));
        }); 

        $query->when($filter['last_month'] ?? false, function($query) {

            return $query->whereMonth('date_of_expense', Carbon::now()->subMonth()->format("m"));

        }); 
    }  

    public function scopeFilterByDate($query, $filter) {

        $query->when($filter['apply'] ?? false, function($query) use ($filter) {

            return $query->whereBetween('date_of_expense', [$filter['to'], $filter['from']]);
        }); 
    }
}
