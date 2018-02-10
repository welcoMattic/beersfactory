<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BeerRepository")
 */
class Beer
{
    const ONLINE_STATUS = 1;
    const OFFLINE_STATUS = 2;

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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $abv;

    /**
     * @ORM\Column(type="integer")
     */
    private $ibu;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isOrganic;

    /**
     * @ORM\Column(type="string")
     */
    private $labelThumbnail;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="beers")
     */
    private $category;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status = self::ONLINE_STATUS;

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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getAbv()
    {
        return $this->abv;
    }

    public function setAbv($abv)
    {
        $this->abv = $abv;
    }

    public function getIbu()
    {
        return $this->ibu;
    }

    public function setIbu($ibu)
    {
        $this->ibu = $ibu;
    }

    public function getIsOrganic()
    {
        return $this->isOrganic;
    }

    public function setIsOrganic($isOrganic)
    {
        $this->isOrganic = $isOrganic;
    }

    public function getLabelThumbnail()
    {
        return $this->labelThumbnail;
    }

    public function setLabelThumbnail($labelThumbnail)
    {
        $this->labelThumbnail = $labelThumbnail;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    static function createFromPayload(array $payload)
    {
        $beer = new self();

        $beer->setDescription($payload['description']);
        if (array_key_exists('ibu', $payload)) {
            $beer->setIbu($payload['ibu']);
        } else {
            $beer->setIbu(0);
        }
        $beer->setAbv($payload['abv']);
        $beer->setIsOrganic((bool) $payload['isOrganic']);
        $beer->setName($payload['name']);
        $beer->setLabelThumbnail($payload['labels']['large']);

        return $beer;
    }

    public function getIsOnline()
    {
        return $this->status === self::ONLINE_STATUS;
    }

    public function setIsOnline($isOnline)
    {
        $this->setStatus($isOnline ? self::ONLINE_STATUS : self::OFFLINE_STATUS);
    }

    public function __toString()
    {
        return $this->name;
    }
}
