<?php

namespace Wallet\Http\Middleware;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $original = $response->getOriginalContent();

        if ($original instanceof LengthAwarePaginator) {
            $this->customLengthAwarePaginator($response, $original);
        } elseif ($original instanceof Model && $original->wasRecentlyCreated) {
            $this->customModelWasRecentlyCreated($response, $original);
        } elseif ($original instanceof Arrayable) {
            $this->customArrayable($response, $original);
        } elseif (is_array($original)) {
            $this->customArray($response, $original);
        }

        return $response;
    }

    /**
     * Modify the response when original response is LengthAwarePaginator.
     *
     * @param JsonResponse         $response
     * @param LengthAwarePaginator $original
     */
    protected function customLengthAwarePaginator(JsonResponse $response, LengthAwarePaginator $original)
    {
        $data = $original->getCollection()->toArray();
        $prev = $original->currentPage() - 1;
        $next = $original->currentPage() + 1;
        $total = $original->total();
        $perPage = $original->perPage();

        $prev = $prev < 1 ? null : $prev;
        $next = $next > $original->lastPage() ? null : $next;

        $pages = ceil($total / $perPage);

        $response->setData([
            'success' => true,
            'message' => 'OK',
            'data' => $data,
            'meta' => [
                'total' => $total,
                'pages' => $pages,
                'prev' => $prev,
                'next' => $next,
            ]
        ]);
    }

    /**
     * Modify the response when original response is a model was recently created.
     *
     * @param JsonResponse $response
     * @param Model        $original
     */
    protected function customModelWasRecentlyCreated(JsonResponse $response, Model $original)
    {
        $response->setStatusCode(201);
        $response->setData([
            'success' => true,
            'message' => 'Created',
            'data' => $original->toArray()
        ]);
    }

    /**
     * Modify the response when original response is Arrayable.
     *
     * @param JsonResponse $response
     * @param Arrayable    $original
     */
    protected function customArrayable(JsonResponse $response, Arrayable $original)
    {
        $response->setData([
            'success' => true,
            'message' => 'OK',
            'data' => $original->toArray()
        ]);
    }

    /**
     * Modify the response when original response is array.
     *
     * @param JsonResponse $response
     * @param array $original
     */
    protected function customArray(JsonResponse $response, array $original)
    {
        $response->setData([
            'success' => true,
            'message' => 'OK',
            'data' => $original
        ]);
    }
}
