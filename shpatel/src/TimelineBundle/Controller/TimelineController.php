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
	    
        return $this->render('TimelineBundle:Timeline:cats.html.twig', ['cats' => $cats]);
    }

	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function EventsAction()
    {
		$events = $this->getDoctrine()->getRepository('TimelineBundle:Event')->findAll();

        return $this->render('TimelineBundle:Timeline:events.html.twig', ['events' => $events]);
    }
}
