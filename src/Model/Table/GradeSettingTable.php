<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GradeSetting Model
 *
 * @method \App\Model\Entity\GradeSetting get($primaryKey, $options = [])
 * @method \App\Model\Entity\GradeSetting newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GradeSetting[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GradeSetting|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GradeSetting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GradeSetting[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GradeSetting findOrCreate($search, callable $callback = null, $options = [])
 */
class GradeSettingTable extends Table
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

        $this->table('grade_setting');
        $this->displayField('id_grades');
        $this->primaryKey('id_grades');
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
            ->integer('id_grades')
            ->allowEmpty('id_grades', 'create');

        $validator
            ->decimal('per')
            ->allowEmpty('per');

        $validator
            ->decimal('per_i')
            ->allowEmpty('per_i');

        $validator
            ->decimal('per_ii')
            ->allowEmpty('per_ii');

        $validator
            ->decimal('per_iii')
            ->allowEmpty('per_iii');

        $validator
            ->decimal('per_iv')
            ->allowEmpty('per_iv');

        $validator
            ->decimal('per_v')
            ->allowEmpty('per_v');

        $validator
            ->decimal('per_vi')
            ->allowEmpty('per_vi');

        $validator
            ->decimal('per_vii')
            ->allowEmpty('per_vii');

        $validator
            ->allowEmpty('grade');

        $validator
            ->allowEmpty('grade_i');

        $validator
            ->allowEmpty('grade_ii');

        $validator
            ->allowEmpty('grade_iii');

        $validator
            ->allowEmpty('grade_iv');

        $validator
            ->allowEmpty('grade_v');

        $validator
            ->allowEmpty('grade_vi');

        $validator
            ->allowEmpty('grade_vii');

        return $validator;
    }
}
