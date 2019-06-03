<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MoneyRepository")
 */
class Money
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
<<<<<<< HEAD
    * ORM\Column(type="string")
    */
    private $name;


=======
    * @ORM\Column(type="string")
    */
    private $name;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Denom",mappedBy="money")
    * @ORM\JoinTable(name="money_denom",
    *   joinColumns={ @ORM\JoinColumn(name="money_id",referencedColumnName="id")},
    *   inverseJoinColumns={ @ORM\JoinColumn(name="denom_id",referencedColumnName="id")}
    * )
    */
    private $denoms;

    public function __construct()
    {
        $this->denoms = new ArrayCollection();
    }
>>>>>>> master

    public function getId(): ?int
    {
        return $this->id;
    }

<<<<<<< HEAD
=======
    /**
    * @param mixed $name
    */
>>>>>>> master
    public function getName()
    {
        return $this->name;
    }

<<<<<<< HEAD
    public function setName($name): void
    {
        $this->name = $name;
    }
=======


    /**
    * @param mixed $name
    */
    public function setName($name):void
    {
        $this->name = $name;
    }

    public function getDenoms()
    {
        return $this->denoms;
    }
>>>>>>> master
}
