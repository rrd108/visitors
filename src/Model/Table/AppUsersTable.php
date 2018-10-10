<?php


namespace App\Model\Table;
use Cake\Validation\Validator;

use CakeDC\Users\Model\Table\UsersTable;

use Cake\Core\Configure;

class AppUsersTable extends UsersTable{

	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->setDisplayField('email');
	}

	public function validationDefault(Validator $validator)
	{
		$validator = parent::validationDefault($validator);
		$username = Configure::read('Auth.authenticate.Form.fields.username');
		if ($username === 'email') {
			$validator->remove('username');
		}
		return $validator;
	}

}