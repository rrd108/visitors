<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Service Entity
 *
 * @property int $id
 * @property string $service
 * @property string $description
 * @property int $minutes
 * @property int $full_price
 * @property int $discount_price
 *
 * @property \App\Model\Entity\Visit[] $visits
 */
class Service extends Entity
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
        'service' => true,
        'description' => true,
        'description_long' => true,
        'minutes' => true,
        'full_price' => true,
        'discount_price' => true,
        'type' => true,
        'visits' => true
    ];
}
