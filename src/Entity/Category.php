<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

   /**
     * @ORM\OneToMany(targetEntity="Beer", mappedBy="category")
     */
    private $beers;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getBeers()
    {
        return $this->beers;
    }

    public function setBeers($beers)
    {
        $this->beers = $beers;
    }

    public function __toString()
    {
        return $this->name;
    }
}
