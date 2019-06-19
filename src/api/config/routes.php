<?php

$version = API_VERSION_STRING;

return [

    ["class" => "yii2lab\\rest\\domain\\rules\\UrlRule", "controller" => ["{$version}/rbac-role" => "rbac/role"]],
    ["class" => "yii2lab\\rest\\domain\\rules\\UrlRule", "controller" => ["{$version}/rbac-permission" => "rbac/permission"]],
    ["class" => "yii2lab\\rest\\domain\\rules\\UrlRule", "controller" => ["{$version}/rbac-assignment" => "rbac/assignment"]],

];
