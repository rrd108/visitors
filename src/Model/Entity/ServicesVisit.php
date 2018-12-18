<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ServicesVisit Entity
 *
 * @property int $id
 * @property int $service_id
 * @property int $visit_id
 * @property int $full_price_members
 * @property int $discount_price_members
 *
 * @property \App\Model\Entity\Service $service
 * @property \App\Model\Entity\Visit $visit
 */
class ServicesVisit extends Entity
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
        'service_id' => true,
        'visit_id' => true,
        'full_price_members' => true,
        'discount_price_members' => true,
        'service' => true,
        'visit' => true
    ];
}
