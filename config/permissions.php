<?php
return [
	'Users.SimpleRbac.permissions' => [
		[
			'role' => '*',
			'controller' => 'Pages',
			'action' => ['display'],
		],
		[
			'role' => '*',
			'plugin' => 'CakeDC/Users',
			'controller' => 'Users',
			'action' => ['profile', 'logout'],
		],
		[
			'role' => '*',
			'controller' => 'Services',
			'action' => ['index','listServices']
		],
		[
			'role' => 'user',
			'controller' => 'Visits',
			'action' => ['index','add','edit','view'],
		]
	]
];