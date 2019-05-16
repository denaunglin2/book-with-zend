<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
/**
 * Driver for determining holidays in the Netherlands.
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
 * @author   Jos van der Woude <jos@veerkade.com>
 * @author   Arjen de Korte <build+date_holidays@de-korte.org>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.0.1
 * @version  CVS: $Id: Netherlands.php,v 1.9 2009/03/15 20:17:00 kguest Exp $
 * @link     http://pear.php.net/package/Date_Holidays
 */

require_once 'Date/Holidays/Driver/Christian.php';

/**
 * Driver class that calculates Dutch holidays
 *
 * @category   Date
 * @package    Date_Holidays
 * @subpackage Driver
 * @author     Jos van der Woude <jos@veerkade.com>
 * @author     Arjen de Korte <build+date_holidays@de-korte.org>
 * @license    http://www.php.net/license/3_01.txt PHP License 3.0.1
 * @version    $Id: Netherlands.php,v 1.9 2009/03/15 20:17:00 kguest Exp $
 * @link       http://pear.php.net/package/Date_Holidays
 */

class Date_Holidays_Driver_Netherlands extends Date_Holidays_Driver
{
    /**
     * this driver's name
     *
     * @access   protected
     * @var      string
     */
    var $_driverName = 'Netherlands';

    /**
     * Constructor
     *
     * Use the Date_Holidays::factory() method to construct an object of a
     * certain driver
     *
     * @access protected
     */
    public function __construct()
    {
    }

