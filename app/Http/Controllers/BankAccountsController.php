<?php

namespace App\Http\Controllers;

use App\Http\Resources\BankAccountResource;
use App\Models\BankAccount;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BankAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return BankAccountResource::collection(BankAccount::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return BankAccountResource
     */
    public function store(Request $request): BankAccountResource
    {
        return new BankAccountResource(BankAccount::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param BankAccount $bankAccount
     * @return BankAccountResource
     */
    public function show(BankAccount $bankAccount): BankAccountResource
    {
        return new BankAccountResource($bankAccount);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param BankAccount $bankAccount
     * @return BankAccountResource
     */
    public function update(Request $request, BankAccount $bankAccount): BankAccountResource
    {
        return new BankAccountResource(\tap($bankAccount)->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BankAccount $bankAccount
     * @return JsonResponse
     */
    public function destroy(BankAccount $bankAccount): JsonResponse
    {
        $bankAccount->delete();
        return response()->json([
            'message' => 'ok'
        ], 204);
    }
}
