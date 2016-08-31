<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 27.07.16
 * Time: 18:43
 */

namespace TimelineApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MainApiController extends Controller
{
	/**
	 * Возвращаемое значение
	 *
	 * @type \Symfony\Component\BrowserKit\Response
	 */
	protected $response;

	/** @type \Symfony\Component\Serializer\Encoder\JsonEncoder[]*/
	protected $encoders;

	/** @type \Symfony\Component\Serializer\Normalizer\ObjectNormalizer[]  */
	protected $normalizers;

	/** @type \Symfony\Component\Serializer\Serializer  */
	protected $serializer;

	/**
	 * CatController constructor.
	 *
	 * @param $response
	 */
	public function __construct()
	{
		$this->response = new Response();
		$this->encoders = array(new JsonEncoder());
		$this->normalizers = array(new ObjectNormalizer());
		$this->serializer = new Serializer($this->normalizers, $this->encoders);
	}

	/**
	 * @return \Symfony\Component\BrowserKit\Response
	 */
	public function getResponse()
	{
		return $this->response;
	}

	/**
	 * @param \Symfony\Component\BrowserKit\Response $response
	 *
	 * @return MainApiController
	 */
	public function setResponse($response)
	{
		$this->response = $response;

		return $this;
	}

	/**
	 * @return \Symfony\Component\Serializer\Encoder\JsonEncoder[]
	 */
	public function getEncoders()
	{
		return $this->encoders;
	}

	/**
	 * @param \Symfony\Component\Serializer\Encoder\JsonEncoder[] $encoders
	 *
	 * @return MainApiController
	 */
	public function setEncoders($encoders)
	{
		$this->encoders = $encoders;

		return $this;
	}

	/**
	 * @return \Symfony\Component\Serializer\Normalizer\ObjectNormalizer[]
	 */
	public function getNormalizers()
	{
		return $this->normalizers;
	}

	/**
	 * @param \Symfony\Component\Serializer\Normalizer\ObjectNormalizer[] $normalizers
	 *
	 * @return MainApiController
	 */
	public function setNormalizers($normalizers)
	{
		$this->normalizers = $normalizers;

		return $this;
	}

	/**
	 * @return \Symfony\Component\Serializer\Serializer
	 */
	public function getSerializer()
	{
		return $this->serializer;
	}

	/**
	 * @param \Symfony\Component\Serializer\Serializer $serializer
	 *
	 * @return MainApiController
	 */
	public function setSerializer($serializer)
	{
		$this->serializer = $serializer;

		return $this;
	}

	public function RouteAction(Request $request)
	{
		echo "<pre>";
		print_r($request);
		die("<br>" .__LINE__. ": --> ".__FILE__);
	}
}