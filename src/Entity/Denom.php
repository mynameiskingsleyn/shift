<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DenomRepository")
 */
class Denom
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @ORM\Column(type="string")
    */
    private $name;

    /**
    * @ORM\Column(type="decimal",precision=10,scale=2)
    */
    private $value;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Money",inversedBy="denoms")
    */
    private $money;

    public function __construct()
    {
        $this->money = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
    * @param mixed $name
    */
    public function setName($name):void
    {
        $this->name = $name;
    }

    /**
    * @param  decimal $value
    */
    public function setValue($value):void
    {
        $this->value = $value;
    }

    /**
    * @param mixed $name
    */
    public function getName()
    {
        return $this->name;
    }

    /**
    * @param decimal $value
    */
    public function getValue()
    {
        return $this->value;
    }

    public function getMoney()
    {
        return $this->money;
    }
}
