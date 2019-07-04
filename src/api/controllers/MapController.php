<?php

namespace yii2lab\rbac\api\controllers;

use yii2lab\geo\domain\enums\GeoPermissionEnum;
use yii2lab\rbac\domain\entities\RoleEntity;
use yii2lab\rbac\domain\enums\RbacPermissionEnum;
use yii2lab\rest\domain\rest\Controller;
use yii2rails\domain\data\Query;
use yii2rails\extension\web\helpers\Behavior;

class MapController extends Controller
{

    public function actionIndex() {
        $query = new Query;
        $query->with('children');
        /** @var RoleEntity[] $collection */
        $collection = \App::$domain->rbac->role->all($query);
        $map = [];
        foreach ($collection as $roleEntity) {
            $roleTitle = "{$roleEntity->description}";
            //$roleTitle .= " ({$roleEntity->name})";
            $map[$roleTitle] = [];
            if($roleEntity->children) {
                foreach ($roleEntity->children as $itemEntity) {
                    $itemTitle = "{$itemEntity->description}";
                    //$itemTitle .= " ({$itemEntity->name})";
                    $map[$roleTitle][] = $itemTitle;
                }
            }
        }
        return $map;
    }

}
