<?php
use Microfw\Src\Main\Common\Entity\McConfig;
use Microfw\Src\Main\Common\Entity\User;
$user = new User();
$user = $user->getOne($user, '1');
print_r($user->getName());
?>