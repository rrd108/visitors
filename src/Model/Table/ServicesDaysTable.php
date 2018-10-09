<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ServicesDays Model
 *
 * @method \App\Model\Entity\ServicesDay get($primaryKey, $options = [])
 * @method \App\Model\Entity\ServicesDay newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ServicesDay[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ServicesDay|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ServicesDay|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ServicesDay patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ServicesDay[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ServicesDay findOrCreate($search, callable $callback = null, $options = [])
 */
class ServicesDaysTable extends Table
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

        $this->setTable('services_days');
        $this->setDisplayField('date');
        $this->setPrimaryKey('id');
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
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        return $validator;
    }
}
