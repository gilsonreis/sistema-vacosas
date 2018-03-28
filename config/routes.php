<?php

return [
    '<controller:\w+>/<id:\d+>' => '<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    'dashboard' => 'site/index',
    'permissoes/gerenciar-permissoes/<perfil:\w+>' => "permissoes/gerenciar-permissoes"
];