<?php

namespace Tests;

use Wallet\User;

trait ApiTestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->actingAs(factory(User::class)->create());
    }

    /**
     * Return the model name.
     *
     * @return string
     */
    protected function model()
    {
        return '';
    }

    /**
     * Return the endpoint to model.
     *
     * @param null|string $uuid
     *
     * @return string
     */
    protected function endpoint($uuid = null)
    {
        $endpoint = 'api/' . $this->table();

        if (is_null($uuid)) {
            return $endpoint;
        }

        return $endpoint . '/' . $uuid;
    }

    /**
     * Return the table name to check if record was created, updated or deleted.
     *
     * @return string
     */
    protected function table()
    {
        $model = $this->model();

        $model = new $model;

        return $model->getTable();
    }

    /**
     * GET /api/:endpoint
     *
     * @return void
     */
    public function testIndex()
    {
        $numberOfRecordsToCreate = rand(2, 5);

        factory($this->model(), $numberOfRecordsToCreate)->create();

        $endpoint = $this->endpoint();

        $this->get($endpoint)
            ->assertStatus(200)
            ->assertJsonCount($numberOfRecordsToCreate, 'data')
            ->assertJsonStructure([
                'success', 'message', 'data', 'meta'
            ]);
    }

    /**
     * POST /api/:endpoint
     *
     * @return void
     */
    public function testCreate()
    {
        $wallet = factory($this->model())->make();

        $endpoint = $this->endpoint();

        $this->post($endpoint, $wallet->toArray())
            ->assertStatus(201)
            ->assertJsonFragment($wallet->toArray())
            ->assertJsonStructure([
                'success', 'message', 'data'
            ]);

        $this->assertDatabaseHas('wallets', $wallet->toArray());
    }

    /**
     * GET /api/:endpoint/:uuid
     *
     * @return void
     */
    public function testBrowse()
    {
        $wallet = factory($this->model())->create();

        $endpoint = $this->endpoint($wallet->getKey());

        $this->get($endpoint)
            ->assertStatus(200)
            ->assertJsonFragment($wallet->toArray())
            ->assertJsonStructure([
                'success', 'message', 'data'
            ]);
    }

    /**
     * PUT /api/:endpoint/:uuid
     *
     * @return void
     */
    public function testUpdate()
    {
        $wallet = factory($this->model())->create();
        $walletNewData = factory($this->model())->make();

        $endpoint = $this->endpoint($wallet->getKey());

        $this->put($endpoint, $walletNewData->toArray())
            ->assertStatus(200)
            ->assertJsonFragment($walletNewData->toArray())
            ->assertJsonStructure([
                'success', 'message', 'data'
            ]);

        $this->assertDatabaseHas('wallets', $walletNewData->toArray());
    }

    /**
     * DELETE /api/:endpoint/:uuid
     *
     * @return void
     */
    public function testDelete()
    {
        $wallet = factory($this->model())->create();

        $endpoint = $this->endpoint($wallet->getKey());

        $this->delete($endpoint)
            ->assertStatus(200)
            ->assertJsonFragment($wallet->toArray())
            ->assertJsonStructure([
                'success', 'message', 'data'
            ]);

        $this->assertDatabaseMissing('wallets', $wallet->toArray());
    }
}
