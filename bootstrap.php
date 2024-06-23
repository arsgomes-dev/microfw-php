<?php require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use Microfw\Src\Routing\Router\Router;
try {
    $router = new Router;
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/src/Routing/Routes/Routes.php')) {
        require $_SERVER['DOCUMENT_ROOT'] . '/src/Routing/Routes/Routes.php';
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/../src/Routing/Routes/Routes.php')) {
        require $_SERVER['DOCUMENT_ROOT'] . '/../src/Routing/Routes/Routes.php';
    } else {
        require $_SERVER['DOCUMENT_ROOT'] . 'src/Routing/Routes/Routes.php';
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
