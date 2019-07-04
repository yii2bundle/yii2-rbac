<?php

namespace yii2lab\rbac\domain\repositories\bridge;

use yii\rbac\Permission;
use yii2lab\rbac\domain\entities\PermissionEntity;
use yii2lab\rbac\domain\entities\RoleEntity;
use yii2lab\rbac\domain\enums\ItemTypeEnum;
use yii2lab\rbac\domain\interfaces\repositories\PermissionInterface;
use yii2rails\domain\repositories\BaseRepository;
use yii2rails\domain\data\Query;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;
use yii\web\NotFoundHttpException;
use yii2rails\domain\BaseEntity;
use yii2rails\domain\exceptions\UnprocessableEntityHttpException;
use yii2rails\domain\helpers\ErrorCollection;
use yii2rails\domain\services\base\BaseActiveService;
use yii2rails\domain\services\base\BaseService;
use yii2rails\extension\arrayTools\helpers\ArrayIterator;
use yii2rails\extension\enum\base\BaseEnum;

/**
 * Class PermissionRepository
 *
 * @package yii2lab\rbac\domain\repositories\bridge
 *
 * @property-read \yii2lab\rbac\domain\Domain $domain
 */
class BaseItemRepository extends BaseRepository {

    protected $schemaClass = true;

    public function count(Query $query = null)
    {
        return count($this->all($query));
    }

    public function delete(BaseEntity $entity)
    {
        $this->deleteById($entity->name);
    }

    public function update(BaseEntity $entity)
    {
        // TODO: Implement update() method.
    }

    protected function checkExistsByName(Item $item) {
        try {
            $this->oneById($item->name);
            $error = new ErrorCollection;
            $error->add('name', 'rbac/' . $this->id, 'already_exists');
            throw new UnprocessableEntityHttpException($error);
        } catch (NotFoundHttpException $e) {}
    }

    protected function allToCollection($all) {
        $collection = [];
        foreach ($all as $item) {
            $collection[] = $this->forgeEntityFromItem($item);
        }
        return $collection;
    }

    protected function forgeItemFromData(Item $item, $data) {
        $itemEntity = new PermissionEntity($data);
        $itemEntity->validate();
        $item->name = ArrayHelper::getValue($itemEntity, 'name', $item->name);
        $item->description = ArrayHelper::getValue($itemEntity, 'description', $item->description);
        $item->ruleName = ArrayHelper::getValue($itemEntity, 'rule_name', $item->ruleName);
    }

    protected function loadRelations($roleEntity, Query $query) {
        $with = $query->getParam(Query::WITH);
        if($with && in_array('children', $with)) {
            $children = \App::$domain->rbac->item->getChildren($roleEntity->name);
            $roleEntity->children = $this->allToCollection($children);
        }
    }

    protected function forgeEntityFromItem(Item $item) {
        if($item->type == ItemTypeEnum::ROLE) {
            $itemEntity = new RoleEntity;
        } elseif ($item->type == ItemTypeEnum::PERMISSION) {
            $itemEntity = new PermissionEntity;
        }
        $itemEntity->name = $item->name;
        $itemEntity->description = $item->description;
        $itemEntity->rule_name = $item->ruleName;
        $itemEntity->data = $item->data;
        return $itemEntity;
    }

}
