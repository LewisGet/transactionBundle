<?php

namespace Lewis\TransactionBundle\Module;

use Doctrine\ORM\EntityManager;
use Lewis\TransactionBundle\Entity\Acc as User;

class Transaction
{
    /**
     * Property userEntity.
     *
     * @var  User
     */
    public $userEntity;

    /**
     * Property userEntity.
     *
     * @var EntityManager
     */
    public $em;

    public function __construct(User $userEntity)
    {
        $this->userEntity = $userEntity;
    }

    public function preSave($price)
    {
        return $price;
    }

    public function postSave($price)
    {
        return ;
    }

    /**
     * save
     *
     * @param $price
     *
     * @return  User
     */
    public function doSave($price)
    {
        return $this->userEntity;
    }

    /**
     * save
     *
     * @param $price
     *
     * @return  User
     */
    public function save($price)
    {
        $price = $this->preSave($price);

        $return = $this->doSave($price);

        $this->postSave($price);

        return $return;
    }
}