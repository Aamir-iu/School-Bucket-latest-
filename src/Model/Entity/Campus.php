<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Campus Entity
 *
 * @property int $id_campus
 * @property string $campus_name
 * @property string $campus_location
 * @property string $campus_principle
 * @property string $campus_contact
 * @property string $campus_contact2
 * @property int $created_by
 * @property \Cake\I18n\Time $created_on
 *
 * @property \App\Model\Entity\User[] $users
 */
class Campus extends Entity
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
        'id_campus' => false
    ];
}
