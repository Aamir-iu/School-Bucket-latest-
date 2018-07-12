<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MobileNotifications Model
 *
 * @method \App\Model\Entity\MobileNotification get($primaryKey, $options = [])
 * @method \App\Model\Entity\MobileNotification newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MobileNotification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MobileNotification|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MobileNotification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MobileNotification[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MobileNotification findOrCreate($search, callable $callback = null, $options = [])
 */
class MobileNotificationsTable extends Table
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

        $this->table('mobile_notifications');
        $this->displayField('id_notifications');
        $this->primaryKey('id_notifications');
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
            ->integer('id_notifications')
            ->allowEmpty('id_notifications', 'create');

        $validator
            ->allowEmpty('notification');

//        $validator
//            ->dateTime('created_on')
//            ->requirePresence('created_on', 'create')
//            ->notEmpty('created_on');
//
//        $validator
//            ->time('schedule_on')
//            ->allowEmpty('schedule_on');
//
//        $validator
//            ->allowEmpty('status');

        return $validator;
    }
}
