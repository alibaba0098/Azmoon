<?php

namespace App\Repositories\Json;

use App\Repositories\Contracts\RepositoryInterface;

use function PHPUnit\Framework\fileExists;

class JsonBaseRepository implements RepositoryInterface
{
    protected $model;

    public function create(array $data)
    {
        if (file_exists('users.json')) {
            $users = json_decode(file_get_contents('users.json'), true);
            $data['id'] = rand(1, 1000);
            array_push($users, $data);
            file_put_contents('users.json', json_encode($users));
        } else {
            $users = [];
            $data['id'] = rand(1, 1000);
            array_push($users, $data);
            file_put_contents('users.json', json_encode($users));
        }
    }

    public function update(int $id, array $data)
    {
        if (file_exists('users.json')) {
            $users = json_decode(file_get_contents('users.json'), true);
            foreach ($users as $key => $user) {
                if ($user['id'] == $id) {
                    $user['full_name'] = $data['full_name'] ?? $user['full_name'];
                    $user['email'] = $data['email'] ?? $user['email'];
                    $user['mobile'] = $data['mobile'] ?? $user['mobile'];
                    $user['password'] = $data['password'] ?? $user['password'];

                    unset($users[$key]);
                    array_push($users, $user);

                    unlink('users.json');
                    file_put_contents('users.json', json_encode($users));
                    break;
                }
            }
        }
    }

    public function all(array $where)
    {
        //
    }

    public function delete(int $id)
    {
        if (file_exists('users.json')) {
            $users = json_decode(file_get_contents('users.json'), true);
            foreach ($users as $key => $user) {
                if ($user['id'] == $id) {
                    unset($users[$key]);
                    unlink('users.json');
                    file_put_contents('users.json', json_encode($users));
                    break;
                }
            }
        }
    }



    public function find(int $id)
    {
        return $this->model::find($id);
    }

    public function deleteBy(array $where)
    {
        //   
    }
}
