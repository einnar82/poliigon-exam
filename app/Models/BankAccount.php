<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sentTransfers(): HasMany
    {
        return $this->hasMany(BankTransfer::class, 'sender_bank_account_id');
    }

    public function receivedTransfers(): HasMany
    {
        return $this->hasMany(BankTransfer::class, 'receiver_bank_account_id');
    }
}
