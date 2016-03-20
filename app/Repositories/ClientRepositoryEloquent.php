<?php
/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 20/03/16
 * Time: 13:53
 */

namespace Dashboard\Repositories;


use Dashboard\Entities\Client;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    public function model() {
        return Client::class;
    }
}