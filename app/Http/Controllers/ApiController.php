<?php

namespace Wallet\Http\Controllers;

use Illuminate\Support\Facades\Input;

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
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create()
    {
        $model = $this->model();

        return $model::create(Input::all());
    }

    /**
     * GET /api/:endpoint/:uuid
     *
     * @param string $uuid
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function browse($uuid)
    {
        $model = $this->model();

        return $model::findOrFail($uuid);
    }

    /**
     * PUT /api/:endpoint/:uuid
     *
     * @param string $uuid
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($uuid)
    {
        $model = $this->model();

        $model = $model::findOrFail($uuid);

        $model->update(Input::all());

        return $model;
    }

    /**
     * DELETE /api/:endpoint/:uuid
     *
     * @param string $uuid
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function delete($uuid)
    {
        $model = $this->model();

        $model = $model::findOrFail($uuid);

        $model->delete();

        return $model;
    }
}
