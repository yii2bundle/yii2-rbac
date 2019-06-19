<?php

namespace yii2lab\rbac\domain\services;

use yii2rails\domain\BaseEntity;
use yii2rails\domain\data\Query;
use yii2rails\domain\services\base\BaseActiveService;
use yii2rails\domain\services\base\BaseService;
use yii2lab\rbac\domain\interfaces\services\RoleInterface;

/**
 * Class RuleService
 *
 * @package yii2lab\rbac\domain\services
 *
 * @property \yii2lab\rbac\domain\Domain $domain
 * @property \yii2lab\rbac\domain\interfaces\repositories\RoleInterface $repository
 */
class RoleService extends BaseActiveService implements RoleInterface {

	public function updateById($id, $data)
    {
        return $this->repository->updateById($id, $data);
    }

    public function updateAll()
    {
        $this->repository->update();
    }
}
