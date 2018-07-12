<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GalleryDetail Entity
 *
 * @property int $id_gallery_details
 * @property int $master_gallery_id
 * @property string $pic
 *
 * @property \App\Model\Entity\MasterGallery $master_gallery
 */
class GalleryDetail extends Entity
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
        'id_gallery_details' => false
    ];
}
