<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Payment extends Model
{
    use HasFactory, SoftDeletes;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'user_id',
        'amount',
        'transaction_id',
        'status',
        'currency',
        'payment_type',
        'payment_method',
        'payment_to',
        'payment_from',
        'payment_for',
        'expense_type',
        'remarks',
        'payment_date'
    ];



    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Uuid::uuid4();
        });
    }
}
