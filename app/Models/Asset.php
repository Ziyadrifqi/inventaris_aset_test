<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public const STATUSES = ['tersedia', 'dipinjam', 'rusak'];

    protected $fillable = ['kode', 'nama', 'category_id', 'lokasi', 'status', 'tanggal_beli', 'nilai'];

    protected $casts = ['tanggal_beli' => 'date'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['q'] ?? null, fn($q, $s) => $q->where(
                fn($w) => $w->where('nama', 'like', "%{$s}%")->orWhere('kode', 'like', "%{$s}%")
            ))
            ->when($filters['category_id'] ?? null, fn($q, $v) => $q->where('category_id', $v))
            ->when($filters['status'] ?? null, fn($q, $v) => $q->where('status', $v));
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'tersedia' => 'success',
            'dipinjam' => 'warning',
            'rusak'    => 'danger',
            default    => 'secondary',
        };
    }
    public static function nextKode(): string
    {
        $last = static::where('kode', 'like', 'AST-%')
            ->orderByRaw('CAST(SUBSTRING(kode, 5) AS UNSIGNED) DESC')
            ->value('kode');

        $number = $last ? ((int) substr($last, 4)) + 1 : 1;

        return 'AST-' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
