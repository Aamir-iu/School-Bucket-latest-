<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StudentAttendance Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Registrations
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Shifts
 * @property \Cake\ORM\Association\BelongsTo $Campuses
 *
 * @method \App\Model\Entity\StudentAttendance get($primaryKey, $options = [])
 * @method \App\Model\Entity\StudentAttendance newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StudentAttendance[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StudentAttendance|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StudentAttendance patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StudentAttendance[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StudentAttendance findOrCreate($search, callable $callback = null)
 */
class StudentAttendanceTable extends Table
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

        $this->table('student_attendance');
        $this->displayField('id_attendance');
        $this->primaryKey('id_attendance');

        $this->belongsTo('Registrations', [
            'foreignKey' => 'registration_id'
        ]);
        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id'
        ]);
        $this->belongsTo('Shifts', [
            'foreignKey' => 'shift_id'
        ]);
        $this->belongsTo('Campuses', [
            'foreignKey' => 'campus_id'
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
            ->allowEmpty('status');

        $validator
            ->date('attendace_date')
            ->allowEmpty('attendace_date');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

       
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
