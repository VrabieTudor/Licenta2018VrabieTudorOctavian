<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserType\CountUserTypeRequest;
use App\Http\Requests\UserType\ExportUserTypeRequest;
use App\Http\Requests\UserType\IndexUserTypeRequest;
use App\Http\Requests\UserType\StoreUserTypeRequest;
use App\Http\Requests\UserType\UpdateUserTypeRequest;
use App\UserType;
use App\Http\Transformers\Core\Manager;
use App\Http\Transformers\UserTypeTransformer;
use App\Repositories\UserTypeRepository;
use App\Http\Transformers\Special\CountTransformer;
/**
 * @resource UserType
 *
 */
class UserTypeController extends ApiController {

    private $transformer;

    public function __construct(Manager $fractalManager, UserTypeTransformer $transformer) {
        parent::__construct($fractalManager);

        $this->transformer = $transformer;
    }

    /**
     * UserType List
     *
     * Display a listing of the resource.
     *
     * @param IndexUserTypeRequest $request
     * @param UserTypeRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function index(IndexUserTypeRequest $request, UserTypeRepository $repository) {

        if($request->has('per_page')){

            return $this->collection($repository->getPerPageFrom($request), $this->transformer);
        }
        return $this->collection($repository->getModelFrom($request)->get(), $this->transformer);
    }

    /**
     * UserType Count
     *
     * Display the count of resource.
     *
     * @param CountUserTypeRequest $request
     * @param CountTransformer $transformer
     * @param UserTypeRepository $repository
     * @param UserType $model
     * @return \Illuminate\Http\Response
     */
    public function count(CountUserTypeRequest $request, CountTransformer $transformer, UserTypeRepository $repository, UserType $model) {

        return $this->getEntityCount($request, $model, $repository, $transformer);
    }

    /**
     * UserType Create
     *
     * Store a newly created resource in storage.
     *
     * @param  StoreUserTypeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserTypeRequest $request) {
		$data = $request->only([
			"name",
		]);
        $userType = UserType::create($data);
        return $this->item($userType, $this->transformer);
    }

    /**
     * UserType Show
     *
     * Display the specified resource.
     *
     * @param UserType $userType
     * @return \Illuminate\Http\Response
     */
    public function show(UserType $userType) {
        return $this->item($userType, $this->transformer);
    }

    /**
     * UserType Update
     *
     * Update the specified resource in storage.
     *
     * @param  UpdateUserTypeRequest $request
     * @param UserType $userType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserTypeRequest $request, UserType $userType) {
		if($request->has("name")) {
			$userType->name = $request->input("name");
		}

        $userType->save();


        return $this->item($userType, $this->transformer);
    }

    /**
     * UserType Delete
     *
     * Remove the specified resource from storage.
     *
     * @param UserType $userType
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserType $userType) {
        $userType->delete();

        return $this->item($userType, $this->transformer);
    }
}
