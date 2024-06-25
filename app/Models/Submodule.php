<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submodule extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function module()
    {
        return $this->belongsTo(Module::class, 'moduleid');
    }
}
