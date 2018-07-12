<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExamResults Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Shifts
 * @property \Cake\ORM\Association\BelongsTo $ExamTypes
 * @property \Cake\ORM\Association\BelongsTo $Subjects
 *
 * @method \App\Model\Entity\ExamResult get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExamResult newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ExamResult[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExamResult|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExamResult patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExamResult[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExamResult findOrCreate($search, callable $callback = null, $options = [])
 */
class ExamResultsTable extends Table
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

        $this->table('exam_results');
        $this->displayField('id_exam');
        $this->primaryKey('id_exam');

        $this->belongsTo('Registration', [
            'foreignKey' => 'registration_id'
        ]);
        $this->belongsTo('classes_sections', [
            'foreignKey' => 'class_id'
        ]);
        
        $this->belongsTo('shift', [
            'foreignKey' => 'shift_id'
        ]);
      
        $this->belongsTo('exam_types', [
            'foreignKey' => 'exam_type_id'
        ]);
      
        $this->belongsTo('session', [
            'foreignKey' => 'session_id'
        ]);
        
        $this->hasMany('exam_result_detail', [
            'foreignKey' => 'exam_result_id'
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
            ->integer('id_exam')
            ->allowEmpty('id_exam', 'create');


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
