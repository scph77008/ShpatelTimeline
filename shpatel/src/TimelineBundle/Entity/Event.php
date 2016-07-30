<?php

namespace TimelineBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

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
	private $catId;

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
	 * Set catId
	 *
	 * @param integer $catId
	 *
	 * @return Event
	 */
	public function setCatId($catId)
	{
		$this->catId = $catId;

		return $this;
	}

	/**
	 * Get catId
	 *
	 * @return integer
	 */
	public function getCatId()
	{
		return $this->catId;
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
	 * @return UploadedFile
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

        // Временное решение
        $ROOT_WEB_DIR = '/home/virtual/shpatel.dev/www/shpatel/web/uploads/events/';

        // Папка кота
        if(!is_dir($ROOT_WEB_DIR . $this->getCatId() ))
        {
            mkdir($ROOT_WEB_DIR . $this->getCatId());
        }

        // Папка события
        if(!is_dir($ROOT_WEB_DIR . $this->getCatId(). '/'. $this->getId() ))
        {
            mkdir($ROOT_WEB_DIR . $this->getCatId(). '/'. $this->getId());
        }

		// Сохраняем файл по пути /events/catID/eventID/Timestamp/
        {
            $this->getFile()
                 ->move(
                     $ROOT_WEB_DIR . $this->getCatId() . '/'. $this->getId(), //TODO: Разобраться с AppKernel->getRootDir()
                     $this->getTime()->getTimestamp(). '.jpg'
                 );
        }

		// Сохраняем путь
		$this->setPhoto(
			$this->getFile()
			     ->getClientOriginalName()
		);

		// Забываем о файле
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
