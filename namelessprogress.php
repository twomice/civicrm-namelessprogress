<?php

require_once 'namelessprogress.civix.php';
use CRM_Namelessprogress_ExtensionUtil as E;

/**
 * Implements hook_civicrm_buildForm().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_buildForm/
 */
function namelessprogress_civicrm_buildForm($formName, &$form = NULL) {
  if ($formName == 'CRM_Admin_Form_ContactType') {
    // Alter the description for the 'ageprogress_max_age' max field.
    $moveupday = civicrm_api3('Setting', 'getvalue', ['name' => "namelessprogress_moveupday"]);
    $moveUpDayString = date('F j', strtotime("2000-{$moveupday['M']}-{$moveupday['d']}"));

    $schoolcutoffday = civicrm_api3('Setting', 'getvalue', ['name' => "namelessprogress_schoolcutoffday"]);
    $schoolHCutOffDayString = date('F j', strtotime("2000-{$schoolcutoffday['M']}-{$schoolcutoffday['d']}"));

    $descriptions['ageprogress_max_age'] =
      E::ts('Contact sub-type is automatically changed on <strong>%1</strong> of each year, based on the contact\'s age calculated on <strong>%2</strong> of that year. (You can change those values in the <a href=%3>Student Progress settings</a>). Contacts calculated to be above this age will be automatically removed from this sub-type.',
        [
          '1' => $moveUpDayString,
          '2' => $schoolHCutOffDayString,
          '3' => CRM_Utils_System::url('civicrm/admin/namelessprogress/settings'),
        ]
      );
    CRM_Core_Resources::singleton()->addVars('ageprogress', ['descriptions' => $descriptions]);
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function namelessprogress_civicrm_config(&$config) {
  _namelessprogress_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function namelessprogress_civicrm_xmlMenu(&$files) {
  _namelessprogress_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function namelessprogress_civicrm_install() {
  _namelessprogress_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function namelessprogress_civicrm_postInstall() {
  _namelessprogress_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function namelessprogress_civicrm_uninstall() {
  _namelessprogress_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function namelessprogress_civicrm_enable() {
  _namelessprogress_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function namelessprogress_civicrm_disable() {
  _namelessprogress_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function namelessprogress_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _namelessprogress_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function namelessprogress_civicrm_managed(&$entities) {
  _namelessprogress_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function namelessprogress_civicrm_caseTypes(&$caseTypes) {
  _namelessprogress_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function namelessprogress_civicrm_angularModules(&$angularModules) {
  _namelessprogress_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function namelessprogress_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _namelessprogress_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function namelessprogress_civicrm_entityTypes(&$entityTypes) {
  _namelessprogress_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function namelessprogress_civicrm_themes(&$themes) {
  _namelessprogress_civix_civicrm_themes($themes);
}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
function namelessprogress_civicrm_navigationMenu(&$menu) {
  _namelessprogress_get_max_navID($menu, $max_navID);
  _namelessprogress_civix_insert_navigation_menu($menu, 'Administer/Localization', array(
    'label' => E::ts('Student Progress Settings'),
    'name' => 'Student Progress Settings',
    'url' => 'civicrm/admin/namelessprogress/settings?reset=1',
    'permission' => 'administer CiviCRM',
    'operator' => 'AND',
    'separator' => NULL,
    'navID' => ++$max_navID,
  ));
  _namelessprogress_civix_navigationMenu($menu);
}

/**
 * For an array of menu items, recursively get the value of the greatest navID
 * attribute.
 * @param <type> $menu
 * @param <type> $max_navID
 */
function _namelessprogress_get_max_navID(&$menu, &$max_navID = NULL) {
  foreach ($menu as $id => $item) {
    if (!empty($item['attributes']['navID'])) {
      $max_navID = max($max_navID, $item['attributes']['navID']);
    }
    if (!empty($item['child'])) {
      _namelessprogress_get_max_navID($item['child'], $max_navID);
    }
  }
}

/**
 * Implements hook_civicrm_ageprogress_alterAgeCalcMethod().
 *
 * @link https://twomice.github.io/com.joineryhq.ageprogress/
 */
function namelessprogress_civicrm_ageprogress_alterAgeCalcMethod(&$callback) {
  $callback = '_namelessprogress_calculateContactAge';
}

/**
 * Callback for custom age calculation on a given contact.
 * @param type $contact
 * @return type
 * @see namelessprogress_civicrm_ageprogress_alterAgeCalcMethod()
 */
function _namelessprogress_calculateContactAge($contact) {
  $util = CRM_Namelessprogress_Util::singleton();
  return $util->calculateAge($contact);
}

/**
 * Implements hook_civicrm_ageprogress_alterIsDoUpdate().
 *
 * @link https://twomice.github.io/com.joineryhq.ageprogress/
 */
function namelessprogress_civicrm_ageprogress_alterIsDoUpdate(&$isDoUpdate, $apiParams) {
  // Honor the is_force parameter;
  if (CRM_Utils_Array::value('is_force', $apiParams)) {
    $isDoUpdate = TRUE;
    return;
  }
  //  Define $completedMoveUpFullDate = value of "completedMoveUpFullDate" setting.
  $completedMoveUpFullDate = civicrm_api3('Setting', 'getvalue', [
    'name' => "namelessprogress_completedMoveUpFullDate",
  ]);

  $dateMoveUpThisYear = CRM_Namelessprogress_Util::getDateMoveUpThisYear();

  //  If $dateMoveUpThisYear = $completedMoveUpFullDate:
  if ($dateMoveUpThisYear == $completedMoveUpFullDate) {
    //  This means we've already run the job for this year.
    //  Therefore, return FALSE: perform no updates now.
    $isDoUpdate = FALSE;
  }

  //  If today's date is NOT equal to or greater than $dateMoveUpThisYear:
  elseif (strtotime(CRM_Utils_Date::getToday()) < strtotime($dateMoveUpThisYear)) {
    //  This means it's not yet time to run the job for this year.
    //  Therefore, return FALSE: perform no updates now.
    $isDoUpdate = FALSE;
  }
  //  Otherwise, it means the Move Up process has not yet been done for this year, and it's time to do it.
  else {
    //  Therefore, return TRUE: perform updates now.
    $isDoUpdate = TRUE;
  }
}

/**
 * Implements hook_civicrm_custom().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_custom/
 */
function namelessprogress_civicrm_custom($op, $groupID, $entityID, &$params) {
  if ($op == 'create' || $op == 'edit') {
    $yearsAdvancedCustomFieldId = CRM_Core_BAO_CustomField::getCustomFieldID('School_grade_years_advanced', 'Student_Progress');
    foreach ($params as $param) {
      // $params will be an array of custom field values. If one of those is
      // the "years advanced" field, update school grade accordingly.
      if ($param['custom_field_id'] == $yearsAdvancedCustomFieldId) {
        // Get the contact.
        $contact = civicrm_api3('Contact', 'getsingle', ['id' => $entityID]);
        // Append the new "years advanced" value to the contact, so we don't
        // have to fetch it later from the database.
        $contact["custom_{$yearsAdvancedCustomFieldId}"] = $param['value'];
        // Calculate grade and update the contact.
        $grade = CRM_Namelessprogress_Util::calculateContactGrade($contact);
        CRM_Namelessprogress_Util::updateContactGrade($entityID, $grade);
      }
    }
  }
}

/**
 * Implements hook_civicrm_post().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_post/
 */
function namelessprogress_civicrm_post($op, $objectName, $id, $objectRef) {
  // On Create or Edit of any Inividual, modify grade based on age.
  if ($objectName == 'Individual'
    && (
      $op == 'create'
      || $op == 'edit'
    )
  ) {
    $params = $objectRef->toArray();
    // We'll need to calculate the grade by age.
    // Get birthdate from params if given. If not given, it's not being changed,
    // so we'll have nothing to do anyway.
    if (CRM_Utils_Array::value('birth_date', $params)) {
      $grade = CRM_Namelessprogress_Util::calculateContactGrade($params);
      CRM_Namelessprogress_Util::updateContactGrade($id, $grade);
    }
  }
}

/**
 * Implements hook_civicrm_ageprogress_postUpdate().
 *
 * @link https://twomice.github.io/com.joineryhq.ageprogress/
 */
function namelessprogress_civicrm_ageprogress_postUpdate($apiParams, &$return) {
  // Additional counts for return values.
  $return['namelessprogressGradeProcessedCount'] = 0;
  $return['namelessprogressGradeUpdateCount'] = 0;
  $return['namelessprogressGradeErrorCount'] = 0;

  $util = CRM_Namelessprogress_Util::singleton();
  $gradeCustomFieldId = CRM_Core_BAO_CustomField::getCustomFieldID('School_grade', 'Student_Progress');
  $yearsAdvancedCustomFieldId = CRM_Core_BAO_CustomField::getCustomFieldID('School_grade_years_advanced', 'Student_Progress');
  //  For each contact matching the same api parameters:
  $apiParams['return'][] = 'custom_' . $yearsAdvancedCustomFieldId;
  $contactGet = civicrm_api3('contact', 'get', $apiParams);
  foreach ($contactGet['values'] as $contact) {
    $grade = CRM_Namelessprogress_Util::calculateContactGrade($contact);

    try {
      CRM_Namelessprogress_Util::updateContactGrade($contact['id'], $grade);
      $return['namelessprogressGradeUpdateCount']++;
    }
    catch (CiviCRM_API3_Exception $e) {
      $return['namelessprogressGradeErrorCount']++;
      CRM_Core_Error::debug_log_message('Namelessprogress: encountered API error in CRM_Namelessprogress_Util::updateContactGrade() while updating grade for contact ID=' . $contact['id'] . '; API error message: ' . $e->getMessage());
    }
    $return['namelessprogressGradeProcessedCount']++;
  }
  //  Now that all contacts have been processed, update the setting "completedMoveUpDate"
  //  to the value of setting "Move-up date", in the current year (thus our
  //  "hook_civicrm_ageprogress_alterIsDoUpdate" implementation will know that this
  //  Move Up Day has been processed in the current year).
  $dateMoveUpThisYear = CRM_Namelessprogress_Util::getDateMoveUpThisYear();
  $settingCreate = civicrm_api3('Setting', 'create', [
    'namelessprogress_completedMoveUpFullDate' => $dateMoveUpThisYear,
  ]);
}
