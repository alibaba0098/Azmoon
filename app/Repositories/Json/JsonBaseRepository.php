<?php

namespace App\Repositories\Json;

use App\Repositories\Contracts\RepositoryInterface;

class JsonBaseRepository implements RepositoryInterface
{
    protected $model;

    public function create(array $data)
    {
        if (file_exists('users.json')) {
            $users = json_decode(file_get_contents('users.json'), true);
            $data['id'] = rand(1,1000);
            array_push($users, $data);
            file_put_contents('users.json', json_encode($users));
        }else{
            $users = [];
            $data['id'] = rand(1, 1000);
            array_push($users, $data);
            file_put_contents('users.json', json_encode($users));
        }
        // file_put_contents('users.json', json_encode($data));
        // return $this->model::create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->model::where('id', $id)->update($data);
    }

    public function all(array $where)
    {
        $query = $this->model::query();
        foreach ($where as $key => $value) {
            $query->where($key, $value);
        }
        return $query->get();
    }

    public function delete(array $where)
    {
        $query = $this->model::query();
        foreach ($where as $key => $value) {
            $query->where($key, $value);
        }
        return $query->delete();
    }

    public function find(int $id)
    {
        return $this->model::find($id);
    }
}
