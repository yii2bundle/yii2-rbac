<?php

namespace yii2lab\rbac\domain\enums;

use yii2rails\extension\enum\base\BaseEnum;

class RbacPermissionEnum extends BaseEnum
{

    // Управление RBAC
    const MANAGE = 'oRbacManage';
	
	// Авторизованный
	const AUTHORIZED = '@';
	
	// Гость
	const GUEST = '?';

}