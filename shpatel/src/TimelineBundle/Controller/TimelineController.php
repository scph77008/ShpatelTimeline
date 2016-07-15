<?php

namespace TimelineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TimelineBundle\Entity\Cat;

class TimelineController extends Controller
{
	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function CatsAction()
    {
	    /** @type Cat[] $cats */
	    $cats = $this->getDoctrine()->getRepository('TimelineBundle:Cat')->findAll();
	
	    $choices = [];
	    foreach ($cats as &$cat)
	    {
		   $choices[] = ['id' => $cat->getId(), 'name' => $cat->getName()];
	    }
	    unset($cat);
	   
        return $this->render('TimelineBundle:Timeline:cats.html.twig', ['cats' => $choices]);
    }

	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function EventsAction()
    {
        return $this->render('TimelineBundle:Timeline:events.html.twig');
    }
}
