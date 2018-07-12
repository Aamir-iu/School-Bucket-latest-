<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmployeeSalary Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Employees
 *
 * @method \App\Model\Entity\EmployeeSalary get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmployeeSalary newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmployeeSalary[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeSalary|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmployeeSalary patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeSalary[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeSalary findOrCreate($search, callable $callback = null, $options = [])
 */
class EmployeeSalaryTable extends Table
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

        $this->table('employee_salary');
        $this->displayField('id_employee_salary');
        $this->primaryKey('id_employee_salary');

        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id'
        ]);
        
        $this->belongsTo('Departments', [
            'foreignKey' => 'id_department'
        ]);
        
        $this->belongsTo('months', [
            'foreignKey' => 'salary_month'
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
            ->integer('id_employee_salary')
            ->allowEmpty('id_employee_salary', 'create');

        $validator
            ->decimal('basic_salary')
            ->allowEmpty('basic_salary');

        $validator
            ->integer('working_days')
            ->allowEmpty('working_days');

        $validator
            ->decimal('per_day_salary')
            ->allowEmpty('per_day_salary');

        $validator
            ->decimal('extra_amount')
            ->allowEmpty('extra_amount');

        $validator
            ->decimal('late')
            ->allowEmpty('late');

        $validator
            ->decimal('absents')
            ->allowEmpty('absents');

        $validator
            ->decimal('detect_salary')
            ->allowEmpty('detect_salary');

        $validator
            ->decimal('installment')
            ->allowEmpty('installment');

        $validator
            ->decimal('gross_salary')
            ->allowEmpty('gross_salary');

        $validator
            ->decimal('PFA')
            ->allowEmpty('PFA');

        $validator
            ->decimal('Net_salary')
            ->allowEmpty('Net_salary');

        $validator
            ->integer('salary_month')
            ->allowEmpty('salary_month');

        $validator
            ->integer('salary_year')
            ->allowEmpty('salary_year');

//        $validator
//            ->dateTime('salary_date')
//            ->allowEmpty('salary_date');

//        $validator
//            ->dateTime('created_on')
//            ->requirePresence('created_on', 'create')
//            ->notEmpty('created_on');
//
//        $validator
//            ->integer('created_by')
//            ->allowEmpty('created_by');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['employee_id'], 'Employees'));

        return $rules;
    }
}
