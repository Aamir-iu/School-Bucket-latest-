<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ControlAccount Entity
 *
 * @property int $id_control_account
 * @property string $control_account_number
 * @property \Cake\I18n\Time $control_account_createdon
 * @property string $control_account_createdby
 */
class ControlAccount extends Entity
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
        'id_control_account' => false
    ];
}
