<?php


namespace App\Model\Table;

use CakeDC\Users\Model\Table\UsersTable as CakeUsersTable;

class UsersTable extends CakeUsersTable{

	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->setDisplayField('email');
	}

}