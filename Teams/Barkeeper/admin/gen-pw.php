<?php

echo password_hash($_GET["pw"], PASSWORD_BCRYPT, [
    'cost' => 12
]);