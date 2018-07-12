<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Complains Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Campuses
 * @property \Cake\ORM\Association\BelongsTo $Departments
 * @property \Cake\ORM\Association\BelongsTo $Registrations
 *
 * @method \App\Model\Entity\Complain get($primaryKey, $options = [])
 * @method \App\Model\Entity\Complain newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Complain[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Complain|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Complain patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Complain[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Complain findOrCreate($search, callable $callback = null, $options = [])
 */
class ComplainsTable extends Table
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

        $this->table('complains');
        $this->displayField('id_complain');
        $this->primaryKey('id_complain');

        $this->belongsTo('Campuses', [
            'foreignKey' => 'campus_id'
        ]);
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id'
        ]);
        $this->belongsTo('Registration', [
            'foreignKey' => 'registration_id'
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
            ->integer('id_complain')
            ->allowEmpty('id_complain', 'create');

        $validator
            ->allowEmpty('complain');

        $validator
            ->dateTime('comp_date')
            ->requirePresence('comp_date', 'create')
            ->notEmpty('comp_date');

        $validator
            ->allowEmpty('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
   
}
