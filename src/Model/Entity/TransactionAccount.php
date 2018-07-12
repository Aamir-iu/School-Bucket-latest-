<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TransactionAccount Entity
 *
 * @property int $id_transaction_account
 * @property string $transaction_account_number
 * @property int $transaction_account_createdby
 * @property \Cake\I18n\Time $transaction_account_createdon
 */
class TransactionAccount extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id_transaction_account' => false
    ];
}
