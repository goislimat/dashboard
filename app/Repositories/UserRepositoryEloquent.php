<?php
/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 20/03/16
 * Time: 13:53
 */

namespace Dashboard\Repositories;


use Dashboard\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function model() {
        return User::class;
    }

    /**
     * @return mixed
     */
//    public function presenter()
//    {
//        return ClientPresenter::class;
//    }
}