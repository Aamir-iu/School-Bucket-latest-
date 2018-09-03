<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Holiday Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Registrations
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Shifts
 * @property \Cake\ORM\Association\BelongsTo $Campuses
 *
 * @method \App\Model\Entity\Holiday get($primaryKey, $options = [])
 * @method \App\Model\Entity\Holiday newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Holiday[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Holiday|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Holiday patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Holiday[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Holiday findOrCreate($search, callable $callback = null)
 */
class HolidayTable extends Table
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

        $this->table('holiday');
        $this->displayField('holiday_id');
        $this->primaryKey('holiday_id');

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
            ->integer('holiday_id')
            ->allowEmpty('holiday_id', 'create');

       /* $validator
            ->allowEmpty('status');

        $validator
            ->date('attendace_date')
            ->allowEmpty('attendace_date');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');*/

       
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
