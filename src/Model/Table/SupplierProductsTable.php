<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SupplierProducts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Focs
 *
 * @method \App\Model\Entity\SupplierProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\SupplierProduct newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SupplierProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SupplierProduct|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SupplierProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SupplierProduct[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SupplierProduct findOrCreate($search, callable $callback = null)
 */
class SupplierProductsTable extends Table
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

        $this->table('supplier_products');
        $this->displayField('id_supplier_products');
        $this->primaryKey('id_supplier_products');

        
        $this->belongsTo('suppliers', [
            'foreignKey' => 'id_suppliers'
        ]);
        
        $this->belongsTo('products', [
            'foreignKey' => 'id_products'
        ]);
        
         $this->belongsTo('users', [
            'foreignKey' => 'created_by'
        ]);
        
        $this->hasMany('foc', [
            'foreignKey' => 'supplier_product_id'
        ]);
        
        $this->hasMany('packing_types', [
            'foreignKey' => 'packaging_id'
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
            ->integer('id_supplier_products')
            ->allowEmpty('id_supplier_products', 'create');

        $validator
            ->integer('id_suppliers')
            ->allowEmpty('id_suppliers');

        $validator
            ->integer('id_products')
            ->allowEmpty('id_products');

        $validator
            ->integer('packaging_type')
            ->allowEmpty('packaging_type');

        $validator
            ->decimal('units_per_pack')
            ->allowEmpty('units_per_pack');

        $validator
            ->decimal('pack_price')
            ->allowEmpty('pack_price');

        $validator
            ->decimal('unit_price')
            ->allowEmpty('unit_price');

        $validator
            ->allowEmpty('active');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

//        $validator
//            ->dateTime('created_on')
//            ->requirePresence('created_on', 'create')
//            ->notEmpty('created_on');

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
//        $rules->add($rules->existsIn(['foc_id'], 'Focs'));
//
//        return $rules;
//    }
    
}
