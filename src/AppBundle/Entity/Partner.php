<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="partner")
 */
class Partner
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @ORM\Column(name="short_info", type="string")
     */
    protected $shortInfo;

    /**
     * @ORM\Column(name="long_info", type="text")
     */
    protected $longInfo;

    /**
     * @ORM\Column(name="priority", type="integer")
     */
    protected $priority;

    /**
     * @ORM\Column(name="is_active", type="boolean", options={"default" : false})
     */
    protected $isActive;


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
    public function getShortInfo()
    {
        return $this->shortInfo;
    }

    /**
     * @param mixed $shortInfo
     */
    public function setShortInfo($shortInfo)
    {
        $this->shortInfo = $shortInfo;
    }

    /**
     * @return mixed
     */
    public function getLongInfo()
    {
        return $this->longInfo;
    }

    /**
     * @param mixed $longInfo
     */
    public function setLongInfo($longInfo)
    {
        $this->longInfo = $longInfo;
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

    /**
     * @return mixed
     */
    public function getisActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }


}
