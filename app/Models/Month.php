<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_expenses'
    ];

    public function categories() {

        return $this->hasMany(Category::class);
    }

    public function expenses() {

        return $this->hasManyThrough(Expense::class, Category::class);
    }

    // public function scopeVisibleTo($query, $month) {
        
    //     return $query->where('created_at', Category::whereMonth('created_at', '=', $month->id));
    // }
}
