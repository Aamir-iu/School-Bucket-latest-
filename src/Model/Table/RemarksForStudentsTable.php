<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RemarksForStudents Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Registrations
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Shifts
 *
 * @method \App\Model\Entity\RemarksForStudent get($primaryKey, $options = [])
 * @method \App\Model\Entity\RemarksForStudent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RemarksForStudent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RemarksForStudent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RemarksForStudent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RemarksForStudent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RemarksForStudent findOrCreate($search, callable $callback = null)
 */
class RemarksForStudentsTable extends Table
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

        $this->table('remarks_for_students');
        $this->displayField('id_remarks_for_students');
        $this->primaryKey('id_remarks_for_students');

        $this->belongsTo('Registration', [
            'foreignKey' => 'registration_id'
        ]);
        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id'
        ]);
        $this->belongsTo('Shifts', [
            'foreignKey' => 'shift_id'
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
            ->integer('id_remarks_for_students')
            ->allowEmpty('id_remarks_for_students', 'create');

       
        return $validator;
    }

    
    
}
