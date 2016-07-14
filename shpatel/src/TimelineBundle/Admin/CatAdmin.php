<?php
namespace TimelineBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use TimelineBundle\Entity\Cat;

class CatAdmin extends AbstractAdmin
{
	/**
	 * Конфигурация формы редактирования записи
	 *
	 * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
	 */
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->add('name', 'text', ['label' => 'Имя'])
			->add('file', 'file', ['label' => 'Фото', 'required' => false])
			->add('datebirth', 'date', ['label' => 'Дата рождения']);
	}

	/**
	 * Поля, по которым производится поиск в списке записей
	 *
	 * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
	 */
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('name')
			->add('photo');
	}

	/**
	 * Конфигурация списка записей
	 *
	 * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
	 */
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->addIdentifier('name')
			->addIdentifier('photo');
	}

	/* Загрузка файла */
	
	/**
	 * @param Cat $cat
	 */
	public function prePersist($cat)
	{
		$this->manageFileUpload($cat);
	}

	/**
	 * @param Cat $cat
	 */
	public function preUpdate($cat)
	{
		$this->manageFileUpload($cat);
	}

	/**
	 * @param Cat $cat
	 */
	private function manageFileUpload($cat)
	{
		if ($cat->getFile())
		{
			$cat->upload();
		}
	}
}