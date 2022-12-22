<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = [
        'item_name',
        'category_id',
        'date_of_expense',
        'cost',
        'bill',
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

    public function scopeVisibleTo($query, $category) {
        
        return  $query->where('category_id', $category);
    }
    
}
