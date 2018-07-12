<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AdminCardDatesheet Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Shifts
 * @property \Cake\ORM\Association\BelongsTo $Subjects
 *
 * @method \App\Model\Entity\AdminCardDatesheet get($primaryKey, $options = [])
 * @method \App\Model\Entity\AdminCardDatesheet newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AdminCardDatesheet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AdminCardDatesheet|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AdminCardDatesheet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AdminCardDatesheet[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AdminCardDatesheet findOrCreate($search, callable $callback = null, $options = [])
 */
class AdminCardDatesheetTable extends Table
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

        $this->table('admin_card_datesheet');
        $this->displayField('id_time_table');
        $this->primaryKey('id_time_table');

        $this->belongsTo('classes_sections', [
            'foreignKey' => 'class_id'
        ]);
        $this->belongsTo('Shifts', [
            'foreignKey' => 'shift_id'
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
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id_time_table')
            ->allowEmpty('id_time_table', 'create');

        $validator
            ->dateTime('date')
            ->allowEmpty('date');

        $validator
            ->allowEmpty('time');

        $validator
            ->allowEmpty('day');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

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
    //public function buildRules(RulesChecker $rules)
//    {
//        $rules->add($rules->existsIn(['class_id'], 'Classes'));
//        $rules->add($rules->existsIn(['shift_id'], 'Shifts'));
//        $rules->add($rules->existsIn(['subject_id'], 'Subjects'));
//
//        return $rules;
//    }
}
