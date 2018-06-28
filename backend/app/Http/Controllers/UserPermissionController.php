<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPermission\CountUserPermissionRequest;
use App\Http\Requests\UserPermission\ExportUserPermissionRequest;
use App\Http\Requests\UserPermission\IndexUserPermissionRequest;
use App\Http\Requests\UserPermission\StoreUserPermissionRequest;
use App\Http\Requests\UserPermission\UpdateUserPermissionRequest;
use App\UserPermission;
use App\Http\Transformers\Core\Manager;
use App\Http\Transformers\UserPermissionTransformer;
use App\Repositories\UserPermissionRepository;
use App\Http\Transformers\Special\CountTransformer;

/**
 * @resource UserPermission
 *
 */
class UserPermissionController extends ApiController {

    private $transformer;

    public function __construct(Manager $fractalManager, UserPermissionTransformer $transformer) {
        parent::__construct($fractalManager);

        $this->transformer = $transformer;
    }

    /**
     * UserPermission List
     *
     * Display a listing of the resource.
     *
     * @param IndexUserPermissionRequest $request
     * @param UserPermissionRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function index(IndexUserPermissionRequest $request, UserPermissionRepository $repository) {

        if($request->has('per_page')){

            return $this->collection($repository->getPerPageFrom($request), $this->transformer);
        }
        return $this->collection($repository->getModelFrom($request)->get(), $this->transformer);
    }

    /**
     * UserPermission Count
     *
     * Display the count of resource.
     *
     * @param CountUserPermissionRequest $request
     * @param CountTransformer $transformer
     * @param UserPermissionRepository $repository
     * @param UserPermission $model
     * @return \Illuminate\Http\Response
     */
    public function count(CountUserPermissionRequest $request, CountTransformer $transformer, UserPermissionRepository $repository, UserPermission $model) {

        return $this->getEntityCount($request, $model, $repository, $transformer);
    }
    /**
     * UserPermission Show
     *
     * Display the specified resource.
     *
     * @param UserPermission $userPermission
     * @return \Illuminate\Http\Response
     */
    public function show(UserPermission $userPermission) {
        return $this->item($userPermission, $this->transformer);
    }

    /**
     * UserPermission Update
     *
     * Update the specified resource in storage.
     *
     * @param  UpdateUserPermissionRequest $request
     * @param UserPermission $userPermission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPermissionRequest $request, UserPermission $userPermission) {
		if($request->has("entity")) {
			$userPermission->entity = $request->input("entity");
		}

		if($request->has("label")) {
			$userPermission->label = $request->input("label");
		}

		if($request->has("user_type_id")) {
			$userPermission->user_type_id = $request->input("user_type_id");
		}

        $userPermission->save();


        return $this->item($userPermission, $this->transformer);
    }

    /**
     * UserPermission Delete
     *
     * Remove the specified resource from storage.
     *
     * @param UserPermission $userPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPermission $userPermission) {
        $userPermission->delete();

        return $this->item($userPermission, $this->transformer);
    }
}
