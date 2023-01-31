<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserRepository
{
    /**
     * @var User
     */
    private User $model;

    public function __construct()
    {
        $this->model = new User;
    }

    /**
     * @param array $data
     * @return Builder|Model|User
     */
    public function register(array $data): Model|Builder|User
    {
        return $this->model
            ->query()
            ->create($data);
    }
}
