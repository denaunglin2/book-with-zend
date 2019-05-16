<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
/**
 * Driver for holidays in Brazil
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
 * @author   Igor Feghali <ifeghali@php.net>
 * @license  http://www.php.net/license/3_01.txt PHP License 3.0.1
 * @version  CVS: $Id$
 * @link     http://pear.php.net/package/Date_Holidays
 */

/**
 * Extends Christian driver
 */
require_once 'Date/Holidays/Driver/Christian.php';

/**
 * class that calculates Brazilian holidays
 *
 * @category   Date
 * @package    Date_Holidays
 * @subpackage Driver
 * @author     Igor Feghali <ifeghali@php.net>
 * @license    http://www.php.net/license/3_01.txt PHP License 3.0.1
 * @version    CVS: $Id$
 * @link       http://pear.php.net/package/Date_Holidays
 */
class Date_Holidays_Driver_Brazil extends Date_Holidays_Driver_Christian
{
    /**
     * this driver's name
     *
     * @access   protected
     * @var      string
     */
    var $_driverName = 'Brazil';

    /**
     * Constructor
     *
     * Use the Date_Holidays::factory() method to construct an object of a
     * certain driver
     *
     * @access   protected
     */
    public function __construct()
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
        parent::_buildHolidays();

        $ashWednesdayDate = $this->getHolidayDate('ashWednesday');

        $this->_addTranslationForHoliday('easter',
                                         'pt_BR',
                                         'Páscoa');
        $this->_addTranslationForHoliday('ashWednesday',
                                         'pt_BR',
                                         'Quarta-Feira de Cinzas');
        $this->_addTranslationForHoliday('goodFriday',
                                         'pt_BR',
                                         'Sexta-Feira Santa');
        $this->_addTranslationForHoliday('corpusChristi',
                                         'pt_BR',
                                         'Corpus Christi');
        $this->_addTranslationForHoliday('thanksGiving',
                                         'pt_BR',
                                         'Dia de Ação de Graças');
        $this->_addTranslationForHoliday('allSoulsDay',
                                         'pt_BR',
                                         'Dia de Finados');
        $this->_addTranslationForHoliday('christmasDay',
                                         'pt_BR',
                                         'Natal');

        /**
         * New Year's Day
         */
        $this->_addHoliday('newYearsDay',
                           $this->_year . '-01-01',
                           'New Year\'s Day');
        $this->_addTranslationForHoliday('newYearsDay',
                                         'pt_BR',
                                         'Ano Novo');

        /**
         * Carnival
         */
        $carnival = new DateTime($ashWednesdayDate);
        $carnival = $carnival->sub( new DateInterval('P1D'));
        $this->_addHoliday('carnival',
                           $carnival,
                           'Carnival');
        $this->_addTranslationForHoliday('carnival',
                                         'pt_BR',
                                         'Carnaval');

        /**
         * International Women's Day
         */
        $this->_addHoliday('womensDay',
                           $this->_year . '-03-08',
                           'International Women\'s Day');
        $this->_addTranslationForHoliday('womensDay',
                                         'pt_BR',
                                         'Dia Internacional das Mulheres');

        /**
         * Tiradentes
         */
        $this->_addHoliday('tiradentesDay',
                           $this->_year . '-04-21',
                           'Tiradentes\' Day');
        $this->_addTranslationForHoliday('tiradentesDay',
                                         'pt_BR',
                                         'Dia de Tiradentes');

        /**
         * Labor Day
         */
        $this->_addHoliday('laborDay',
                           $this->_year . '-05-01',
                           'Labor Day');
        $this->_addTranslationForHoliday('laborDay',
                                         'pt_BR',
                                         'Dia do Trabalho');

        /**
         * Mothers' Day
         */
        $mothersDay = $this->_calcNthWeekDayInMonth(2, 0, 5);
        $this->_addHoliday('mothersDay',
                           $mothersDay,
                           'Mothers\' Day');
        $this->_addTranslationForHoliday('mothersDay',
                                         'pt_BR',
                                         'Dia das Mães');

        /**
         * Valentine's Day
         */
        $this->_addHoliday('valentinesDay',
                           $this->_year . '-06-12',
                           'Valentine\'s Day');
        $this->_addTranslationForHoliday('valentinesDay',
                                         'pt_BR',
                                         'Dia dos Namorados');

        /**
         * Fathers' Day
         */
        $fathersDay = $this->_calcNthWeekDayInMonth(2, 0, 8);
        $this->_addHoliday('fathersDay',
                           $fathersDay,
                           'Fathers\' Day');
        $this->_addTranslationForHoliday('fathersDay',
                                         'pt_BR',
                                         'Dia dos Pais');

        /**
         * Independence Day
         */
        $this->_addHoliday('independenceDay',
                           $this->_year . '-09-07',
                           'Independece Day');
        $this->_addTranslationForHoliday('independenceDay',
                                         'pt_BR',
                                         'Dia da Independência');

        /**
         * Aparecida
         */
        $this->_addHoliday('aparecidaDay',
                           $this->_year . '-10-12',
                           'Our Lady of Aparecida Day');
        $this->_addTranslationForHoliday('aparecidaDay',
                                         'pt_BR',
                                         'Dia de Nossa Senhora de Aparecida');

        /**
         * Children' Day
         */
        $this->_addHoliday('childrenDay',
                           $this->_year . '-10-12',
                           'Children\'s Day');
        $this->_addTranslationForHoliday('childrenDay',
                                         'pt_BR',
                                         'Dia das Crianças');

        /**
         * Proclamation of the Republic
         */
        $this->_addHoliday('republicDay',
                           $this->_year . '-11-15',
                           'Proclamation of the Republic');
        $this->_addTranslationForHoliday('republicDay',
                                         'pt_BR',
                                         'Proclamação da República');

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
        return array('br', 'bra');
    }
}
?>
