Установка
===

Устанавливаем зависимость:

```
composer require yii2module/yii2-rbac
```

Объявляем консольный модуль:

```php
return [
	'modules' => [
		// ...
		'rbac' => 'yii2bundle\rbac\console\Module',
		// ...
	],
];
```

Объявляем домен:

```php
return [
	'components' => [
		// ...
		'rbac' => 'yii2bundle\rbac\domain\Domain',
		// ...
	],
];
```
