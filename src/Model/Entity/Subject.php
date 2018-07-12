<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subject Entity
 *
 * @property int $id_subjects
 * @property string $subject_name
 * @property string $short_name
 * @property int $order_id
 * @property \Cake\I18n\Time $creatd_on
 * @property int $created_by
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\Scheduler[] $scheduler
 */
class Subject extends Entity
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
        'id_subjects' => false
    ];
}
