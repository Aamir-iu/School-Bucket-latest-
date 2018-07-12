<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Campuses Model
 *
 * @property \Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Campus get($primaryKey, $options = [])
 * @method \App\Model\Entity\Campus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Campus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Campus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Campus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Campus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Campus findOrCreate($search, callable $callback = null)
 */
class CampusesTable extends Table
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

        $this->table('campuses');
        $this->displayField('id_campus');
        $this->primaryKey('id_campus');

        $this->hasMany('Users', [
            'foreignKey' => 'campus_id'
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
            ->integer('id_campus')
            ->allowEmpty('id_campus', 'create');

        $validator
            ->allowEmpty('campus_name');

        $validator
            ->allowEmpty('campus_location');

        $validator
            ->allowEmpty('campus_principle');

        $validator
            ->allowEmpty('campus_contact');

        $validator
            ->allowEmpty('campus_contact2');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        return $validator;
    }
}
