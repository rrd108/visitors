<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Services Model
 *
 * @property \App\Model\Table\VisitsTable|\Cake\ORM\Association\BelongsToMany $Visits
 *
 * @method \App\Model\Entity\Service get($primaryKey, $options = [])
 * @method \App\Model\Entity\Service newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Service[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Service|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Service|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Service patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Service[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Service findOrCreate($search, callable $callback = null, $options = [])
 */
class ServicesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('services');
        $this->setDisplayField('service');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Visits', [
            'foreignKey' => 'service_id',
            'targetForeignKey' => 'visit_id',
            'joinTable' => 'services_visits'
        ]);

	    $this->hasMany('ServicesVisits',[
		    'foreignKey' => 'service_id'
	    ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('service')
            ->maxLength('service', 255)
            ->requirePresence('service', 'create')
            ->notEmpty('service');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->requirePresence('minutes', 'create')
            ->notEmpty('minutes');

        $validator
            ->requirePresence('full_price', 'create')
            ->notEmpty('full_price');

        $validator
            ->allowEmpty('discount_price');

        return $validator;
    }
}
