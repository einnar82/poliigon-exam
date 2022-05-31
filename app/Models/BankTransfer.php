<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankTransfer extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function senderBankAccount(): BelongsTo
    {
        return $this->belongsTo(BankAccount::class, 'sender_bank_account_id');
    }

    public function receiverBankAccount(): BelongsTo
    {
        return $this->belongsTo(BankAccount::class, 'receiver_bank_account_id');
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