    /**
     * Build the internal arrays that contain data about the calculated holidays
     *
     * @access protected
     * @return boolean true on success, otherwise a PEAR_ErrorStack object
     * @throws object PEAR_ErrorStack
     */
    function _buildHolidays()
    {
        /**
         * Start with all holidays that are on a fixed date each year
         */

        /**
         * New Year's Day
         */
        $this->_addHoliday(
            'netherlands_newYearsDay',
            $this->_year . '-01-01',
            'New Year\'s Day'
        );

        /**
         * Epiphanias
         */
        $this->_addHoliday('netherlands_epiphany', $this->_year . '-01-06', 'Epiphany');

        /**
         * Valentine's Day
         */
        $this->_addHoliday(
            'netherlands_valentineDay',
            $this->_year . '-02-14',
            'Valentine\'s Day'
        );

        /**
         * Labour Day
         */
        $this->_addHoliday('netherlands_labourDay', $this->_year . '-05-01', 'Labour Day');

        /**
         * Commemoration Day
         */
        $this->_addHoliday(
            'netherlands_commemorationDay',
            ($this->_year >= 1947) ? $this->_year . '-05-04' : '1947-05-04',
            'Commemoration Day'
        );

        /**
         * Liberation Day
         */
        $this->_addHoliday(
            'netherlands_liberationDay',
            ($this->_year >= 1947) ? $this->_year . '-05-05' : '1947-05-05',
            'Liberation Day'
        );

        /**
         * World Animal Day
         */
        $this->_addHoliday(
            'netherlands_worldAnimalDay',
            $this->_year . '-10-04',
            'World Animal Day'
        );

        /**
         * Halloween
         */
        $this->_addHoliday('netherlands_halloween', $this->_year . '-10-31', 'Halloween');

        /**
         * St. Martins Day
         */
        $this->_addHoliday(
            'netherlands_stMartinsDay',
            $this->_year . '-11-11',
            'St. Martin\'s Day'
        );

        /**
         * St. Nicholas' Day
         */
        $this->_addHoliday(
            'netherlands_stNicholasDay',
            $this->_year . '-12-05',
            'St. Nicholas\' Day'
        );

        /**
         * Christmas day
         */
        $this->_addHoliday(
            'netherlands_christmasDay',
            $this->_year . '-12-25',
            'Christmas Day'
        );

        /**
         * Second Christmas Day
         */
        $this->_addHoliday(
            'netherlands_secondChristmasDay',
            $this->_year . '-12-26',
            'Boxing Day'
        );

        /**
         * New Year's Eve
         */
        $this->_addHoliday(
            'netherlands_newYearsEve',
            $this->_year . '-12-31',
            'New Year\'s Eve'
        );


        /**
         * Following section is holidays that are a fixed offset from Easter (which
         * differs each year)
         */
        $easterDate = Date_Holidays_Driver_Christian::calcEaster($this->_year);

        /**
         * Carnival
         */
        $this->_addHoliday(
            'netherlands_carnival1',
            $this->_addDays($easterDate, -49),
            'Carnival'
        );
        $this->_addHoliday(
            'netherlands_carnival2',
            $this->_addDays($easterDate, -48),
            'Carnival'
        );
        $this->_addHoliday(
            'netherlands_carnival3',
            $this->_addDays($easterDate, -47),
            'Carnival'
        );

        /**
         * Ash Wednesday
         */
        $this->_addHoliday(
            'netherlands_ashWednesday',
            $this->_addDays($easterDate, -46),
            'Ash Wednesday'
        );

        /**
         * Green Thursday
         */
        $this->_addHoliday(
            'netherlands_greenThursday',
            $this->_addDays($easterDate, -3),
            'Green Thursday'
        );

        /**
         * Good Friday / Black Friday
         */
        $this->_addHoliday(
            'netherlands_goodFriday',
            $this->_addDays($easterDate, -2),
            'Good Friday'
        );

        /**
         * Silent Saturday
         */
        $this->_addHoliday(
            'netherlands_silentSaturday',
            $this->_addDays($easterDate, -1),
            'Silent Saturday'
        );

        /**
         * Easter Sunday
         */
        $this->_addHoliday('netherlands_easter', $easterDate, 'Easter Sunday');

        /**
         * Easter Monday
         */
        $this->_addHoliday(
            'netherlands_easterMonday',
            $this->_addDays($easterDate, 1),
            'Easter Monday'
        );

        /**
         * Ascension Day
         */
        $this->_addHoliday(
            'netherlands_ascensionDay',
            $this->_addDays($easterDate, 39),
            'Ascension Day'
        );

        /**
         * Whitsun
         */
        $this->_addHoliday('netherlands_whitsun', $this->_addDays($easterDate, 49), 'Whitsun');

        /**
         * Whit Monday
         */
        $this->_addHoliday(
            'netherlands_whitMonday',
            $this->_addDays($easterDate, 50),
            'Whit Monday'
        );


        /**
         * Queen's Day was celebrated between 1891 and 1948 (inclusive) on
         * August 31. Between 1949 and 2013 (inclusive) it was celebrated
         * April 30.
         * If these dates are on a Sunday, Queen's Day was celebrated one
         * day later until 1980 (on the following Monday), starting 1980 one
         * day earlier (on the preceding Saturday).
         */
        if (($this->_year >= 1891) && ($this->_year <= 2013)) {
            $queenDay = new DateTime(($this->_year <= 1948) ? $this->_year . '-08-31' : $this->_year . '-04-30');
            if ($queenDay->format('w') == 0) {
                $queenDay = $this->_addDays($queenDay, ($this->_year < 1980) ? 1 : -1);
            }
        }
        $this->_addHoliday('netherlands_queenDay', isset($queenDay) ? $queenDay : '1980-04-30', 'Queen\'s Day');


        /**
         * King's Day is celebrated from 2014 onwards on April 27th. But
         * here also, if this happens to be on a Sunday, it will be
         * celebrated the day before instead.
         */
        if ($this->_year >= 2014) {
            $kingsDay = new DateTime($this->_year . '-04-27');
            if ($kingsDay->format('w') == 0) {
                $kingsDay = $this->_addDays($kingsDay, -1);
            }
        }
        $this->_addHoliday('netherlands_kingsDay', isset($kingsDay) ? $kingsDay : '2014-04-27', 'King\'s Day');


        /**
         * Lastly a number of holidays that are the second/third/last Sunday
         * or Tuesday in a specific month (offset is calculated from the first
         * of last possible date)
         */

        /**
         * Summertime last sunday of march
         */
        $summerTime = new DateTime($this->_year . '-03-31');
        $dayOfWeek  = $summerTime->format('w');
        $summerTime = $this->_addDays($summerTime, -$dayOfWeek);
        $this->_addHoliday('netherlands_summerTime', $summerTime, 'Summertime');

        /**
         * Mothers' Day second sunday of may
         */
        $mothersDay = new DateTime($this->_year . '-05-08');
        $dayOfWeek  = $mothersDay->format('w');
        if ($dayOfWeek != 0) {
            $mothersDay = $this->_addDays($mothersDay, 7 - $dayOfWeek);
        }
        $this->_addHoliday('netherlands_mothersDay', $mothersDay, 'Mothers\' Day');

        /**
         * Fathers' Day third sunday of june
         */
        $fathersDay = new DateTime($this->_year . '-06-15');
        $dayOfWeek  = $fathersDay->format('w');
        if ($dayOfWeek != 0) {
            $fathersDay = $this->_addDays($fathersDay, 7 - $dayOfWeek);
        }
        $this->_addHoliday('netherlands_fathersDay', $fathersDay, 'Fathers\' Day');

        /**
         * Start of Parliamentary Year third tuesday of september
         */
        $princesDay = new DateTime($this->_year . '-09-15');
        $dayOfWeek  = $princesDay->format('w');
        if ($dayOfWeek <= 2) {
            $princesDay = $this->_addDays($princesDay, 2 - $dayOfWeek);
        } else {
            $princesDay = $this->_addDays($princesDay, 9 - $dayOfWeek);
        }
        $this->_addHoliday('netherlands_princesDay', $princesDay, 'Start of Parliamentary Year');

        /**
         * Wintertime last sunday of october
         */
        $winterTime = new DateTime($this->_year . '-10-31');
        $dayOfWeek  = $winterTime->format('w');
        $winterTime = $this->_addDays($winterTime, -$dayOfWeek);
        $this->_addHoliday('netherlands_winterTime', $winterTime, 'Wintertime');

        if (Date_Holidays::errorsOccurred()) {
            return Date_Holidays::getErrorStack();
        }

        return true;
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
        return array('nl', 'nld');
    }
}
?>
