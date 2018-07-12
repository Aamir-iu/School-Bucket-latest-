<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MainAccount Entity
 *
 * @property int $id_main_account
 * @property int $main_account_number
 * @property string $main_account_name
 * @property int $created_by
 * @property \Cake\I18n\Time $created_on
 */
class MainAccount extends Entity
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
        'id_main_account' => false
    ];
}
