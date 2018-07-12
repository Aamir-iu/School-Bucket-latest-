<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PoDetails Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Pos
 * @property \Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\PoDetails get($primaryKey, $options = [])
 * @method \App\Model\Entity\PoDetails newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PoDetails[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PoDetails|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PoDetails patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PoDetails[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PoDetails findOrCreate($search, callable $callback = null)
 */
class PoDetailsTable extends Table
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

        $this->table('po_details');
        $this->displayField('id_po_details');
        $this->primaryKey('id_po_details');

        $this->belongsTo('PurchaseOrders', [
            'foreignKey' => 'id_purchase_orders'
        ]);
        
        $this->belongsTo('Products', [
            'foreignKey' => 'id_products'
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
            ->integer('id_po_details')
            ->allowEmpty('id_po_details', 'create');

        $validator
            ->allowEmpty('po_number');

        $validator
            ->allowEmpty('product_name');

        $validator
            ->integer('qty')
            ->allowEmpty('qty');

        $validator
            ->decimal('price')
            ->allowEmpty('price');

        $validator
            ->decimal('total')
            ->allowEmpty('total');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['po_id'], 'PurchaseOrders'));
        $rules->add($rules->existsIn(['product_id'], 'Products'));

        return $rules;
    }
}
