<?php

namespace yii2bundle\rbac\api\controllers;

use yii2bundle\geo\domain\enums\GeoPermissionEnum;
use yii2bundle\rbac\domain\enums\RbacPermissionEnum;
use yii2lab\rest\domain\rest\ActiveControllerWithQuery as Controller;
use yii2rails\extension\web\helpers\Behavior;

class PermissionController extends Controller
{
	
	public $service = 'rbac.permission';

	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
            'cors' => Behavior::cors(),
		    'authenticator' => Behavior::auth(['create', 'update', 'delete']),
            'access' => Behavior::access(RbacPermissionEnum::MANAGE, ['create', 'update', 'delete']),
		];
	}
	
}
