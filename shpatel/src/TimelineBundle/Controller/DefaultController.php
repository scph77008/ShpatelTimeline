<?php

namespace TimelineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TimelineBundle\Entity\Cat;

class DefaultController extends Controller
{
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
	   
        return $this->render('TimelineBundle:Default:cats.html.twig', ['cats' => $choices]);
    }  
	
	public function EventsAction()
    {
        return $this->render('TimelineBundle:Default:events.html.twig');
    }
}
