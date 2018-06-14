<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TransportClassRepository")
 * @ORM\Table(name="transport_class")
 */
class TransportClass
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

    /**
     * @ORM\Column(name="priority", type="integer", nullable=true, options={"default":0})
     */
    protected $priority;

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
        $this->nameTranslate = preg_replace ("/^[^a-zA-Z\s]*$/","",$this->nameTranslate);

    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param mixed $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }


}
