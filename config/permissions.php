<?php
use Cake\Utility\Hash;
use Cake\Network\Request;
use App\Model\Entity\Visit;
use App\Model\Table\VisitsTable;

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
			'action' => ['index','add'],
		],
		[
			'role' => 'user',
			'controller' => 'Visits',
			'action' => ['edit','view']
		],
		[
			'role' => '*',
			'controller' => 'ServicesDays',
			'action' => ['listServicesDays']
		]
	]
];