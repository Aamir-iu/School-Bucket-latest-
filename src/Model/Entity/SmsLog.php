<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SmsLog Entity
 *
 * @property int $id_sms_log
 * @property int $campus_id
 * @property string $mobile_number
 * @property string $message
 * @property string $code
 * @property int $status
 * @property int $no_of_sms
 * @property \Cake\I18n\Time $sms_date
 *
 * @property \App\Model\Entity\Campus $campus
 */
class SmsLog extends Entity
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
        'id_sms_log' => false
    ];
}
