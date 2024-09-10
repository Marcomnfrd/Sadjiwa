<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'wa',
        'regency',
        'length',
        'width',
        'result',
        'status',
        'created_at',
        'updated_at',
        'provinces_id',
        'panel_id',
    ];

    public function panel()
    {
        return $this->belongsTo(Panels::class, 'panel_id');
    }

    public function provinces()
    {
        return $this->belongsTo(Provinces::class, 'provinces_id');
    }

    public function regency()
    {
        return $this->belongsTo(Regencies::class, 'regency');
    }

    public function addfee()
    {
        return $this->hasOne(AddFee::class, 'order_id');
    }
}