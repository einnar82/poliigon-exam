<?php

use App\Http\Controllers\BankAccountsController;
use App\Http\Controllers\BankTransferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/bank-accounts', BankAccountsController::class);
Route::apiResource('/bank-transfers', BankTransferController::class);
Route::get('/bank-transfers/accounts/{bank_account}/sent', [BankTransferController::class, 'getSentTransferHistoryViaBankAccount']);
Route::get('/bank-transfers/accounts/{bank_account}/received', [BankTransferController::class, 'getReceivedTransferHistoryViaBankAccountId']);
Route::get('/bank-transfers/accounts/{bank_account}/all', [BankTransferController::class, 'getAllTransfersViaBankAccountId']);
