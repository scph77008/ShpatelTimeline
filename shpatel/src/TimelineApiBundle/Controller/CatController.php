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

class CatController extends MainApiController
{
	public function getAction(Request $request)
	{
		$catId = $request->get('id');

		switch ($catId)
		{
			case 'all':
				$cats = $this->getDoctrine()->getRepository('TimelineBundle:Cat')->findAll();
			break;

			default:
				$cats = $this->getDoctrine()->getRepository('TimelineBundle:Cat')->find($catId);
				break;
		}
		
		if (is_null($cats))
			throw new ApiException('Unknow Cat ID - ' . $catId);

		exit($this->serializer->serialize($cats, 'json'));
	}

}