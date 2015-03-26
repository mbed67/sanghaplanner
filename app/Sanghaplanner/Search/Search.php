<?php namespace Sanghaplanner\Search;

use Illuminate\Support\Collection;
use Sanghaplanner\Users\User;
use Sanghaplanner\Users\UserRepositoryInterface;
use Sanghaplanner\Sanghas\SanghaRepositoryInterface;

class Search
{

    /**
     * Returns a collection of users based on search criteria
     *
     * @param string $search
     * @param UserRepositoryInterface $repo
     *
     * @return Illuminate\Support\Collection
     */
    public function users($search, UserRepositoryInterface $repo)
    {
        return $repo->searchUser($search);
    }

    /**
     * Returns a collection of sanghas based on search criteria
     *
     * @param string $search
     * @param SanghaRepositoryInterface $repo
     *
     * @return Illuminate\Support\Collection
     */
    public function sanghas($search, SanghaRepositoryInterface $repo)
    {
        return $repo->searchSangha($search);
    }

    /**
     * Returns a collection of retreats based on search criteria
     *
     * @param string $search
     * @param RetreatRepositoryInterface $repo
     *
     * @return Illuminate\Support\Collection
     */
    public function retreats($search, RetreatRepositoryInterface $repo)
    {
        return $repo->searchRetreat($search);
    }
}
