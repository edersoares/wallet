<?php

namespace Wallet\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

abstract class ApiController extends Controller
{
    /**
     * Return the model name.
     *
     * @return string
     */
    abstract public function model();

    /**
     * GET /api/:endpoint
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        $model = $this->model();

        return $model::paginate();
    }

    /**
     * POST /api/:endpoint
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Throwable
     */
    public function create(Request $request)
    {
        $model = $this->model();

        return $model::create($request->all());
    }

    /**
     * GET /api/:endpoint/:uuid
     *
     * @param \Ramsey\Uuid\Uuid $uuid
     *
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Throwable
     */
    public function browse(Uuid $uuid)
    {
        $model = $this->model();

        return $model::findOrFail((string) $uuid);
    }

    /**
     * PUT /api/:endpoint/:uuid
     *
     * @param \Ramsey\Uuid\Uuid   $uuid
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Throwable
     */
    public function update(Uuid $uuid, Request $request)
    {
        $model = $this->browse($uuid);

        $model->fill($request->all());
        $model->saveOrFail();

        return $model;
    }

    /**
     * DELETE /api/:endpoint/:uuid
     *
     * @param \Ramsey\Uuid\Uuid $uuid
     *
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Throwable
     */
    public function delete(Uuid $uuid)
    {
        $model = $this->browse($uuid);

        $model->delete();

        return $model;
    }
}
