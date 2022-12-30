<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        // 'month_id',
    ];

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'name'
            ]   
        ];
    }
    
    public function expenses() {

        return $this->hasMany(Expense::class);
    }

    // public function scopeVisibleByMonth($query, $month) {
        
    //     $expenses = Expense::where('month_id', $month->id)->first();
    //     if($expenses){
    //         return  $query->where('id', $expenses->category_id);
    //     }
    // }

    public function scopeVisibleTo($query) {
        
        return  $query->where('created_by', Auth::id());
    }
}
