<?php

namespace yii2lab\rbac\domain\repositories\filedb;

use yii2lab\extension\filedb\repositories\base\BaseActiveFiledbRepository;
use yii2lab\rbac\domain\interfaces\repositories\AssignmentInterface;
use yii2lab\rbac\domain\repositories\traits\AssignmentTrait;

class AssignmentRepository extends BaseActiveFiledbRepository implements AssignmentInterface {
	
	use AssignmentTrait;
	
	protected $primaryKey = null;
	
}