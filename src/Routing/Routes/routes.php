<?php

  use Microfw\Src\Main\Common\Entity\McConfig;
  use Microfw\Src\Routing\Router\ValidateRoutes;

  $config = new McConfig;
  $validateRoutes = new ValidateRoutes();
  $documentRoot = $_SERVER['DOCUMENT_ROOT'];
  $directoryFile = dir($documentRoot . "/src/Routing/Routes/Routings");

  while ($files = $directoryFile->read()) {
      if (!strcasecmp($files, ".") == 0 && !strcasecmp($files, "..") == 0) {
          include $documentRoot . "/src/Routing/Routes/Routings/" . $files;
      }
  }
