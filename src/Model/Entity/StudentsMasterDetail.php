<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentsMasterDetail Entity
 *
 * @property int $id_master_details
 * @property int $registration_id
 * @property int $roll_no
 * @property int $class_id
 * @property int $shift_id
 * @property int $session_id
 * @property int $campus_id
 * @property \Cake\I18n\Time $class_start_time
 * @property \Cake\I18n\Time $class_end_time
 *
 * @property \App\Model\Entity\Registration $registration
 * @property \App\Model\Entity\Class $class
 * @property \App\Model\Entity\Shift $shift
 * @property \App\Model\Entity\Session $session
 * @property \App\Model\Entity\Campus $campus
 */
class StudentsMasterDetail extends Entity
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
        'id_master_details' => false
    ];
}
