<?php namespace App\Http\Controllers;

use App\Http\Transformers\Core\Manager;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use League\Fractal\TransformerAbstract;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiController extends Controller {
    protected $fractalManager;

    public function __construct(Manager $fractalManager) {
        $this->fractalManager = $fractalManager;
    }

    public function collection($data, TransformerAbstract $transformer) {
        if(is_object($data) && $data instanceof LengthAwarePaginator) {
            return $this->pagedCollection($data, [
                'current' => $data->currentPage(),
                'totalItems' => $data->total(),
                'pagination' => [
                    'size' => 3
                ],
                'limit' => request('limit')
            ], $transformer);
        }

        return $this->fractalManager->respondCollection($data, $transformer, Response::HTTP_OK);
    }

    public function pagedCollection($data, $pager, TransformerAbstract $transformer) {
        return $this->fractalManager->respondPagedCollection($data, $pager, $transformer, Response::HTTP_OK);
    }

    public function item($data, TransformerAbstract $transformer) {
        if(!$data) {
            throw new NotFoundHttpException('Entity not found');
        }

        return $this->fractalManager->respondItem($data, $transformer, Response::HTTP_OK);
    }

    public function rawErrors($errors, $code) {
        return response()->json([
            "errors" => $errors,
            "data" => null,
            "status" => $code,
            "statusText" => Response::$statusTexts[$code]
        ], $code);
    }
    public function rawItem($data, $code = 200) {
        return response()->json([
            "errors" => null,
            "data" => $data,
            "status" => $code,
            "statusText" => Response::$statusTexts[$code]
        ], $code);
    }

    public function error($errorMessage) {
        return $this->rawErrors([
            "general" => [
                $errorMessage
            ]
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function unauthorized($errorMessage) {
        return $this->rawErrors([
            "general" => [
                $errorMessage
            ]
        ], Response::HTTP_UNAUTHORIZED);
    }

    protected function getEntityCount($request, $model, $repository, $transformer) {
        if($request->has('field')) {
            $field = $request->input('field');
            return $this->checkColumn($request, $model, $repository, $transformer, $field);
        }
        return $this->item(['value' => 'all', 'count' => $repository->getCountFrom($request)], $transformer);
    }
}