<?php 

namespace App\Repositories;

use App\Models\User;

class AdminRepo extends Repository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function filter($search)
    {
        return $this->model->where('type', 'ADMIN')
        ->when($search, function($query) use($search)
        {
            $query->where('id', $search);
            $query->orWhere('name', 'LIKE', '%'.$search.'%');
            $query->orWhere('email', $search);
            $query->orWhere('mobile', $search);
        })
        ->latest('id','desc')
        ->paginate(10);
    }

}