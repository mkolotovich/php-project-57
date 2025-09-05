<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    protected $fillable = ['name', 'description', 'status_id', 'created_by_id', 'assigned_to_id'];

    public function status(): HasOne
    {
        return $this->hasOne(TaskStatus::class);
    }

    public function author(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function executor(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class);
    }
}
