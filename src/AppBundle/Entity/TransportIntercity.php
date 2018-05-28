<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use AppBundle\Entity\City;
use AppBundle\Entity\TransportClass;

/**
 * @ORM\Entity
 * @ORM\Table(name="transport_intercity")
 */
class TransportIntercity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="city_from", referencedColumnName="id")
     */
    protected $cityFrom;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="city_in", referencedColumnName="id")
     */
    protected $cityIn;

    /**
     * @ORM\ManyToOne(targetEntity="TransportClass")
     * @ORM\JoinColumn(name="transport_class", referencedColumnName="id")
     */
    protected $class;

    /**
     * @ORM\Column(name="price_type", type="string", nullable=true)
     */
    protected $priceType;

    /**
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    protected $price;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCityFrom()
    {
        return $this->cityFrom;
    }

    /**
     * @param mixed $cityFrom
     */
    public function setCityFrom($cityFrom)
    {
        $this->cityFrom = $cityFrom;
    }

    /**
     * @return mixed
     */
    public function getCityIn()
    {
        return $this->cityIn;
    }

    /**
     * @param mixed $cityIn
     */
    public function setCityIn($cityIn)
    {
        $this->cityIn = $cityIn;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    public function getPriceType()
    {
        return $this->priceType;
    }

    /**
     * @param mixed $priceType
     */
    public function setPriceType($priceType)
    {
        $this->priceType = $priceType;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

}
