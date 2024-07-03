<?php

  $router->get('/', function () {
      global $validateRoutes;
      $validateRoutes->getRoutes("index", "notFound");
  });
  $router->get('/{view}', function ($view) {
      global $validateRoutes;
      $validateRoutes->getRoutes($view, "notFound");
  });
  
  