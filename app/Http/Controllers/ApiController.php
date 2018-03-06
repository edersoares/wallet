<?php

namespace Wallet\Http\Controllers;

use Illuminate\Http\Request;
use Wallet\Support\Uuid;

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
     */
    public function create(Request $request)
    {
        $model = $this->model();

        return $model::create($request->all());
    }

    /**
     * GET /api/:endpoint/:uuid
     *
     * @param \Wallet\Support\Uuid $uuid
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function browse(Uuid $uuid)
    {
        $model = $this->model();

        return $model::findOrFail((string) $uuid);
    }

    /**
     * PUT /api/:endpoint/:uuid
     *
     * @param \Wallet\Support\Uuid     $uuid
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(Uuid $uuid, Request $request)
    {
        $model = $this->model();

        $model = $model::findOrFail((string) $uuid);

        $model->update($request->all());

        return $model;
    }

    /**
     * DELETE /api/:endpoint/:uuid
     *
     * @param \Wallet\Support\Uuid $uuid
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function delete(Uuid $uuid)
    {
        $model = $this->model();

        $model = $model::findOrFail((string) $uuid);

        $model->delete();

        return $model;
    }
}
