<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fee Entity
 *
 * @property int $id_fees
 * @property int $inv_no
 * @property int $registration_id
 * @property int $campus_id
 * @property int $session_id
 * @property int $class_id
 * @property int $shift_id
 * @property int $fee_month
 * @property int $year
 * @property float $amount
 * @property int $fee_type
 * @property \Cake\I18n\Time $fee_date
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 *
 * @property \App\Model\Entity\Registration $registration
 * @property \App\Model\Entity\Campus $campus
 * @property \App\Model\Entity\Session $session
 * @property \App\Model\Entity\Class $class
 * @property \App\Model\Entity\Shift $shift
 */
class Fee extends Entity
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
        'id_fees' => false
    ];
}
