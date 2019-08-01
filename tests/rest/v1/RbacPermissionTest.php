<?php

namespace yii2bundle\rbac\tests\rest\v1;

use api\tests\functional\v1\article\ArticleSchema;
use yii2bundle\rbac\tests\rest\v1\RbacSchema;
use yii2lab\test\helpers\CurrentIdTestHelper;
use yii2lab\test\helpers\TestHelper;
use yii2lab\test\Test\BaseActiveApiTest;
use yii2module\account\domain\v3\helpers\test\AuthTestHelper;

class RbacPermissionTest extends BaseActiveApiTest
{

    public $package = 'api';
    public $point = 'v1';
    public $resource = 'rbac-permission';

    public function testAll()
    {
        AuthTestHelper::authByLogin('admin');
        $this->readCollection($this->resource, [], RbacSchema::$item, true);
    }

    public function testOne()
    {
        AuthTestHelper::authByLogin('admin');
        $this->readEntity($this->resource, 'oBackendAll', RbacSchema::$item);
    }

    /*public function testRelation()
    {
        AuthTestHelper::authByLogin('admin');
        $this->assertRelationContract($this->resource, 'rUser', [
            'children' => [RbacSchema::$item],
        ]);
    }*/

}
