<?php

namespace TimelineBundle\Entity;

/**
 * Cat
 */
class Cat
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
    private $photo;

    /**
     * @var \DateTime
     */
    private $datebirth;


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
     * @return Cat
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
     * Set photo
     *
     * @param string $photo
     *
     * @return Cat
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set datebirth
     *
     * @param \DateTime $datebirth
     *
     * @return Cat
     */
    public function setDatebirth($datebirth)
    {
        $this->datebirth = $datebirth;

        return $this;
    }

    /**
     * Get datebirth
     *
     * @return \DateTime
     */
    public function getDatebirth()
    {
        return $this->datebirth;
    }
}

