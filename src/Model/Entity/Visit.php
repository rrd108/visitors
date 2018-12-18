<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Visit Entity
 *
 * @property int $id
 * @property int $club_id
 * @property \Cake\I18n\FrozenTime $date
 * @property bool $payed
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Club $club
 * @property \App\Model\Entity\Service[] $services
 */
class Visit extends Entity
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
        'club_id' => true,
        'date' => true,
        'payed' => true,
        'created' => true,
        'modified' => true,
        'club' => true,
        'services' => true
    ];
}
