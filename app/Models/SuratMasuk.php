<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';
    protected $guarded = [
        'id'
    ];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function getPerihalLimitedAttribute()
    {
        $perihal = $this->attributes['perihal'];
        $words = str_word_count($perihal, 2);

        if (count($words) > 15) {
            $words = array_slice($words, 0, 15);
            $perihal = implode(' ', $words) . '...';
        }

        return $perihal;
    }
}
