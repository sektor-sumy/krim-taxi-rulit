<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartnerRepository")
 * @ORM\Table(name="partner")
 * @Vich\Uploadable
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
     * @Vich\UploadableField(mapping="partner_avatar", fileNameProperty="logoName")
     * @var File
     */
    private $logo;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $logoName;

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

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    public function __construct()
    {
        $this->isActive = false;
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
     * @return string
     */
    public function getLogoName()
    {
        return $this->logoName;
    }

    /**
     * @param string $logoName
     */
    public function setLogoName($logoName)
    {
        $this->logoName = $logoName;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return File
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param File $logo
     */
    public function setLogo(File $image = null)
    {
        $this->logo = $image;
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
