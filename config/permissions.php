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
        /*[
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
            'role' => '*',
            'controller' => 'Visits',
            'action' => ['add'],
        ],
        [
            'role' => 'user',
            'controller' => 'Clubs',
            'action' => ['edit','view'],
            'allowed' => new \CakeDC\Auth\Rbac\Rules\Owner(['table' => 'clubs_users','id'=> 'club_id'])
        ],
        [
            'role' => '*',
            'controller' => 'ServicesDays',
            'action' => ['listServicesDays']
        ]*/
    ]
];
