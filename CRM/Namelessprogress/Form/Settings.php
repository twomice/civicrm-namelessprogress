<?php

require_once 'CRM/Core/Form.php';

use CRM_Namelessprogress_ExtensionUtil as E;

/**
 * Form controller class for extension Settings form.
 * Borrowed heavily from
 * https://github.com/eileenmcnaughton/nz.co.fuzion.civixero/blob/master/CRM/Civixero/Form/XeroSettings.php
 *
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC43/QuickForm+Reference
 */
class CRM_Namelessprogress_Form_Settings extends CRM_Admin_Form_Setting {

  private static $extensionName = 'namelessprogress';
  private $_settingsFields = array();
  public $_settings = array();

  public function __construct(
    $state = NULL, $action = CRM_Core_Action::NONE, $method = 'post', $name = NULL
  ) {

    $this->setSettingsFields();
    $this->setSettings();

    parent::__construct(
      $state = NULL, $action = CRM_Core_Action::NONE, $method = 'post', $name = NULL
    );
  }

  public function buildQuickForm() {
    parent::buildQuickForm();

    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());

    // export descrciptions
    $descriptions = [];
    foreach ($this->_settingsFields as $name => $setting) {
      $descriptions[$setting['name']] = ts($setting['description']);
    }

    // Set form rules
    if (!empty($setting['X_form_rules_args'])) {
      $rules_args = (array) $setting['X_form_rules_args'];
      foreach ($rules_args as $rule_args) {
        array_unshift($rule_args, $setting['name']);
        call_user_func_array(array($this, 'addRule'), $rule_args);
      }
    }

    $this->assign("descriptions", $descriptions);

  }

  public function validate() {
    // Ensure date fields are useful dates (no leap day, no non-existent dates)
    $maxDaysPerMonth = [
      '1' => 31,
      '2' => 28,
      '3' => 31,
      '4' => 30,
      '5' => 31,
      '6' => 30,
      '7' => 31,
      '8' => 31,
      '9' => 30,
      '10' => 31,
      '11' => 30,
      '12' => 31,
    ];
    $values = $this->exportValues();
    foreach (['namelessprogress_moveupday', 'namelessprogress_schoolcutoffday'] as $fieldName) {
      $value = $values[$fieldName];
      $month = $value['M'];
      $day = $value['d'];
      if ($day > $maxDaysPerMonth[$month]) {
        $this->_errors[$fieldName] = E::ts('This date is not acceptable in this context; please select an earlier day in the month.');
      }
    }
    parent::validate();
  }

  public function postProcess() {
    parent::postProcess();
    CRM_Utils_System::redirect(CRM_Utils_System::url('civicrm/admin/namelessprogress/settings', 'reset=1'));
  }

  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  private function getRenderableElementNames() {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons". These
    // items don't have labels. We'll identify renderable by filtering on
    // the 'label'.
    $elementNames = array();
    foreach ($this->_elements as $element) {
      $label = $element->getLabel();
      if (!empty($label) && !CRM_Utils_Array::value('data-settings-custom', $element->_attributes)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }

  /**
   * Define the list of settings we are going to allow to be set on this form.
   */
  private function setSettingsFields() {
    if (empty($this->_settingsFields)) {
      $settingsGetFields = civicrm_api3('setting', 'getfields', array('filters' => array('group_name' => self::$extensionName)));
      $this->_settingsFields = $settingsGetFields['values'];
    }
  }

  /**
   * Define the list of settings we are going to allow to be set on this form.
   */
  private function setSettings() {
    if (empty($this->_settings)) {
      $this->_settings = [];
      foreach (array_keys($this->_settingsFields) as $key) {
        $this->_settings[$key] = self::$extensionName;
      }
    }
  }

}
