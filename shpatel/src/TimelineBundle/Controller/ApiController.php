<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 27.07.16
 * Time: 18:43
 */

namespace TimelineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use TimelineBundle\TimelineBundle;

class ApiController extends Controller
{
	public function GetDataAction()
	{
		/** @type TimelineBundle:Cat[] $cats */
		$cats = $this->getDoctrine()->getRepository('TimelineBundle:Cat')->findAll();

		$encoders = array(new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());
		$serializer = new Serializer($normalizers, $encoders);

		$jsonContent = $serializer->serialize($cats, 'json');

		return $jsonContent;
	}
}