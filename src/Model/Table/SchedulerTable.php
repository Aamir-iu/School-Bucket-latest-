<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Scheduler Model
 *
 * @method \App\Model\Entity\Scheduler get($primaryKey, $options = [])
 * @method \App\Model\Entity\Scheduler newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Scheduler[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Scheduler|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Scheduler patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Scheduler[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Scheduler findOrCreate($search, callable $callback = null, $options = [])
 */
class SchedulerTable extends Table
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

        $this->table('scheduler');
        $this->displayField('id_scheduler');
        $this->primaryKey('id_scheduler');
        
        $this->belongsTo('employees', [
            'foreignKey' => 'staff_id'
        ]);
        
        $this->belongsTo('subjects', [
            'foreignKey' => 'subject_id'
        ]);
        $this->belongsTo('classes_sections', [
            'foreignKey' => 'class_id'
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
//        $validator
//            ->integer('id_scheduler')
//            ->allowEmpty('id_scheduler', 'create');

//        $validator
//            ->dateTime('start_time')
//            ->allowEmpty('start_time');
//
//        $validator
//            ->dateTime('end_time')
//            ->allowEmpty('end_time');

        return $validator;
    }
}
