<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeeHeads Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Classes
 *
 * @method \App\Model\Entity\FeeHead get($primaryKey, $options = [])
 * @method \App\Model\Entity\FeeHead newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FeeHead[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FeeHead|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeHead patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FeeHead[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FeeHead findOrCreate($search, callable $callback = null)
 */
class FeeHeadsTable extends Table
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

        $this->table('fee_heads');
        $this->displayField('id_fee_heads');
        $this->primaryKey('id_fee_heads');

        $this->belongsTo('fee_types', [
            'foreignKey' => 'fee_type_id'
        ]);
     
        $this->belongsTo('classes_sections', [
            'foreignKey' => 'class_id'
        ]); 
        $this->belongsTo('shift', [
            'foreignKey' => 'shift_id'
        ]); 
      
        $this->belongsTo('campuses', [
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
            ->integer('id_fee_heads')
            ->allowEmpty('id_fee_heads', 'create');

      

        $validator
            ->decimal('class_fees')
            ->allowEmpty('class_fees');

        $validator
            ->decimal('fine')
            ->allowEmpty('fine');

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
   
}
