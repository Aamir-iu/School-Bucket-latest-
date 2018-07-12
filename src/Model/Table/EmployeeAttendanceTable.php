<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmployeeAttendance Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Employees
 *
 * @method \App\Model\Entity\EmployeeAttendance get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmployeeAttendance newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmployeeAttendance[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeAttendance|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmployeeAttendance patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeAttendance[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeAttendance findOrCreate($search, callable $callback = null, $options = [])
 */
class EmployeeAttendanceTable extends Table
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

        $this->table('employee_attendance');
        $this->displayField('id_attendance');
        $this->primaryKey('id_attendance');

        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id'
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
            ->integer('id_attendance')
            ->allowEmpty('id_attendance', 'create');

        $validator
            ->integer('id_department')
            ->allowEmpty('id_department');

        $validator
            ->allowEmpty('status');

        $validator
            ->date('attendace_date')
            ->allowEmpty('attendace_date');

        $validator
            ->time('attendance_time')
            ->allowEmpty('attendance_time');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

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
