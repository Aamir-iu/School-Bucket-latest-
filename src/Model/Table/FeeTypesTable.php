<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeeTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $Concession
 * @property \Cake\ORM\Association\HasMany $Dues
 * @property \Cake\ORM\Association\HasMany $FeeHeads
 * @property \Cake\ORM\Association\HasMany $Fees
 *
 * @method \App\Model\Entity\FeeType get($primaryKey, $options = [])
 * @method \App\Model\Entity\FeeType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FeeType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FeeType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FeeType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FeeType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FeeType findOrCreate($search, callable $callback = null)
 */
class FeeTypesTable extends Table
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

        $this->table('fee_types');
        $this->displayField('id_fee_type');
        $this->primaryKey('id_fee_type');

        $this->hasMany('Concession', [
            'foreignKey' => 'fee_type_id'
        ]);
        $this->hasMany('Dues', [
            'foreignKey' => 'fee_type_id'
        ]);
        $this->hasMany('FeeHeads', [
            'foreignKey' => 'fee_type_id'
        ]);
        $this->hasMany('Fees', [
            'foreignKey' => 'fee_type_id'
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
            ->integer('id_fee_type')
            ->allowEmpty('id_fee_type', 'create');

        $validator
            ->allowEmpty('fee_type_name');

        $validator
            ->allowEmpty('status');

        return $validator;
    }
}
