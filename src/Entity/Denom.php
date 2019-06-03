<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    * @ORM\Column(type="decimal")
    */
    private $value;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Money",inversedBy="denoms")
    */
    private $money;

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
    public function getName($name):void
    {
        $this->name = $name;
    }

    /**
    * @param decimal $value
    */
    public function getValue($value):void
    {
        $this->value = $value;
    }
}
