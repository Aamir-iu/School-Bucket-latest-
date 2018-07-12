<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurchaseOrders Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Suppliers
 * @property \Cake\ORM\Association\BelongsTo $PurchaseOrderStatuses
 * @property \Cake\ORM\Association\BelongsTo $PurchaseOrderConditions
 *
 * @method \App\Model\Entity\PurchaseOrders get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseOrders newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseOrders[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrders|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseOrders patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrders[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrders findOrCreate($search, callable $callback = null)
 */
class PurchaseOrdersTable extends Table
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

        $this->table('purchase_orders');
        $this->displayField('id_purchase_orders');
        $this->primaryKey('id_purchase_orders');

        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id'
        ]);
        
        $this->hasMany('PoDetails', [
            'foreignKey' => 'po_id'
        ]);
        
        $this->belongsTo('PoStatus', [
            'foreignKey' => 'id_po_status'
        ]);   
        
        $this->belongsTo('PoCondition', [
            'foreignKey' => 'id_po_condition'
        ]); 
        
        $this->hasMany('PoGrn', [
            'foreignKey' => 'po_id'
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
            ->integer('id_purchase_orders')
            ->allowEmpty('id_purchase_orders', 'create');

        $validator
            ->allowEmpty('purchase_order_number');

        $validator
            ->allowEmpty('supplier_name');

        $validator
            ->dateTime('purchase_order_date')
            ->allowEmpty('purchase_order_date');

        $validator
            ->allowEmpty('purchase_order_status');

        $validator
            ->allowEmpty('purchase_order_condition');

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
        $rules->add($rules->existsIn(['supplier_id'], 'Suppliers'));

        return $rules;
    }
    
   

    
}
