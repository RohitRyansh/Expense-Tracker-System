<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'total_expenses',
        'comparisions'
    ];

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'name'
            ]   
        ];
    }

    public function categories() {

        return $this->hasMany(Category::class);
    }

    public function expenses() {

        return $this->hasManyThrough(Expense::class, Category::class);
    }
}