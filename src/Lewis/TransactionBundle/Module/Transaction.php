<?php

namespace Lewis\TransactionBundle\Module;

use Doctrine\ORM\EntityManager;
use Lewis\TransactionBundle\Entity\Acc as User;
use Symfony\Component\Security\Acl\Exception\Exception;

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
     * doSave
     *
     * @param $price
     *
     * @return  User
     *
     * @throws \Exception
     */
    public function doSave($price)
    {
        if (! is_integer($price))
            throw new \Exception("金額錯誤(錯誤代號2)");

        if (0 > $price)
            throw new \Exception("金額錯誤(錯誤代號1)");

        try
        {
            $deposit = $this->userEntity->getDeposit();

            $this->userEntity->setDeposit($deposit + $price);
        } catch (Exception $e) {
            throw new \Exception("帳戶錯誤(錯誤代碼{$e->getMessage()})");
        }

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