<?php
namespace TimelineBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EventAdmin extends AbstractAdmin
{
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper->add('cat', 'choice',  array(
			'choices' => array(
				'kit1' => 'red',
				'kit2' => 'green',
				'kit3' => 'blue'
			)
		))
		;
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper->add('cat');
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper->addIdentifier('cat');
	}
}