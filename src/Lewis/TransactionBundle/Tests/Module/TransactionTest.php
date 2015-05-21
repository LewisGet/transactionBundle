<?php

namespace Lewis\TransactionBundle\Tests\Module;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Lewis\TransactionBundle\Module\Transaction;
use Lewis\TransactionBundle\Entity\Acc as User;

class TransactionTest extends WebTestCase
{
    /**
     * Property user.
     *
     * @var User
     */
    public $user;

    /**
     * Property transaction.
     *
     * @var Transaction
     */
    public $transaction;

    public function setup()
    {
        // fake user
        $this->user = new User();

        $this->user->setUsername("Lewis")
            ->setDeposit(100);

        // create transaction
        $this->transaction = new Transaction($this->user);
    }

    /**
     * 正常存錢
     *
     * @return  void
     */
    public function testSaveMoney()
    {
        $user = $this->transaction->save(100);

        $this->assertEquals($user->getDeposit(), 200);
    }

    /**
     * 負數存錢
     *
     * @return  void
     */
    public function testSaveNegativeMoney()
    {
        $errorMessage = null;

        try
        {
            $this->transaction->save(-100);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
        }

        $this->assertEquals($errorMessage, "金額錯誤(錯誤代號1)");
    }

    /**
     * 非整數存錢
     *
     * @return  void
     */
    public function testSaveNotIntMoney()
    {
        $errorMessage = null;

        try
        {
            $this->transaction->save("hello");
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
        }

        $this->assertEquals($errorMessage, "金額錯誤(錯誤代號2)");

        // clean error message
        $errorMessage = null;

        try
        {
            $this->transaction->save(3.14);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
        }

        $this->assertEquals($errorMessage, "金額錯誤(錯誤代號2)");
    }
}
