<?php
declare(strict_types=1);

namespace App\Repository\BankTransfer;

use Illuminate\Http\Request;

interface BankTransferRepositoryInterface
{
    public function transfer(Request $request);

    public function getSentTransferHistoryViaBankAccountId(int $bankAccountId);

    public function getReceivedTransferHistoryViaBankAccountId(int $bankAccountId);

    public function getAllTransfersViaBankAccountId(int $bankAccountId);
}
