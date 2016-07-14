<?php

namespace TimelineBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

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

		// Сохраняем файл
		$this->getFile()
		     ->move(
			     '/home/virtual/timeline.dev/www/shpatel/web/uploads/cats/' . $this->getId() . '/',
			     //TODO: Разобраться с AppKernel->getRootDir()
			     $this->getFile()
			          ->getClientOriginalName()
		     );

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
