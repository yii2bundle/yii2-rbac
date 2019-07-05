<?php

namespace yii2lab\rbac\domain\entities;

use yii2rails\domain\BaseEntity;

/**
 * Class RoleEntity
 * 
 * @package yii2lab\rbac\domain\entities
 * 
 * @property RoleEntity[] $roles
 * @property PermissionEntity[] $permissions
 */
class RoleEntity extends BaseItemEntity {

    protected $roles;
    protected $permissions;

}
