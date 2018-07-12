<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClassesSections Model
 *
 * @method \App\Model\Entity\ClassesSection get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClassesSection newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ClassesSection[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClassesSection|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClassesSection patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClassesSection[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClassesSection findOrCreate($search, callable $callback = null)
 */
class ClassesSectionsTable extends Table
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

        $this->table('classes_sections');
        $this->displayField('id_class');
        $this->primaryKey('id_class');
        
         $this->belongsTo('Users', [
            'foreignKey' => 'created_by'
          
        ]);
        
    }

   
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id_class')
            ->allowEmpty('id_class', 'create');

        $validator
            ->allowEmpty('class_name');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        return $validator;
    }
}
