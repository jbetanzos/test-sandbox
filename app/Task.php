<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public const PENDING = 'PEND';
    public const DONE = 'DONE';
    public const DELETED = 'DROP';

    protected $fillable = ['description', 'body'];

}
