<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CountUserRequest;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\FlightService;
use App\User;
use App\Http\Transformers\Core\Manager;
use App\Http\Transformers\UserTransformer;
use App\Repositories\UserRepository;
use App\Http\Transformers\Special\CountTransformer;
use Illuminate\Support\Facades\Auth;

/**
 * @resource User
 *
 */
class UserController extends ApiController {

    private $transformer;

    public function __construct(Manager $fractalManager, UserTransformer $transformer) {
        parent::__construct($fractalManager);

        $this->transformer = $transformer;
    }

    /**
     * User List
     *
     * Display a listing of the resource.
     *
     * @param IndexUserRequest $request
     * @param UserRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function index(IndexUserRequest $request, UserRepository $repository) {
        if($request->has('per_page')){

            return $this->collection($repository->getPerPageFrom($request), $this->transformer);
        }
        return $this->collection($repository->getModelFrom($request)->get(), $this->transformer);
    }

    /**
     * User Count
     *
     * Display the count of resource.
     *
     * @param CountUserRequest $request
     * @param CountTransformer $transformer
     * @param UserRepository $repository
     * @param User $model
     * @return \Illuminate\Http\Response
     */
    public function count(CountUserRequest $request, CountTransformer $transformer, UserRepository $repository, User $model) {

        return $this->getEntityCount($request, $model, $repository, $transformer);
    }

    /**
     * User Show
     *
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        return $this->item($user, $this->transformer);
    }

    public function me() {
        if(Auth::check()) {
            return $this->item(Auth::user(), $this->transformer);
        }
        return $this->error('Unauthenticated.');
    }

    /**
     * User Update
     *
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user) {
		if($request->has("name")) {
			$user->name = $request->input("name");
		}

        if($request->has("password")) {
            $user->password = bcrypt($request->input("password"));
        }

		if($request->has("email")) {
			$user->email = $request->input("email");
		}

        if($request->has("user_type_id")) {
            $user->user_type_id = $request->input("user_type_id");
        }

        $user->save();

		if($request->has("images")) {
			$user->files()->sync($request->input("images"));
		}

        return $this->item($user, $this->transformer);
    }

    /**
     * User Delete
     *
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        $user->delete();

        return $this->item($user, $this->transformer);
    }
}
