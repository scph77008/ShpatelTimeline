<?php

namespace TimelineBundle\Entity;

/**
 * Event
 */
class Event
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $cat;

    /**
     * @var \DateTime
     */
    private $time;

    /**
     * @var string
     */
    private $photo;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $weight;

	/**
	 * Unmapped property to handle file uploads
	 */
	private $file;

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
     * Set cat
     *
     * @param integer $cat
     *
     * @return Event
     */
    public function setCat($cat)
    {
        $this->cat = $cat;

        return $this;
    }

    /**
     * Get cat
     *
     * @return integer
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Event
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Event
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
     * Set description
     *
     * @param string $description
     *
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return Event
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }


	/**
	 * Sets file.
	 *
	 * @param   UploadedFile $file
	 */
	public function setFile(UploadedFile $file = null)
	{
		$this->file = $file;
	}

	/**
	 * Get file.
	 *
	 * @return Uplo adedFile
	 */
	public function getFile()
	{
		return $this->file;
	}

	/**
	 * Загружает файл из формы
	 */
	public function upload()
	{
		if (null === $this->getFile())
		{
			return;
		}

		// Сохраняем файл
		$this->getFile()
		     ->move(
			     '/home/virtual/timeline.dev/www/shpatel/web/uploads/cats/' . $this->getId() . '/', //TODO: Разобраться с AppKernel->getRootDir()
			     $this->getFile()
			          ->getClientOriginalName()
		     );

		// Сохраняем путь
		$this->setPhoto(
			$this->getFile()
			     ->getClientOriginalName()
		);

		// Очищаем файл
		$this->setFile(null);
	}

	/**
	 * Lifecycle callback to upload the file to the server
	 */
	public function lifecycleFileUpload()
	{
		$this->upload();
	}

}
