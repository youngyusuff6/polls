<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $table = 'party';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'party_id', 'party_name',
    ];
}
