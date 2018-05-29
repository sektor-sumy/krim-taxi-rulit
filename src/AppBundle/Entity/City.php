<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="city")
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", nullable=false, unique=true)
     */
    protected $name;

    /**
     * @ORM\Column(name="name_translate", type="string", nullable=true)
     */
    protected $nameTranslate;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNameTranslate()
    {
        return $this->nameTranslate;
    }

    /**
     * @param mixed $nameTranslate
     */
    public function setNameTranslate()
    {
        $transliterator = \Transliterator::create('Any-Latin');
        $transliteratorToASCII = \Transliterator::create('Latin-ASCII');

        $this->nameTranslate = $transliteratorToASCII->transliterate(
            $transliterator->transliterate($this->getName())
        );

    }

}
