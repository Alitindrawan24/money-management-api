<?php

namespace App\Models;

use App\Models\Scopes\OwnedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "date",
        "amount",
        "description",
    ];

    protected static function booted(): void
    {
        // static::addGlobalScope(new OwnedScope);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, "transaction_tags");
    }

    public function scopeOwned(Builder $builder)
    {
        return $builder->where("user_id", auth()->user()->id);
    }
}
