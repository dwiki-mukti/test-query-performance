<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteCount extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'password',
        'total_viewer'
    ];
}
