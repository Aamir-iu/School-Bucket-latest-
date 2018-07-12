<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExamMarksDetails Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Shifts
 * @property \Cake\ORM\Association\BelongsTo $Sessions
 * @property \Cake\ORM\Association\BelongsTo $Subjects
 *
 * @method \App\Model\Entity\ExamMarksDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExamMarksDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ExamMarksDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExamMarksDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExamMarksDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExamMarksDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExamMarksDetail findOrCreate($search, callable $callback = null, $options = [])
 */
class ExamMarksDetailsTable extends Table
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

        $this->table('exam_marks_details');
        $this->displayField('id_marks_detail');
        $this->primaryKey('id_marks_detail');

        $this->belongsTo('classes_sections', [
            'foreignKey' => 'class_id'
        ]);
      
       
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id'
        ]);
        
        $this->belongsTo('exam_types', [
            'foreignKey' => 'exam_type_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
//    public function validationDefault(Validator $validator)
//    {
//        $validator
//            ->integer('id_marks_detail')
//            ->allowEmpty('id_marks_detail', 'create');
//
//      
//
//        return $validator;
//    }

    
}
