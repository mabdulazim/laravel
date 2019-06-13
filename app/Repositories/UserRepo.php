<?php 

namespace App\Repositories;

use App\Models\User;

class UserRepo extends Repository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function filter($data)
    {
        return $this->model->where('type', 'USER')
        ->when($data['search'], function($query) use($data)
        {
            $query->where('id', $data['search']);
            $query->orWhere('name', 'LIKE', '%'.$data['search'].'%');
            $query->orWhere('email', $data['search']);
            $query->orWhere('mobile', $data['search']);
        })
        ->when($data['is_blocked'], function($query) use($data)
        {
            $query->where('is_blocked', $data['is_blocked'] == "true" ? 1 : 0);
        })
        ->latest('id','desc')
        ->paginate(10);
    }

    public function userByEmail($email)
    {
        return $this->model->where('email', $email)
        ->where('type', 'USER')
        ->first();
    }

}