<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    function user(){
        return $this->belongsTo('App\Models\User');
    }
    protected $fillable=[
        'task',
        'priority',
        'due_date',
    ]; 

    use HasFactory;
}
