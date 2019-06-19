<?php

$version = API_VERSION_STRING;

return [

    "PUT {$version}/rbac-role/<id:\w+>" => "rbac/role/update",
    "GET {$version}/rbac-role/<id:\w+>" => "rbac/role/view",
    "DELETE {$version}/rbac-role/<id:\w+>" => "rbac/role/delete",
    ["class" => "yii\\rest\\UrlRule", "controller" => ["{$version}/rbac-role" => "rbac/role"]],

    "PUT {$version}/rbac-permission/<id:\w+>" => "rbac/permission/update",
    "GET {$version}/rbac-permission/<id:\w+>" => "rbac/permission/view",
    "DELETE {$version}/rbac-permission/<id:\w+>" => "rbac/permission/delete",
    ["class" => "yii\\rest\\UrlRule", "controller" => ["{$version}/rbac-permission" => "rbac/permission"]],
];
