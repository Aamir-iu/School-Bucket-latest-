<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DailyDiary Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Shifts
 *
 * @method \App\Model\Entity\DailyDiary get($primaryKey, $options = [])
 * @method \App\Model\Entity\DailyDiary newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DailyDiary[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DailyDiary|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DailyDiary patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DailyDiary[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DailyDiary findOrCreate($search, callable $callback = null)
 */
class DailyDiaryTable extends Table
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

        $this->table('daily_diary');
        $this->displayField('id_daily_diary');
        $this->primaryKey('id_daily_diary');

        $this->belongsTo('ClassesSections', [
            'foreignKey' => 'class_id'
        ]);
        $this->belongsTo('Shift', [
            'foreignKey' => 'shift_id'
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
            ->integer('id_daily_diary')
            ->allowEmpty('id_daily_diary', 'create');
//
//        $validator
//            ->allowEmpty('desc');

//        $validator
//            ->allowEmpty('addiotion');

//        $validator
//            ->dateTime('date')
//            ->allowEmpty('date');

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
   
}
