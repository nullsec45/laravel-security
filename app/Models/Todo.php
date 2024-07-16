<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use softDeletes;

    protected $table="todos";

    public function user():BelongsTo{
        return $this->belongsTo(User::class, "user_id","id","users");
    }
}
