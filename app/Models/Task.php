<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'end_date', 'status'];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
