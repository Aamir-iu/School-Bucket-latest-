<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Concession Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Registrations
 * @property \Cake\ORM\Association\BelongsTo $Campuses
 *
 * @method \App\Model\Entity\Concession get($primaryKey, $options = [])
 * @method \App\Model\Entity\Concession newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Concession[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Concession|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Concession patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Concession[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Concession findOrCreate($search, callable $callback = null)
 */
class ConcessionTable extends Table
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

        $this->table('concession');
        $this->displayField('id_concession');
        $this->primaryKey('id_concession');

        $this->belongsTo('Registration', [
            'foreignKey' => 'registration_id'
        ]);
        $this->belongsTo('StudentsMasterDetails', [
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
            ->integer('id_concession')
            ->allowEmpty('id_concession', 'create');

        $validator
            ->decimal('amount')
            ->allowEmpty('amount');

        $validator
            ->decimal('fine')
            ->allowEmpty('fine');

       

      

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
//    public function buildRules(RulesChecker $rules)
//    {
//        $rules->add($rules->existsIn(['registration_id'], 'Registrations'));
//        $rules->add($rules->existsIn(['campus_id'], 'Campuses'));
//
//        return $rules;
//    }
}
