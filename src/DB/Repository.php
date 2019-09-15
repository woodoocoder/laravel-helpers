<?php

namespace Woodoocoder\LaravelHelpers\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class Repository {

    protected $model;
    
    protected $user;
    
    /**
     * Repository constructor.
     * 
     * @param Model $model
     */
    public function __construct(Model $model) {
        $this->model = $model;
        $this->user = Auth::user();
    }

    /**
     * @param array $attributes
     * 
     * @return mixed
     */
    public function create(array $attributes) {
        return $this->model->create($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * 
     * @return bool
     */
    public function update(array $attributes, int $id): bool {
        return $this->find($id)->update($attributes);
    }
    
    /**
     * @param int $id
     * 
     * @return mixed
     */
    public function find(int $id) {
        return $this->model->find($id);
    }

    /**
     * @param int $perPage
     * @param string $orderBy
     * @param string $sortBy
     * 
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 20, string $orderBy = 'id', string $sortBy = 'desc') {
        return $this->model->orderBy($orderBy, $sortBy)->paginate($perPage);
    }

    /**
     * @param int $perPage
     * @param string $orderBy
     * @param string $sortBy
     * 
     * @return LengthAwarePaginator
     */
    public function paginateByUser(int $perPage = 20, string $orderBy = 'id', string $sortBy = 'desc') {
        return $this->model->where('user_id', $this->user->id)
            ->orderBy($orderBy, $sortBy)->paginate($perPage);
    }

    /**
     * @param int $id
     * 
     * @return bool
     */
    public function delete(int $id): bool {
        return $this->model->delete();
    }
}