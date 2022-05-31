<?php
declare(strict_types=1);

namespace App\Repository\BankTransfer;

use App\Models\BankAccount;
use App\Models\BankTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

final class BankTransferRepository implements BankTransferRepositoryInterface
{
    /**
     * @throws \Exception
     */
    public function transfer(Request $request)
    {
        $transferAmount = (int)$request->amount + (int)$request->transfer_fee;
        $senderBankAccountId = $request->sender_bank_account_id;
        $receiverBankAccountId = $request->receiver_bank_account_id;

        $this->checkBalance($senderBankAccountId, $transferAmount);
        $this->beginTransaction((int)$senderBankAccountId, (int)$receiverBankAccountId, $transferAmount);

        return $this->createTransferDetails($request);
    }

    /**
     * @throws \Exception
     */
    private function checkBalance(int $bankAccountId, int $transferAmount): void
    {
        $account = BankAccount::findOrFail($bankAccountId);

        if ($account->balance >= $transferAmount) {
            return;
        }
        throw new \Exception('Not enough balance to transfer money.');
    }

    private function beginTransaction(int $senderBankAccountId, int $receiverBankAccountId, int $transferAmount): void
    {
        DB::transaction(function () use ($senderBankAccountId, $receiverBankAccountId, $transferAmount) {
            $receiverBankAccount = BankAccount::findOrFail($receiverBankAccountId);
            $receiverBankAccount->increment('balance', $transferAmount);

            $senderBankAccount = BankAccount::findOrFail($senderBankAccountId);
            $senderBankAccount->decrement('balance', $transferAmount);
        });
    }

    private function createTransferDetails(Request $request)
    {
        return BankTransfer::create($request->all());
    }

    public function getSentTransferHistoryViaBankAccountId(int $bankAccountId)
    {
        return BankAccount::findOrFail($bankAccountId)->sentTransfers;
    }

    public function getReceivedTransferHistoryViaBankAccountId(int $bankAccountId)
    {
        return BankAccount::findOrFail($bankAccountId)->receivedTransfers;
    }

    public function getAllTransfersViaBankAccountId(int $bankAccountId)
    {
        return BankTransfer::where('receiver_bank_account_id', $bankAccountId)
            ->orWhere('receiver_bank_account_id', $bankAccountId)
            ->orderBy('created_at', 'DESC')
            ->get();
    }
}
