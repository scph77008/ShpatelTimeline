<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('timeline_homepage', new Route('/', array(
    '_controller' => 'TimelineBundle:Default:index',
)));

return $collection;
