<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('index', new Route('/', array(
    '_controller' => 'TimelineBundle:Timeline:Cats',
)));

$collection->add('cats', new Route('/cats', array(
    '_controller' => 'TimelineBundle:Timeline:Cats',
)));

$collection->add('events', new Route('/events', array(
	'_controller' => 'TimelineBundle:Timeline:Events',
)));

$collection->add('api', new Route('/api/', array(
	'_controller' => 'TimelineBundle:Api:GetData',
)));

return $collection;
