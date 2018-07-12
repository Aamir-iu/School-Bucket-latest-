<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StudentsMasterDetails Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Registrations
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Shifts
 * @property \Cake\ORM\Association\BelongsTo $Sessions
 * @property \Cake\ORM\Association\BelongsTo $Campuses
 *
 * @method \App\Model\Entity\StudentsMasterDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\StudentsMasterDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StudentsMasterDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StudentsMasterDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StudentsMasterDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StudentsMasterDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StudentsMasterDetail findOrCreate($search, callable $callback = null)
 */
class StudentsMasterDetailsTable extends Table
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

        $this->table('students_master_details');
        $this->displayField('id_master_details');
        $this->primaryKey('id_master_details');

        $this->belongsTo('registration', [
            'foreignKey' => 'registration_id'
        ]);
        $this->belongsTo('classes_sections', [
            'foreignKey' => 'class_id'
        ]);
        
        $this->belongsTo('shift', [
            'foreignKey' => 'shift_id'
        ]);
        
        $this->belongsTo('campuses', [
            'foreignKey' => 'campus_id'
        ]);
        
        $this->hasMany('admin_card_datesheet', [
            'foreignKey' => 'class_id'
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
            ->integer('id_master_details')
            ->allowEmpty('id_master_details', 'create');

        $validator
            ->integer('roll_no')
            ->allowEmpty('roll_no');

        $validator
            ->time('class_start_time')
            ->allowEmpty('class_start_time');

        $validator
            ->time('class_end_time')
            ->allowEmpty('class_end_time');

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
//        $rules->add($rules->existsIn(['class_id'], 'Classes'));
//        $rules->add($rules->existsIn(['shift_id'], 'Shifts'));
//        $rules->add($rules->existsIn(['session_id'], 'Sessions'));
//        $rules->add($rules->existsIn(['campus_id'], 'Campuses'));
//
//        return $rules;
//    }
}
