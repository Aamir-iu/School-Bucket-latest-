<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Scheduler Entity
 *
 * @property int $id_scheduler
 * @property \Cake\I18n\Time $start_time
 * @property \Cake\I18n\Time $end_time
 */
class Scheduler extends Entity
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
        'id_scheduler' => false
    ];
}
