<?php

namespace yii2lab\rbac\domain\entities;

use yii2rails\domain\BaseEntity;

/**
 * Class AssignmentEntity
 *
 * @package yii2lab\rbac\domain\entities
 *
 * @property $user_id
 * @property $item_name
 */
class AssignmentEntity extends BaseEntity {

    protected $id;
	protected $user_id;
	protected $item_name;

	public function getId() {
	    $scope = $this->user_id . '_' . $this->item_name;
	    return $scope;
    }

}
