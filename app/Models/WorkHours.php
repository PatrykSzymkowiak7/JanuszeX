<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHours extends Model
{
    use HasFactory;
    protected $table = "WorkHours";

    protected $fillable = [
        'employee_id',
        'name',
        'date',
        'przepracowanwork_hourse_godziny'
    ];
}
