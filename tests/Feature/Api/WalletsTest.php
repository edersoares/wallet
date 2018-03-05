<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Wallet\User;
use Wallet\Wallet;

class WalletsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();

        $this->actingAs(factory(User::class)->create());
    }

    public function testIndex()
    {
        $numberOfRecordsToCreate = rand(2, 5);

        factory(Wallet::class, $numberOfRecordsToCreate)->create();

        $this->get('api/wallets')
            ->assertStatus(200)
            ->assertJsonCount($numberOfRecordsToCreate, 'data')
            ->assertJsonStructure([
                'success', 'message', 'data', 'meta'
            ]);
    }

    public function testCreate()
    {
        $wallet = factory(Wallet::class)->make();

        $this->post('api/wallets', $wallet->toArray())
            ->assertStatus(201)
            ->assertJsonFragment($wallet->toArray())
            ->assertJsonStructure([
                'success', 'message', 'data'
            ]);

        $this->assertDatabaseHas('wallets', $wallet->toArray());
    }

    public function testBrowse()
    {
        $wallet = factory(Wallet::class)->create();

        $this->get('api/wallets/' . $wallet->getKey())
            ->assertStatus(200)
            ->assertJsonFragment($wallet->toArray())
            ->assertJsonStructure([
                'success', 'message', 'data'
            ]);
    }

    public function testUpdate()
    {
        $wallet = factory(Wallet::class)->create();
        $walletNewData = factory(Wallet::class)->make();

        $this->put('api/wallets/' . $wallet->getKey(), $walletNewData->toArray())
            ->assertStatus(200)
            ->assertJsonFragment($walletNewData->toArray())
            ->assertJsonStructure([
                'success', 'message', 'data'
            ]);

        $this->assertDatabaseHas('wallets', $walletNewData->toArray());
    }

    public function testDelete()
    {
        $wallet = factory(Wallet::class)->create();

        $this->delete('api/wallets/' . $wallet->getKey())
            ->assertStatus(200)
            ->assertJsonFragment($wallet->toArray())
            ->assertJsonStructure([
                'success', 'message', 'data'
            ]);

        $this->assertDatabaseMissing('wallets', $wallet->toArray());
    }
}
