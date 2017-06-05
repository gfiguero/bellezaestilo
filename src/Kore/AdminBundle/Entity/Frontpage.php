<?php

namespace Kore\AdminBundle\Entity;

/**
 * Frontpage
 */
class Frontpage
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $subtitle;

    /**
     * @var string
     */
    private $about;

    /**
     * @var string
     */
    private $subabout;

    /**
     * @var string
     */
    private $service;

    /**
     * @var string
     */
    private $subservice;

    /**
     * @var string
     */
    private $calltoaction;

    /**
     * @var string
     */
    private $contact;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     */
    private $deletedAt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $photos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
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
     *
     * @return Frontpage
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
     * Set title
     *
     * @param string $title
     *
     * @return Frontpage
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return Frontpage
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set about
     *
     * @param string $about
     *
     * @return Frontpage
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Set subabout
     *
     * @param string $subabout
     *
     * @return Frontpage
     */
    public function setSubabout($subabout)
    {
        $this->subabout = $subabout;

        return $this;
    }

    /**
     * Get subabout
     *
     * @return string
     */
    public function getSubabout()
    {
        return $this->subabout;
    }

    /**
     * Set service
     *
     * @param string $service
     *
     * @return Frontpage
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set subservice
     *
     * @param string $subservice
     *
     * @return Frontpage
     */
    public function setSubservice($subservice)
    {
        $this->subservice = $subservice;

        return $this;
    }

    /**
     * Get subservice
     *
     * @return string
     */
    public function getSubservice()
    {
        return $this->subservice;
    }

    /**
     * Set calltoaction
     *
     * @param string $calltoaction
     *
     * @return Frontpage
     */
    public function setCalltoaction($calltoaction)
    {
        $this->calltoaction = $calltoaction;

        return $this;
    }

    /**
     * Get calltoaction
     *
     * @return string
     */
    public function getCalltoaction()
    {
        return $this->calltoaction;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return Frontpage
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Frontpage
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Frontpage
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return Frontpage
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Add photo
     *
     * @param \Kore\AdminBundle\Entity\FrontpagePhoto $photo
     *
     * @return Frontpage
     */
    public function addPhoto(\Kore\AdminBundle\Entity\FrontpagePhoto $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \Kore\AdminBundle\Entity\FrontpagePhoto $photo
     */
    public function removePhoto(\Kore\AdminBundle\Entity\FrontpagePhoto $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }
}
