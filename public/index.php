<?php

use Styde\User;

require('../vendor/autoload.php');

$user = new User();

$user->fill([
    'first_name' => 'Leonard',
    'last_name' => 'López Molina'
]);

$user->nickname = 'pollito_123';

unset($user->nickname);

echo "<h1>Bienvenido a los metodos magicos con: $user->first_name $user->last_name</h1>";

if (isset($user->nickname)) {
    echo "<p>Nickname: $user->nickname</p>";
}