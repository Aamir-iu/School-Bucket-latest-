<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Expanse Entity
 *
 * @property int $id_expanses
 * @property int $transaction_account_id
 * @property string $expanse_desc
 * @property float $amount
 * @property \Cake\I18n\Time $expanse_date
 * @property string $r_no
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 *
 * @property \App\Model\Entity\TransactionAccount $transaction_account
 */
class Expanse extends Entity
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
        'id_expanses' => false
    ];
}
