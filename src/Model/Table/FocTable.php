<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Foc Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Suppliers
 * @property \Cake\ORM\Association\HasMany $SupplierProducts
 *
 * @method \App\Model\Entity\Foc get($primaryKey, $options = [])
 * @method \App\Model\Entity\Foc newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Foc[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Foc|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Foc patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Foc[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Foc findOrCreate($search, callable $callback = null)
 */
class FocTable extends Table
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

        $this->table('foc');
        $this->displayField('id_foc');
        $this->primaryKey('id_foc');

        $this->belongsTo('SupplierProducts', [
            'foreignKey' => 'supplier_product_id'
            
        ]);
        
        $this->belongsTo('products', [
             'foreignKey' => 'foc_product'
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
            ->integer('id_foc')
            ->allowEmpty('id_foc', 'create');

        $validator
            ->integer('foc_for')
            ->allowEmpty('foc_for');

        $validator
            ->integer('foc_for_qty')
            ->allowEmpty('foc_for_qty');

        $validator
            ->integer('foc_product')
            ->allowEmpty('foc_product');

        $validator
            ->integer('foc_product_qty')
            ->allowEmpty('foc_product_qty');

        $validator
            ->allowEmpty('active');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');
        
        $validator
            ->integer('supplier_product_id')
            ->allowEmpty('supplier_product_id');
        

       
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
