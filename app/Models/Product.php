<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperProduct
 */
class Product extends Model
{

    public const FREQUENCY_DAILY = 'day';
    public const FREQUENCY_WEEKLY = 'week';
    public const FREQUENCY_MONTHLY = 'month';

    public const arrayFrequencies = [
        self::FREQUENCY_DAILY => 'Tous les jours',
        self::FREQUENCY_WEEKLY => 'Toutes les semaines',
        self::FREQUENCY_MONTHLY => 'Tous les mois'
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'url',
        'old_price',
        'discount',
        'frequency',
        'is_active',
        'is_ended',
        'user_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_ended' => 'boolean',
        'old_price' => 'decimal:2',
        'discount' => 'decimal:2',
        'price' => 'decimal:2',
        'frequency' => 'string',
        'description' => 'string',
    ];

    public static function booted(): void
    {
        static::creating(function (Product $product) {
            $product->id = Str::uuid();
            $product->is_active = true;
            $product->is_ended = false;
            $product->updated_at = now();
            $product->created_at = now();
        });
    }

    public function handleDiscount(): void
    {
        if ($this->old_price > 0 && $this->price < $this->old_price) {
            $this->discount = round((($this->old_price - $this->price) / $this->old_price) * 100, 2);
        } else {
            $this->discount = 0;
        }
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
