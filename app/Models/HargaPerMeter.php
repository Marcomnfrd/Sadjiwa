<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaPerMeter extends Model
{
    use HasFactory;

    protected $table = 'panel';

    protected $fillable = [
        'jenis',
        'harga',
        'kategori_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
