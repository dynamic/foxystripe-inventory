<?php

namespace Dynamic\FoxyStripe\Model;

use Dynamic\FoxyStripe\Page\ProductPage;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Security\Security;

/**
 * Class ProductCartReservation
 * @package Dynamic\Sheeps\ProductCartExpiry\Model
 *
 * @property string ReservationCode
 */
class ProductCartReservation extends DataObject
{
    /**
     * @var string
     */
    private static $singular_name = 'Product Cart Reservation';

    /**
     * @var string
     */
    private static $plural_name = 'Product Cart Reservations';

    /**
     * @var string
     */
    private static $table_name = 'ProductCartReservation';

    /**
     * @var array
     */
    private static $db = [
        'ReservationCode' => 'Varchar(255)',
        'CartProductID' => 'Int',
        'Code' => 'Varchar(255)',
        'Expires' => 'DBDatetime',
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Product' => ProductPage::class,
    ];

    /**
     * @var array
     */
    private static $indexes = [
        'foxystripe-reservation-code' => [
            'type' => 'unique',
            'columns' => ['ReservationCode'],
        ],
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'ReservationCode' => 'Cart Reservation Record',
        'Expires.Nice' => 'Expires',
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->addFieldToTab('Root.Main', ReadonlyField::create('ReservationCode')->setTitle('Reservation Code'));
        });

        return parent::getCMSFields();
    }

    /**
     *
     */
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        if (!$this->ProductID) {
            if ($product = ProductPage::get()->filter('Code', $this->Code)->first()) {
                $this->ProductID = $product->ID;
            }
        }
    }

    /**
     * @param null $member
     * @param array $context
     * @return bool
     */
    public function canCreate($member = null, $context = [])
    {
        return false;
    }

    /**
     * @param null $member
     * @return bool
     */
    public function canEdit($member = null)
    {
        return false;
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        return Permission::check('ADMIN', 'any', Security::getCurrentUser());
    }

    /**
     * @param null $member
     * @return bool
     */
    public function canView($member = null)
    {
        return true;
    }
}
