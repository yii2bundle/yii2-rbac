<?php

namespace yii2lab\rbac\domain\repositories\bridge;

use yii\rbac\Role;
use yii2lab\rbac\domain\entities\RoleEntity;
use yii2lab\rbac\domain\interfaces\repositories\RoleInterface;
use yii2rails\domain\repositories\BaseRepository;
use yii2lab\rbac\domain\interfaces\repositories\PermissionInterface;
use yii2rails\domain\data\Query;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;
use yii\rbac\Permission;
use yii\web\NotFoundHttpException;
use yii2lab\rbac\domain\entities\PermissionEntity;
use yii2rails\domain\BaseEntity;
use yii2rails\domain\exceptions\UnprocessableEntityHttpException;
use yii2rails\domain\helpers\ErrorCollection;
use yii2rails\domain\services\base\BaseActiveService;
use yii2rails\domain\services\base\BaseService;
use yii2rails\extension\arrayTools\helpers\ArrayIterator;
use yii2rails\extension\enum\base\BaseEnum;

/**
 * Class RoleRepository
 * 
 * @package yii2lab\rbac\domain\repositories\bridge
 * 
 * @property-read \yii2lab\rbac\domain\Domain $domain
 */
class RoleRepository extends BaseRepository implements RoleInterface {

    protected $schemaClass = true;

    public function all(Query $query = null)
    {
        $all = \App::$domain->rbac->item->getRoles();
        $collection = [];
        foreach ($all as $item) {
            $collection[] = $this->forgeEntityFromItem($item);
        }
        $iterator = new ArrayIterator;
        $iterator->setCollection($collection);
        return $iterator->all($query);
    }

    public function count(Query $query = null)
    {
        return count($this->all($query));
    }

    public function oneById($id, Query $query = null)
    {
        $item = \App::$domain->rbac->item->getRole($id);
        if(empty($item)) {
            throw new NotFoundHttpException();
        }
        return $this->forgeEntityFromItem($item);
    }

    public function insert(BaseEntity $entity)
    {
        $item = new Role;
        $this->forgeItemFromData($item, $entity->toArray());
        $this->checkExistsByName($item);
        \App::$domain->rbac->item->addItem($item);
    }

    public function update(BaseEntity $entity)
    {
        // TODO: Implement update() method.
    }

    public function updateById($id, $data)
    {
        $item = \App::$domain->rbac->item->getRole($id);
        if(empty($item)) {
            throw new NotFoundHttpException();
        }
        $data['name'] = $id;
        $this->forgeItemFromData($item, $data);
        //$this->checkExistsByName($item);
        \App::$domain->rbac->item->updateItem($id, $item);
    }

    public function delete(BaseEntity $entity)
    {
        $this->deleteById($entity->name);
    }

    public function truncate()
    {
        \App::$domain->rbac->item->removeAllRoles();
    }

    public function deleteById($id)
    {
        $item = \App::$domain->rbac->item->getRole($id);
        if(empty($item)) {
            throw new NotFoundHttpException();
        }
        \App::$domain->rbac->item->removeItem($item);
    }

    private function checkExistsByName(Item $item) {
        try {
            $this->oneById($item->name);
            $error = new ErrorCollection;
            $error->add('name', 'rbac/role', 'already_exists');
            throw new UnprocessableEntityHttpException($error);
        } catch (NotFoundHttpException $e) {}
    }

    private function forgeItemFromData(Item $item, $data) {
        $itemEntity = new RoleEntity($data);
        $itemEntity->validate();
        $item->name = ArrayHelper::getValue($itemEntity, 'name', $item->name);
        $item->description = ArrayHelper::getValue($itemEntity, 'description', $item->description);
        $item->ruleName = ArrayHelper::getValue($itemEntity, 'rule_name', $item->ruleName);
    }

    private function forgeEntityFromItem(Item $item) {
        $itemEntity = new RoleEntity;
        $itemEntity->name = $item->name;
        $itemEntity->description = $item->description;
        $itemEntity->rule_name = $item->ruleName;
        $itemEntity->data = $item->data;
        return $itemEntity;
    }

}
