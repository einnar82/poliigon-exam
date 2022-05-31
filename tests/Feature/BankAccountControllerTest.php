<?php

namespace Tests\Feature;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class BankAccountControllerTest extends TestCase
{
    public function testCreateBankAccountSuccess(): void
    {
        $response = $this->createBankAccount();
        $response->assertCreated();
    }

    public function testUpdateBankAccountSuccess(): void
    {
       $response = $this->createBankAccount();
        $data = $response->json('data');
        $putResponse = $this->putJson("/api/bank-accounts/{$data['id']}", [
            'balance' => 1000
        ]);

        $putResponse->assertOk();
        $this->assertEquals(1000,$putResponse->json()['data']['balance']);
    }

    public function testGetASpecificBankAccountSuccess(): void
    {
        $response = $this->createBankAccount();
        $data = $response->json('data');
        $getResponse = $this->getJson("/api/bank-accounts/{$data['id']}");

        $getResponse->assertOk();
        $this->assertEquals($data['balance'], $getResponse->json()['data']['balance']);

    }

    public function testGetAllBankAccountsSuccess(): void
    {
        $this->createBankAccount();
        $getResponse = $this->getJson("/api/bank-accounts");
        $getResponse->assertOk();
        $this->assertCount(1, $getResponse->json('data') );
    }

    public function testDeleteBankAccountSuccess(): void
    {
        $response = $this->createBankAccount();
        $data = $response->json('data');
        $deleteResponse = $this->deleteJson("/api/bank-accounts/{$data['id']}");
        $deleteResponse->assertNoContent();
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
