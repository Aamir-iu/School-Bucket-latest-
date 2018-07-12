<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Employees
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Employee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Employee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee findOrCreate($search, callable $callback = null)
 */
class EmployeesTable extends Table
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

        $this->table('employees');
        $this->displayField('employee_id');
        $this->primaryKey('employee_id');


        
        $this->belongsTo('Users', [
            'foreignKey' => 'employee_created_by'
        ]);
        
       

        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id'
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
            ->allowEmpty('employee_name');

        $validator
            ->allowEmpty('employee_address');

        $validator
            ->allowEmpty('employee_no');
        
        $validator
            ->allowEmpty('department_id');

        $validator
            ->allowEmpty('employee_email');

        $validator
            ->allowEmpty('employee_phone1');

        $validator
            ->allowEmpty('employee_phone2');

        $validator
            ->allowEmpty('employee_pic');

        $validator
            ->integer('employee_created_by')
            ->allowEmpty('employee_created_by');

        $validator
            ->dateTime('employee_created_on')
            ->requirePresence('employee_created_on', 'create')
            ->notEmpty('employee_created_on');

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
//        $rules->add($rules->existsIn(['employee_id'], 'Employees'));
//        $rules->add($rules->existsIn(['user_id'], 'Users'));
//
//        return $rules;
//    }
}
