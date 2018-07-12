<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RoomMaster Model
 *
 * @method \App\Model\Entity\RoomMaster get($primaryKey, $options = [])
 * @method \App\Model\Entity\RoomMaster newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RoomMaster[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RoomMaster|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RoomMaster patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RoomMaster[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RoomMaster findOrCreate($search, callable $callback = null, $options = [])
 */
class RoomMasterTable extends Table
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

        $this->table('room_master');
        $this->displayField('id_room_master');
        $this->primaryKey('id_room_master');
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
            ->integer('id_room_master')
            ->allowEmpty('id_room_master', 'create');

        $validator
            ->allowEmpty('room_name');

        $validator
            ->allowEmpty('room_desc');

        $validator
            ->integer('created_on')
            ->allowEmpty('created_on');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        return $validator;
    }
}
