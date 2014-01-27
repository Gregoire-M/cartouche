<?php

namespace Cartouche\CartoucheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="cartouche")
 * @UniqueEntity("url")
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
     * @ORM\Column(name="url", type="string", length=255, unique=true)
     * @Assert\Regex("/^[a-z0-9]+$/")
     */
    private $url;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notificationEnabled", type="boolean")
     */
    private $notificationEnabled = false;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
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

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nextChangeDate", type="datetime")
     * @Assert\DateTime()
     */
    private $nextChangeDate;

    public function __construct()
    {
        $this->lastChangeDate = new \DateTime();
        $this->computeNextChangeDate();
    }


    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @return Cartouche
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $url
     * @return Cartouche
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param boolean $notificationEnabled
     * @return Cartouche
     */
    public function setNotificationEnabled($notificationEnabled)
    {
        $this->notificationEnabled = $notificationEnabled;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isNotificationEnabled()
    {
        return $this->notificationEnabled;
    }

    /**
     * @param string $email
     * @return Cartouche
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param \DateTime $lastChangeDate
     * @return Cartouche
     */
    public function setLastChangeDate($lastChangeDate)
    {
        $this->lastChangeDate = $lastChangeDate;
        $this->computeNextChangeDate();

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastChangeDate()
    {
        return $this->lastChangeDate;
    }

    /**
     * @param integer $duration
     * @return Cartouche
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
        $this->computeNextChangeDate();

        return $this;
    }

    /**
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param \DateTime $nextChangeDate
     * @return Cartouche
     */
    public function setNextChangeDate($nextChangeDate)
    {
        $this->nextChangeDate = $nextChangeDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getNextChangeDate()
    {
        return $this->nextChangeDate;
    }

    private function computeNextChangeDate()
    {
        $nextDate = clone $this->lastChangeDate;
        $nextDate->add(new \DateInterval(sprintf('P%dD', $this->duration)));

        return $this->setNextChangeDate($nextDate);
    }
}
