<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClassSchedule Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Days
 * @property \Cake\ORM\Association\BelongsTo $Subjects
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Shifts
 *
 * @method \App\Model\Entity\ClassSchedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClassSchedule newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ClassSchedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClassSchedule|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClassSchedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClassSchedule[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClassSchedule findOrCreate($search, callable $callback = null, $options = [])
 */
class ClassScheduleTable extends Table
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

        $this->table('class_schedule');
        $this->displayField('id_class_schedule');
        $this->primaryKey('id_class_schedule');

        $this->belongsTo('Days', [
            'foreignKey' => 'day_id'
        ]);
        
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id'
        ]);
        
        $this->belongsTo('employees', [
            'foreignKey' => 'teacher_id'
        ]);
        
        $this->belongsTo('classes_sections', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER'
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
            ->integer('id_class_schedule')
            ->allowEmpty('id_class_schedule', 'create');

//        $validator
//            ->time('start_time')
//            ->allowEmpty('start_time');
//
//        $validator
//            ->time('end_time')
//            ->allowEmpty('end_time');

//        $validator
//            ->allowEmpty('desc');

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
//        $rules->add($rules->existsIn(['day_id'], 'Days'));
//        $rules->add($rules->existsIn(['subject_id'], 'Subjects'));
//        $rules->add($rules->existsIn(['class_id'], 'Classes'));
//        $rules->add($rules->existsIn(['shift_id'], 'Shifts'));
//
//        return $rules;
//    }
}
