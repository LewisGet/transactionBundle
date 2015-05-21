<?php

namespace Lewis\TransactionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acc
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Acc
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="deposit", type="integer")
     */
    private $deposit;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Acc
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set deposit
     *
     * @param integer $deposit
     * @return Acc
     */
    public function setDeposit($deposit)
    {
        $this->deposit = $deposit;

        return $this;
    }

    /**
     * Get deposit
     *
     * @return integer
     */
    public function getDeposit()
    {
        return $this->deposit;
    }
}
