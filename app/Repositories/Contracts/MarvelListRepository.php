<?php

namespace App\Repositories\Contracts;


use App\Entities\MarvelList;
use App\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface MarvelListRepository
{
    /**
     * @param array $data
     *
     * @return MarvelList
     */
    public function add(array $data);

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function allForUser(User $user);

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function addItemToList(array $data);

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function find(int $id);

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function items(int $id);

    /**
     * @param int $id
     * @param UploadedFile $avatar
     *
     * @return mixed
     */
    public function updateAvatar(int $id, UploadedFile $avatar);


    /**
     * @param User $user
     * @param int  $itemId
     *
     * @return array
     */
    public function listsContainingItemByUser(User $user, int $itemId);

    /**
     * @return array
     */
    public function defaultLists();

    /**
     * @param int $itemId
     *
     * @return int
     */
    public function deleteItemFromList(int $itemId);
}
