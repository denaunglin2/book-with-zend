<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
/**
 * This file contains only the Driver class for determining holidays in Western
 * Australia.
 *
 * PHP Version 5
 *
 * @category Date
 * @package  Date_Holidays
 * @author   Sam Wilson <sam@archives.org.au>
 * @license  BSD http://www.opensource.org/licenses/bsd-license.php
 * @link     http://pear.php.net/package/Date_Holidays
 */

require_once 'Date/Calc.php';

/**
 * This Driver class calculates holidays in Western Australia.  It should be used in
 * conjunction with the Australia driver.
 *
 * @category   Date
 * @package    Date_Holidays
 * @subpackage Driver
 * @author     Sam Wilson <sam@archives.org.au>
 * @license    BSD http://www.opensource.org/licenses/bsd-license.php
 * @link       http://pear.php.net/package/Date_Holidays
 */
class Date_Holidays_Driver_AustraliaWA extends Date_Holidays_Driver
{
    /**
     * this driver's name
     *
     * @access   protected
     * @var      string
     */
    var $_driverName = 'AustraliaWA';

    /**
     * Constructor
     *
     * @access   protected
     */
    public function __construct()
    {
    }

    /**
     * Build the internal arrays that contain data about holidays.
     *
     * @access   protected
     * @return   boolean true on success, otherwise a PEAR_ErrorStack object
     * @throws   object PEAR_ErrorStack
     */
    function _buildHolidays()
    {
        parent::_buildHolidays();

        /*
         * Labour Day.
         */
        $labourDay = $this->nWeekDayOfMonth(1, 1, 3, $this->_year);
        $this->_addHoliday('labourDay', $labourDay, "Labour Day");
        $this->_addTranslationForHoliday('labourDay', 'en_EN', "Labour Day");

        /*
         * Foundation Day (Queen's Birthday in other states).
         * See http://en.wikipedia.org/wiki/Queen%27s_Official_Birthday#Australia
         */
        $foundationDay = $this->nWeekDayOfMonth(1, 1, 6, $this->_year);
        $this->_addHoliday('foundationDay', $foundationDay, "Foundation Day");
        $this->_addTranslationForHoliday('foundationDay', 'en_EN', "Foundation Day");

        /*
         * The Queen's Birthday.  There is no firm rule to determine this date before
         * it is proclaimed, but it is usually the last Monday of September or the
         * first Monday of October, to fit in with school terms and the Perth Royal
         * Show.  Here we assume that whichever of the two is closest to the start of
         * Octber will be the holiday; this has been verified to be correct up to and
         * including 2013, but dates beyond then should be verified once they've been
         * proclaimed (and something added here to account for historical and future
         * irregularities).
         */
        $y = $this->_year;

        // Special case for CHOGM: the Queen's Birthday was moved in 2011 only.
        if ($y == 2011) {
            $queensBirthday = new DateTime('2011-10-28');
        } else {
            $lastMonSept = $this->nWeekDayOfMonth('last', 1, 9, $y);
            $firstMonOct = $this->nWeekDayOfMonth(1, 1, 10, $y);
            $daysToEnd = 30 - $lastMonSept->format('d');
            $daysToStart = $firstMonOct->format('d');
            if ($daysToEnd < $daysToStart) {
                $queensBirthday = $lastMonSept;
            } else {
                $queensBirthday = $firstMonOct;
            }
        }
        $this->_addHoliday('queensBirthday', $queensBirthday, "Queen's Birthday");
        $this->_addTranslationForHoliday('queensBirthday', 'en_EN', "Queen's Birthday");


        /**
         * Christmas and Boxing Day
         */
        $christmasDay = new DateTime($this->_year . '-12-25');
        if ($christmasDay->format('w') == 6) {
            // 25 December - if that date falls on a Saturday the public holiday transfers to the following Monday.
            $this->_addHoliday('christmasDay',
                               $this->_year . '-12-27',
                               'Substitute Bank Holiday in lieu of Christmas Day');

        } else if ($christmasDay->format('w') == 0) {
            // If that date falls on a Sunday that day and the following Monday will be public holidays.
            $this->_addHoliday('christmasDay',
                               $this->_year . '-12-26',
                               'Substitute Bank Holiday in lieu of Christmas Day');
        } else {
            $this->_addHoliday('christmasDay', $christmasDay, 'Christmas Day');
        }

        $boxingDay = new DateTime($this->_year . '-12-26');
        if ($boxingDay->format('w') == 6) {
            //26 December - if that date falls on a Saturday the public holiday transfers to the following Monday.
            $this->_addHoliday('boxingDay',
                               $this->_year . '-12-28',
                               'Substitute Bank Holiday in lieu of Boxing Day');
        } else if ($boxingDay->format('w') == 0) {
            // If that date falls on a Sunday that day and the following Tuesday will be public holidays.
            $this->_addHoliday('boxingDay',
                               $this->_year . '-12-28',
                               'Substitute Bank Holiday in lieu of Boxing Day');
        } else if ($boxingDay->format('w') == 1) {
            // If that date falls on a Monday that day and the following Tuesday will be public holidays.
            $this->_addHoliday('boxingDay',
                               $this->_year . '-12-26',
                               'Substitute Bank Holiday in lieu of Boxing Day');
            $this->_addHoliday('boxingDay',
                               $this->_year . '-12-27',
                               'Substitute Bank Holiday in lieu of Boxing Day');
        } else {
            $this->_addHoliday('boxingDay', $this->_year . '-12-26', 'Boxing Day');
        }

        $this->_addTranslationForHoliday('christmasDay', 'en_EN', 'Christmas Day');
        $this->_addTranslationForHoliday('boxingDay', 'en_EN', 'Boxing Day');

    } // _buildHolidays()

} // Date_Holidays_Driver_AustraliaWA
