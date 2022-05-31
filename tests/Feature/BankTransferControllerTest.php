<?php
declare(strict_types=1);

namespace Tests\Feature;

use Database\Factories\UserFactory;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

final class BankTransferControllerTest extends TestCase
{
    public function testIfCanTransferSuccess(): void
    {
        $sender = $this->createBankAccount();
        $receiver = $this->createBankAccount();

        $response = $this->postJson('/api/bank-transfers', [
            'sender_bank_account_id' => $sender->json('data')['id'],
            'receiver_bank_account_id' => $receiver->json('data')['id'],
            'sender_id' => $sender->json('data')['user']['id'],
            'receiver_id' => $receiver->json('data')['user']['id'],
            'amount' => 10,
            'transfer_fee' => 5,
            'purpose' => 'payment',
        ]);

        $response->assertCreated();
        $this->assertEquals($sender->json('data')['id'], $response->json('data')['id']);
    }

    public function testIfCanGetAllSentTransfers(): void
    {
        $sender = $this->createBankAccount();
        $receiver = $this->createBankAccount();

         $this->postJson('/api/bank-transfers', [
            'sender_bank_account_id' => $sender->json('data')['id'],
            'receiver_bank_account_id' => $receiver->json('data')['id'],
            'sender_id' => $sender->json('data')['user']['id'],
            'receiver_id' => $receiver->json('data')['user']['id'],
            'amount' => 10,
            'transfer_fee' => 5,
            'purpose' => 'payment',
        ]);

        $response = $this->getJson("/api/bank-transfers/accounts/{$sender->json('data')['id']}/sent");

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
    }

    public function testIfCanGetAllReceivedTransfers(): void
    {
        $sender = $this->createBankAccount();
        $receiver = $this->createBankAccount();

        $this->postJson('/api/bank-transfers', [
            'sender_bank_account_id' => $sender->json('data')['id'],
            'receiver_bank_account_id' => $receiver->json('data')['id'],
            'sender_id' => $sender->json('data')['user']['id'],
            'receiver_id' => $receiver->json('data')['user']['id'],
            'amount' => 10,
            'transfer_fee' => 5,
            'purpose' => 'payment',
        ]);

        $response = $this->getJson("/api/bank-transfers/accounts/{$receiver->json('data')['id']}/received");

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
    }

    public function testIfCanGetAllTransfers(): void
    {
        $sender = $this->createBankAccount();
        $receiver = $this->createBankAccount();

        $this->postJson('/api/bank-transfers', [
            'sender_bank_account_id' => $sender->json('data')['id'],
            'receiver_bank_account_id' => $receiver->json('data')['id'],
            'sender_id' => $sender->json('data')['user']['id'],
            'receiver_id' => $receiver->json('data')['user']['id'],
            'amount' => 10,
            'transfer_fee' => 5,
            'purpose' => 'payment',
        ]);

        $this->postJson('/api/bank-transfers', [
            'sender_bank_account_id' => $sender->json('data')['id'],
            'receiver_bank_account_id' => $receiver->json('data')['id'],
            'sender_id' => $sender->json('data')['user']['id'],
            'receiver_id' => $receiver->json('data')['user']['id'],
            'amount' => 10,
            'transfer_fee' => 5,
            'purpose' => 'payment',
        ]);

        $response = $this->getJson("/api/bank-transfers/accounts/{$receiver->json('data')['id']}/all");

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    private function createBankAccount(): TestResponse
    {
        $user = UserFactory::new()->create();
        $response = $this->postJson('/api/bank-accounts', [
            'user_id' => $user->id,
            'balance' => 100
        ]);

        return $response;
    }
}
