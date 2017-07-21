<?php

return [

    'project' => [
        'name' => env('APP_NAME','Whyte Creations'),
        'logo' => 'project/images/flex-logo.png',
        'link' => '/',
        'theme-color'=> '#ff0e00',
        'theme-font-color'=> '#FFF',
        'secondary-color'=> '#181818',
    ],

    'admin' => [
        'name' => 'Admin',
        'username' => 'admin',
        'password' => '123456',
        'email'    => 'info@flexzilla.com',
        'copyright' => '© 2016 '.env('APP_NAME','Whyte Creations').'. All Rights Reserved.',
        'copyright_link' => '/',
    ],

];
