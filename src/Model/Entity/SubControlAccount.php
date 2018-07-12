<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SubControlAccount Entity
 *
 * @property int $id_sub_control_account
 * @property string $sub_control_account_number
 * @property int $sub_control_account_createdby
 * @property \Cake\I18n\Time $sub_control_account_createdon
 */
class SubControlAccount extends Entity
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
        'id_sub_control_account' => false
    ];
}
