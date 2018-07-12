<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExamTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $ExamMarksDetails
 * @property \Cake\ORM\Association\HasMany $ExamResultGo
 * @property \Cake\ORM\Association\HasMany $ExamResults
 *
 * @method \App\Model\Entity\ExamType get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExamType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ExamType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExamType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExamType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExamType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExamType findOrCreate($search, callable $callback = null, $options = [])
 */
class ExamTypesTable extends Table
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

        $this->table('exam_types');
        $this->displayField('id_exam_types');
        $this->primaryKey('id_exam_types');

        $this->hasMany('ExamMarksDetails', [
            'foreignKey' => 'exam_type_id'
        ]);
        $this->hasMany('ExamResultGo', [
            'foreignKey' => 'exam_type_id'
        ]);
        $this->hasMany('ExamResults', [
            'foreignKey' => 'exam_type_id'
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
            ->integer('id_exam_types')
            ->allowEmpty('id_exam_types', 'create');

        $validator
            ->allowEmpty('exam_type');

        return $validator;
    }
}
