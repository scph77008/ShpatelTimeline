<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('cats', new Route('/cats', array(
    '_controller' => 'TimelineBundle:Default:Cats',
)));

$collection->add('events', new Route('/events', array(
	'_controller' => 'TimelineBundle:Default:Events',
)));

return $collection;
