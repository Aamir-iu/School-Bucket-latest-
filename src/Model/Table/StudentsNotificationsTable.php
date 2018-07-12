<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StudentsNotifications Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Notifications
 * @property \Cake\ORM\Association\BelongsTo $Registrations
 *
 * @method \App\Model\Entity\StudentsNotification get($primaryKey, $options = [])
 * @method \App\Model\Entity\StudentsNotification newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StudentsNotification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StudentsNotification|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StudentsNotification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StudentsNotification[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StudentsNotification findOrCreate($search, callable $callback = null, $options = [])
 */
class StudentsNotificationsTable extends Table
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

        $this->table('students_notifications');
        $this->displayField('id_student_notifications');
        $this->primaryKey('id_student_notifications');

        $this->belongsTo('MobileNotifications', [
            'foreignKey' => 'notification_id'
        ]);
        
        $this->belongsTo('Registration', [
            'foreignKey' => 'registration_id'
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
            ->integer('id_student_notifications')
            ->allowEmpty('id_student_notifications', 'create');

        $validator
            ->allowEmpty('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
 //   public function buildRules(RulesChecker $rules)
//    {
//        $rules->add($rules->existsIn(['notification_id'], 'Notifications'));
//        $rules->add($rules->existsIn(['registration_id'], 'Registrations'));
//
//        return $rules;
//    }
}
