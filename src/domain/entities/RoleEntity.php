<?php

namespace yii2lab\rbac\domain\entities;

use yii2rails\domain\BaseEntity;

/**
 * Class RoleEntity
 * 
 * @package yii2lab\rbac\domain\entities
 * 
 * @property $name
 * @property $description
 * @property $rule_name
 * @property $data
 */
class RoleEntity extends BaseEntity {

	protected $name;
	protected $description;
	protected $rule_name;
	protected $data;

}
