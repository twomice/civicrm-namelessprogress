<?php

/**
 * Utilities for namelessprogress extension
 *
 */
class CRM_Namelessprogress_Util {

  private static $_singleton = NULL;

  /**
   * @var DateTime The date against which we should calculate everyone's age.
   */
  private $ageOnDateTimeObj;

  /**
   * Class constructor.
   */
  public function __construct() {
    // Determine the appropriate "age on" date, i.e., the date against which
    // we'll calculate everyone's ages.
    //
    //  If today's date is on or after the value of the "Move Up Day" setting, $ageOnDate = "School Cut-Off Date" in the current year.
    $dateMoveUpThisYear = self::getDateMoveUpThisYear();
    $schoolCutOffDay = civicrm_api3('Setting', 'getvalue', [
      'name' => "namelessprogress_schoolcutoffday",
    ]);
    $ageInYear = NULL;
    if (strtotime(CRM_Utils_Date::getToday()) > strtotime($dateMoveUpThisYear)) {
      $ageInYear = date('Y');
      //  Example:
      //  Move Up Day: June 1
      //  School Cut-Off Date: September 1
      //  Today's date: June 1 (or any date later in the year)
      //  $ageOnDate = September 1, 2020
    }
    else {
      $ageInYear = date('Y') - 1;
      //  Otherwise (today's date is before "Move Up Day" this year), $ageOnDate = "School Cut-Off Date" in the previous year.
      //  Example:
      //  Move Up Day: June 1
      //  School Cut-Off Date: September 1
      //  Today's date: May 31 (or any date earlier in the year)
      //  $ageOnDate = September 1, 2019
    }

    $ageOnDateParams = [
      'month' => $schoolCutOffDay['M'],
      'day' => $schoolCutOffDay['d'],
      'year' => $ageInYear,
    ];
    $this->ageOnDateTimeObj = date_create(CRM_Utils_Date::getToday($ageOnDateParams));

  }

  /**
   * Singleton pattern.
   */
  public static function singleton(CRM_Namelessprogress_Utils $instance = NULL) {
    if ($instance !== NULL) {
      self::$_singleton = $instance;
    }
    if (self::$_singleton === NULL) {
      self::$_singleton = new CRM_Namelessprogress_Util();
    }
    return self::$_singleton;
  }

  /**
   * For a given contact, calculate the age as of $this->ageOnDateTimeObj
   * @param Array $contact as returned by contact.getsingle api.
   * @return Integer
   */
  public function calculateAge($contact) {
    $birthDate = CRM_Utils_Array::value('birth_date', $contact);
    $birthDateTimeObj = date_create($birthDate);
    $interval = date_diff($birthDateTimeObj, $this->ageOnDateTimeObj);
    $ageInYears = $interval->format('%y');
    return $ageInYears;
  }

  /**
   * Utility function to get "moveup day" in the current year.
   * @return String 'YYYY-MM-DD'
   */
  public static function getDateMoveUpThisYear() {
    // Define $dateMoveUpThisYear = value of setting "Move-up date", in the current year.
    $moveupday = civicrm_api3('Setting', 'getvalue', [
      'name' => "namelessprogress_moveupday",
    ]);
    $moveupday['M'];
    $moveupday['d'];
    $moveupDateParams = [
      'month' => $moveupday['M'],
      'day' => $moveupday['d'],
      'year' => date('Y'),
    ];
    $dateMoveUpThisYear = CRM_Utils_Date::getToday($moveupDateParams);
    return $dateMoveUpThisYear;
  }

}
