<?php

return [
    'admin' => [
        'id' => 1,
        'username' => 'erau',
        'auth_key' => 'testkey',
        'password_hash' => Yii::$app->security->generatePasswordHash('password_0'),
        'email' => 'erau@test.com',
        'status' => 10,
        'created_at' => time(),
        'updated_at' => time(),
    ],
];
