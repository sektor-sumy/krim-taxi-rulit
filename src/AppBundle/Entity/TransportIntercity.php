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
}
