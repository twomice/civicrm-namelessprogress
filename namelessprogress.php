<?php

require_once 'namelessprogress.civix.php';
use CRM_Namelessprogress_ExtensionUtil as E;

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
  _namelessprogress_civix_insert_navigation_menu($menu, 'Administer/Customize Data and Screens', array(
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
 * Implements hook_civicrm_ageprogress_alterIsDoUpdate().
 *
 * @link https://twomice.github.io/com.joineryhq.ageprogress/
 */
function namelessprogress_civicrm_ageprogress_alterIsDoUpdate(&$isDoUpdate) {
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

function _namelessprogress_calculateContactAge($contact) {
  $util = CRM_Namelessprogress_Util::singleton();
  return $util->calculateAge($contact);
}
