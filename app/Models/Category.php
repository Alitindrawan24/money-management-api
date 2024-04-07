<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "name",
        "type",
        "status",
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function scopeOwned(Builder $builder)
    {
        return $builder->where("user_id", auth()->user()->id);
    }
}
