<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
}
