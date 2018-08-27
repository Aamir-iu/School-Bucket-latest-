<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Holiday Entity
 *
 * @property int $id_dues
 * @property int $registration_id
 * @property int $class_id
 * @property int $shift_id
 * @property int $session_id
 * @property int $fee_month
 * @property int $year
 * @property int $fee_type
 * @property float $amount
 * @property float $fine
 * @property \Cake\I18n\Time $fee_date
 * @property \Cake\I18n\Time $due_date
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 *
 * @property \App\Model\Entity\Registration $registration
 * @property \App\Model\Entity\Class $class
 * @property \App\Model\Entity\Shift $shift
 * @property \App\Model\Entity\Session $session
 */
class Holiday extends Entity
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
        'holiday_id' => false
    ];
}
