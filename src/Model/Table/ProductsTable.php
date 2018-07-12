<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, callable $callback = null)
 */
class ProductsTable extends Table
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

        $this->table('products');
        $this->displayField('id_products');
        $this->primaryKey('id_products');
        
        $this->addBehavior('Timestamp');

        $this->belongsTo('producttypes',
                [
                    'foreignKey' => 'product_type'
                ]);
        
        $this->hasMany('SupplierProducts', [
            'foreignKey' => 'id_products'
        ]);  
        
        $this->hasMany('PoGrn', [
            'foreignKey' => 'product_id'
        ]);  
        
 
        
    }

   
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id_products')
            ->allowEmpty('id_products', 'create');

        $validator
            ->allowEmpty('product_name');

        $validator
            ->allowEmpty('product_desc');

        $validator
            ->integer('product_type')
            ->allowEmpty('product_type');

        $validator
            ->allowEmpty('product_active');

        $validator
            ->integer('expiry_months')
            ->allowEmpty('expiry_months');

        $validator
            ->allowEmpty('sku');

        return $validator;
    }
}
