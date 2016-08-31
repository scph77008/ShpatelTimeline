<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 31.08.16
 * Time: 12:41
 */

namespace TimelineApiBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use TimelineApiBundle\Exceptions\ApiException;

class EventController extends MainApiController
{
	public function getByCatAction(Request $request)
	{
		$catId = $request->get('id');

		$events = $this->getDoctrine()->getRepository('TimelineBundle:Event')->findBy(['catId' => $catId]);
		
		exit($this->serializer->serialize($events, 'json'));
	}

}