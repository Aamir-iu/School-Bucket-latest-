<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PoGrnDetail Model
 *
 * @property \Cake\ORM\Association\BelongsTo $PoGrns
 * @property \Cake\ORM\Association\BelongsTo $GrnProducts
 *
 * @method \App\Model\Entity\PoGrnDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\PoGrnDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PoGrnDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PoGrnDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PoGrnDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PoGrnDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PoGrnDetail findOrCreate($search, callable $callback = null)
 */
class PoGrnDetailTable extends Table
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

        $this->table('po_grn_detail');
        $this->displayField('id_po_grn_detail');
        $this->primaryKey('id_po_grn_detail');

        $this->belongsTo('PoGrn', [
            'foreignKey' => 'po_grn_id'
        ]);
        
        $this->belongsTo('Products', [
            'foreignKey' => 'grn_product_id'
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
            ->integer('id_po_grn_detail')
            ->allowEmpty('id_po_grn_detail', 'create');

        $validator
            ->allowEmpty('grn_product_name');

        $validator
            ->integer('received_pack_qty')
            ->allowEmpty('received_pack_qty');

        $validator
            ->integer('received_units_per_pack')
            ->allowEmpty('received_units_per_pack');

        $validator
            ->numeric('received_pack_price')
            ->allowEmpty('received_pack_price');

        $validator
            ->numeric('received_unit_price')
            ->allowEmpty('received_unit_price');

        $validator
            ->dateTime('created_on')
            ->allowEmpty('created_on');

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
//        $rules->add($rules->existsIn(['po_grn_id'], 'PoGrns'));
//        $rules->add($rules->existsIn(['grn_product_id'], 'GrnProducts'));
//
//        return $rules;
//    }
}
