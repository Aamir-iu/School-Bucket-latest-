<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Complain Entity
 *
 * @property int $id_complain
 * @property int $campus_id
 * @property int $department_id
 * @property int $registration_id
 * @property string $complain
 * @property \Cake\I18n\Time $comp_date
 * @property string $status
 *
 * @property \App\Model\Entity\Campus $campus
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\Registration $registration
 */
class Complain extends Entity
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
        'id_complain' => false
    ];
}
