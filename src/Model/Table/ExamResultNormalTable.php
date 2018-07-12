<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExamResultNormal Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Registrations
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Shifts
 * @property \Cake\ORM\Association\BelongsTo $Sessions
 * @property \Cake\ORM\Association\BelongsTo $ExamTypes
 * @property \Cake\ORM\Association\BelongsTo $Subjects
 *
 * @method \App\Model\Entity\ExamResultNormal get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExamResultNormal newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ExamResultNormal[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExamResultNormal|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExamResultNormal patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExamResultNormal[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExamResultNormal findOrCreate($search, callable $callback = null, $options = [])
 */
class ExamResultNormalTable extends Table
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

        $this->table('exam_result_normal');
        $this->displayField('id_exam_marks');
        $this->primaryKey('id_exam_marks');

        $this->belongsTo('Registration', [
            'foreignKey' => 'registration_id'
        ]);
        $this->belongsTo('classes_sections', [
            'foreignKey' => 'class_id'
        ]);
        $this->belongsTo('Shift', [
            'foreignKey' => 'shift_id'
        ]);
        $this->belongsTo('Session', [
            'foreignKey' => 'session_id'
        ]);
        $this->belongsTo('exam_types', [
            'foreignKey' => 'exam_type_id'
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id'
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
            ->integer('id_exam_marks')
            ->allowEmpty('id_exam_marks', 'create');

        $validator
            ->allowEmpty('max_marks');

        $validator
            ->allowEmpty('min_marks');

        $validator
            ->allowEmpty('obtained_marks');

        $validator
            ->decimal('total_marks')
            ->allowEmpty('total_marks');

        $validator
            ->decimal('total_obtained')
            ->allowEmpty('total_obtained');

        $validator
            ->decimal('per')
            ->allowEmpty('per');

        $validator
            ->allowEmpty('grade');

        $validator
            ->allowEmpty('rank');

        $validator
            ->allowEmpty('remarks');

        $validator
            ->integer('total_attetance')
            ->allowEmpty('total_attetance');

        $validator
            ->integer('marks_attendance')
            ->allowEmpty('marks_attendance');

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
//        $rules->add($rules->existsIn(['exam_type_id'], 'ExamTypes'));
//        $rules->add($rules->existsIn(['subject_id'], 'Subjects'));
//
//        return $rules;
//    }
}
