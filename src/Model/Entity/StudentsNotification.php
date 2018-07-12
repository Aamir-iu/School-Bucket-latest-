<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentsNotification Entity
 *
 * @property int $id_student_notifications
 * @property int $notification_id
 * @property int $registration_id
 * @property string $status
 *
 * @property \App\Model\Entity\Notification $notification
 * @property \App\Model\Entity\Registration $registration
 */
class StudentsNotification extends Entity
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
        'id_student_notifications' => false
    ];
}
