<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Registrations
 * @property \Cake\ORM\Association\BelongsTo $Campuses
 * @property \Cake\ORM\Association\BelongsTo $Sessions
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Shifts
 *
 * @method \App\Model\Entity\Fee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Fee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fee findOrCreate($search, callable $callback = null)
 */
class FeesTable extends Table
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

        $this->table('fees');
        $this->displayField('id_fees');
        $this->primaryKey('id_fees');

        $this->belongsTo('Registrations', [
            'foreignKey' => 'registration_id'
        ]);
        
        $this->belongsTo('Shifts', [
            'foreignKey' => 'shift_id'
        ]);
        $this->belongsTo('Sessions', [
            'foreignKey' => 'session_id'
        ]);
        
         $this->belongsTo('months', [
            'foreignKey' => 'fee_month'
        ]);
         
        $this->belongsTo('fee_types', [
            'foreignKey' => 'fee_type_id'
        ]);
        
           
        $this->belongsTo('registration', [
            'foreignKey' => 'registration_id'
        ]); 
        
        $this->belongsTo('classes_sections', [
            'foreignKey' => 'class_id'
        ]); 
        $this->belongsTo('shift', [
            'foreignKey' => 'shift_id'
        ]); 
        
        $this->belongsTo('session', [
            'foreignKey' => 'session_id'
        ]); 
        
        $this->belongsTo('campuses', [
            'foreignKey' => 'campus_id'
        ]); 
        
        $this->belongsTo('users', [
            'foreignKey' => 'created_by'
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
            ->integer('id_fees')
            ->allowEmpty('id_fees', 'create');

        $validator
            ->integer('inv_no')
            ->allowEmpty('inv_no');

        $validator
            ->integer('fee_month')
            ->allowEmpty('fee_month');

        $validator
            ->integer('year')
            ->allowEmpty('year');

        $validator
            ->decimal('amount')
            ->allowEmpty('amount');

        $validator
            ->integer('fee_type')
            ->allowEmpty('fee_type');

        $validator
            ->dateTime('fee_date')
            ->allowEmpty('fee_date');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
//    public function buildRules(RulesChecker $rules)
//    {
//        $rules->add($rules->existsIn(['registration_id'], 'Registrations'));
//        $rules->add($rules->existsIn(['campus_id'], 'Campuses'));
//        $rules->add($rules->existsIn(['session_id'], 'Sessions'));
//        $rules->add($rules->existsIn(['class_id'], 'Classes'));
//        $rules->add($rules->existsIn(['shift_id'], 'Shifts'));
//
//        return $rules;
//    }
}
