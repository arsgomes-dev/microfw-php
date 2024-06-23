<?php

  $router->get('/', function () {
      global $validateRoutes;
      $validateRoutes->getRoutes("public_html/index", "public_html/notFound");
  });
  $router->get('/{view}', function ($view) {
      global $validateRoutes;
      $validateRoutes->getRoutes("public_html/" . $view, "public_html/notFound");
  });
  $router->get('/{view}/{example}', function ($view, $example) {
      global $validateRoutes;
      $gets = ["example" => $example];
      $validateRoutes->getRoutes("public_html/" . $view, "public_html/notFound", $gets);
  });
  $router->post('/{view}', function ($view) {
      global $validateRoutes;
      $validateRoutes->getRoutes("public_html/" . $view, "public_html/notFound");
  });
  
  