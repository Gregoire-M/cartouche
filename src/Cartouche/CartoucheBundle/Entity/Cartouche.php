<?php

namespace Cartouche\CartoucheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="cartouche")
 * @ORM\Entity(repositoryClass="Cartouche\CartoucheBundle\Entity\CartoucheRepository")
 */
class Cartouche
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name = 'Ma cartouche Brita';

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isNotificationEnabled", type="boolean")
     */
    private $isNotificationEnabled = false;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastChangeDate", type="datetime")
     * @Assert\DateTime()
     */
    private $lastChangeDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration = 28;

    public function __construct()
    {
        $this->lastChangeDate = new \DateTime();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Cartouche
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Cartouche
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set isNotificationEnabled
     *
     * @param boolean $isNotificationEnabled
     * @return Cartouche
     */
    public function setIsNotificationEnabled($isNotificationEnabled)
    {
        $this->isNotificationEnabled = $isNotificationEnabled;

        return $this;
    }

    /**
     * Get isNotificationEnabled
     *
     * @return boolean 
     */
    public function getIsNotificationEnabled()
    {
        return $this->isNotificationEnabled;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Cartouche
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set lastChangeDate
     *
     * @param \DateTime $lastChangeDate
     * @return Cartouche
     */
    public function setLastChangeDate($lastChangeDate)
    {
        $this->lastChangeDate = $lastChangeDate;

        return $this;
    }

    /**
     * Get lastChangeDate
     *
     * @return \DateTime 
     */
    public function getLastChangeDate()
    {
        return $this->lastChangeDate;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return Cartouche
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer 
     */
    public function getDuration()
    {
        return $this->duration;
    }
}
