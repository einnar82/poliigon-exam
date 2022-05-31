<?php

namespace App\Http\Controllers;

use App\Http\Resources\BankTransferResource;
use App\Models\BankAccount;
use App\Models\BankTransfer;
use App\Repository\BankTransfer\BankTransferRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BankTransferController extends Controller
{
    public function __construct(private BankTransferRepositoryInterface $bankTransferRepository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return BankTransferResource::collection(BankTransfer::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $bankTransfer = $this->bankTransferRepository->transfer($request);
        return new BankTransferResource($bankTransfer);
    }

    /**
     * Display the specified resource.
     *
     * @param BankTransfer $bankTransfer
     * @return BankTransferResource
     */
    public function show(BankTransfer $bankTransfer): BankTransferResource
    {
        return new BankTransferResource($bankTransfer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BankTransfer $bankTransfer
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BankTransfer $bankTransfer)
    {
        $bankTransfer->delete();
        return response()->json([
           'message' => 'ok'
        ], 204);
    }

    public function getSentTransferHistoryViaBankAccount(int $bankAccountId)
    {
        return $this->bankTransferRepository->getSentTransferHistoryViaBankAccountId($bankAccountId);
    }

    public function getReceivedTransferHistoryViaBankAccountId(int $bankAccountId)
    {
        return $this->bankTransferRepository->getReceivedTransferHistoryViaBankAccountId($bankAccountId);
    }

    public function getAllTransfersViaBankAccountId(int $bankAccountId)
    {
        return $this->bankTransferRepository->getAllTransfersViaBankAccountId($bankAccountId);
    }
}
