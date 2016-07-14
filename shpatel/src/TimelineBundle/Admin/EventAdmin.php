<?php
namespace TimelineBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use TimelineBundle\Entity\Cat;
use TimelineBundle\Entity\Event;

class EventAdmin extends AbstractAdmin
{
	protected function configureFormFields(FormMapper $formMapper)
	{
		// Привязка к коту
		/** @type Cat[] $cats */
		$cats = $this->getModelManager()
		             ->findBy('TimelineBundle:Cat');

		$choices = [];
		foreach ($cats as &$cat)
		{
			$choices[ $cat->getName() . '(' . $cat->getId() . ')' ] = $cat->getId();
		}
		unset($cat);

		$formMapper->add('catId', 'choice', ['choices' => $choices])
		           ->add('time', 'datetime')
		           ->add('file', 'file', ['label' => 'Фото', 'required' => false])
		           ->add('description', 'text')
		           ->add('weight', 'integer');
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper->add('catId')
		               ->add('time')
		               ->add('photo')
		               ->add('description')
		               ->add('weight');
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper->addIdentifier('catId')
		           ->addIdentifier('time')
		           ->addIdentifier('photo')
		           ->addIdentifier('description')
		           ->addIdentifier('weight');
	}

	/* Загрузка файла */

	/**
	 * @param Event $event
	 */
	public function prePersist($event)
	{
		$this->manageFileUpload($event);
	}

	/**
	 * @param Event $event
	 */
	public function preUpdate($event)
	{
		$this->manageFileUpload($event);
	}

	/**
	 * @param Event $event
	 */
	private function manageFileUpload($event)
	{
		if ($event->getFile())
		{
			$event->upload();
		}
	}
}