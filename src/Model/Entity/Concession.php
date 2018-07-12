<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Concession Entity
 *
 * @property int $id_concession
 * @property int $registration_id
 * @property int $campus_id
 * @property float $amount
 * @property float $fine
 * @property \Cake\I18n\Time $from_date
 * @property \Cake\I18n\Time $to_date
 * @property int $status
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 *
 * @property \App\Model\Entity\Registration $registration
 * @property \App\Model\Entity\Campus $campus
 */
class Concession extends Entity
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
        'id_concession' => false
    ];
}
