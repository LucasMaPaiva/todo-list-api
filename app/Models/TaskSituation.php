<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskSituation extends Model
{
    use HasFactory;

    public mixed $name;

    protected $table = 'task_situation';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;
}
