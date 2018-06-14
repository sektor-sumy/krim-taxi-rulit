<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MessageRepository")
 * @ORM\Table(name="message")
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    protected $name;

    /**
     * @ORM\Column(name="email", type="string", nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(name="phone", type="string", nullable=false)
     */
    protected $phone;

    /**
     * @ORM\Column(name="text", type="text", nullable=false)
     */
    protected $text;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="removed_at", type="datetime", nullable=true)
     */
    protected $removedAt;

    /**
     * @ORM\Column(name="viewed_at", type="boolean", nullable=true, options={"default":false})
     */
    protected $viewedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->viewedAt = false;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getRemovedAt()
    {
        return $this->removedAt;
    }

    /**
     * @param mixed $removedAt
     */
    public function setRemovedAt($removedAt)
    {
        $this->removedAt = $removedAt;
    }

    /**
     * @return mixed
     */
    public function getViewedAt()
    {
        return $this->viewedAt;
    }

    /**
     * @param mixed $viewedAt
     */
    public function setViewedAt($viewedAt)
    {
        $this->viewedAt = $viewedAt;
    }


}
