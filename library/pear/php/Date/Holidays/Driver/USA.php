<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
/**
 * USA.php
 *
 * PHP Version 5
 *
 * Copyright (c) 1997-2008 The PHP Group
 *
 * This source file is subject to version 3.0 of the PHP license,
 * that is bundled with this package in the file LICENSE, and is
 * available at through the world-wide-web at
 * http://www.php.net/license/3_01.txt.
 * If you did not receive a copy of the PHP license and are unable to
 * obtain it through the world-wide-web, please send a note to
 * license@php.net so we can mail you a copy immediately.
 *
 * @category Date
 * @package  Date_Holidays
 * @author   Kevin English <kevin@x5dev.com>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.0.1
 * @version  CVS: $Id$
 * @link     http://pear.php.net/package/Date_Holidays
 */
//


/**
 * class that calculates observed U.S. holidays
 *
 * @category   Date
 * @package    Date_Holidays
 * @subpackage Driver
 * @author     Kevin English <kevin@x5dev.com>
 * @license    http://www.php.net/license/3_01.txt PHP License 3.0.1
 * @version    CVS: $Id$
 * @link       http://pear.php.net/package/Date_Holidays
 */
class Date_Holidays_Driver_USA extends Date_Holidays_Driver
{
    /**
     * this driver's name
     *
     * @access   protected
     * @var      string
     */
    var $_driverName = 'USA';

    /**
     * Constructor
     *
     * Use the Date_Holidays::factory() method to construct an object of a
     * certain driver
     *
     * @access   protected
     */
    protected function __function()
    {
    }

    /**
     * Build the internal arrays that contain data about the calculated holidays
     *
     * @access   protected
     * @return   boolean true on success, otherwise a PEAR_ErrorStack object
     * @throws   object PEAR_ErrorStack
     */
    function _buildHolidays()
    {
        /**
         * New Year's Day
         */
        $newYearsDay = $this->_calcNearestWorkDay('01', '01');
        $this->_addHoliday('usa_newYearsDay', $newYearsDay, 'New Year\'s Day');

        $thirdMondayInJanuaryDate = $this->_calcNthMondayInMonth(1, 3);
        $this->_addHoliday('usa_mlkDay',
                           $thirdMondayInJanuaryDate,
                           'Dr. Martin Luther King Jr\'s Birthday');

        /**
         * President's Day
         */
        $thirdMondayInFebruaryDate = $this->_calcNthMondayInMonth(2, 3);
        $this->_addHoliday('usa_presidentsDay',
                           $thirdMondayInFebruaryDate,
                           'President\'s Day');

        /**
         * Memorial Day
         */
        $lastMondayInMayDate = $this->nWeekDayOfMonth('last', 1, 5, $this->_year);
        $this->_addHoliday('usa_memorialDay', $lastMondayInMayDate, 'Memorial Day');

        /**
         * 4th of July
         */
        $independenceDay = $this->_calcNearestWorkDay('07', '04');
        $this->_addHoliday('usa_independenceDay', $independenceDay, 'Independence Day');

        /**
         * Labor Day
         */
        $laborDay = $this->_calcNthMondayInMonth(9, 1);
        $this->_addHoliday('usa_laborDay', $laborDay, 'Labor Day');

        /**
         * Columbus Day
         */
        $columbusDay = $this->_calcNthMondayInMonth(10, 2);
        $this->_addHoliday('usa_columbusDay', $columbusDay, 'Columbus Day');

        /**
         * Veteran's  Day
         */
        $this->_addHoliday('usa_veteransDay', $this->_year.'-11-11', 'Veteran\'s Day');

        /**
         * Thanksgiving  Day
         */
        $tday = $this->_calcNthThursdayInMonth(11, 4);
        $this->_addHoliday('usa_thanksgivingDay', $tday, 'Thanksgiving Day');

        /**
         * Christmas  Day
         */
        $cday = $this->_calcNearestWorkDay('12', '25');
        $this->_addHoliday('usa_christmasDay', $cday, 'Christmas Day');

        return true;
    }

    /**
     * Calculate Nth thursday in a month
     *
     * @param int $month    month
     * @param int $position position
     *
     * @access   private
     * @return   object Date date
     */
    function _calcNthThursdayInMonth($month, $position)
    {
        if ($position  == 1) {
            $startday = '01';
        } elseif ($position == 2) {
            $startday = '08';
        } elseif ($position == 3) {
            $startday = '15';
        } elseif ($position == 4) {
            $startday = '22';
        } elseif ($position == 5) {
            $startday = '29';
        }
        $month = sprintf("%02d", $month);

        $date = new DateTime($this->_year . '-' . $month . '-' . $startday);
        while ($date->format('w') != 4) {
            $date = $date->add( new DateInterval('P1D'));
        }
        return $date;
    }

    /**
     * Calculate last monday in a month
     *
     * @param int $month month
     *
     * @access   private
     * @return   object Date date
     */
    function _calcLastMondayInMonth($month)
    {
        $month       = sprintf("%02d", $month);
        $date        = new DateTime($this->_year . '-' . $month . '-01');
        $daysInMonth = $date->getDaysInMonth();
        $date        = new DateTime($this->_year . '-' . $month . '-' . $daysInMonth);
        while ($date->format('w') != 1) {
            $date = $date->sub( new DateInterval('P1D'));
        }

        return $date;
    }

    /**
     * Calculate nearest workday for a certain day
     *
     * @param int $month month
     * @param int $day   day
     *
     * @access   private
     * @return   object Date date
     */
    function _calcNearestWorkDay($month, $day)
    {
        $month = sprintf("%02d", $month);
        $day   = sprintf("%02d", $day);
        $date  = new DateTime($this->_year . '-' . $month . '-' . $day);

        // When one of these holidays falls on a Saturday, the previous day is
        // also a holiday
        // When New Year's Day, Independence Day, or Christmas Day falls on a
        // Sunday, the next day is also a holiday.
        if ($date->format('w') == 0 ) {
            // bump it up one
            $date = $date->add( new DateInterval('P1D'));
        }
        if ($date->format('w') == 6 ) {
            // push it back one
            $date = $date->sub( new DateInterval('P1D'));
        }

        return $date;
    }

    /**
     * Method that returns an array containing the ISO3166 codes that may possibly
     * identify a driver.
     *
     * @static
     * @access public
     * @return array possible ISO3166 codes
     */
    function getISO3166Codes()
    {
        return array('us', 'usa');
    }
}
?>
