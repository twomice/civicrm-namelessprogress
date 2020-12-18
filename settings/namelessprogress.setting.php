<?php
/*
 * Settings metadata file
 */

use CRM_Namelessprogress_ExtensionUtil as E;

return [
  'namelessprogress_moveupday' => [
    'group_name' => 'namelessprogress',
    'name' => 'namelessprogress_moveupday',
    'type' => 'Array',
    'quick_form_type' => 'MonthDay',
    'html_type' => 'MonthDay',
    'default' => ['M' => 1, 'd' => 1],
    'add' => '5.0',
    'title' => E::ts('Move-up Day'),
    'is_domain' => 0,
    'is_contact' => 0,
    'description' => E::ts('Contacts\' "School Grade" and contact sub-type will be automatically adjusted on this date each year.'),
  ],
  'namelessprogress_schoolcutoffday' => [
    'group_name' => 'namelessprogress',
    'name' => 'namelessprogress_schoolcutoffday',
    'type' => 'Array',
    'quick_form_type' => 'MonthDay',
    'html_type' => 'MonthDay',
    'default' => ['M' => 1, 'd' => 1],
    'add' => '5.0',
    'title' => E::ts('School Cut-off Day'),
    'is_domain' => 0,
    'is_contact' => 0,
    'description' => E::ts('"School Grade" and contact sub-type calculations are based on the student\'s age on this date each year.'),
  ],
  'namelessprogress_kstartage' => [
    'group_name' => 'namelessprogress',
    'name' => 'namelessprogress_kstartage',
    'type' => 'Integer',
    'quick_form_type' => 'Element',
    'html_type' => 'text',
    'default' => 5,
    'add' => '5.0',
    'title' => E::ts('Kindergarten Starting Age'),
    'is_domain' => 0,
    'is_contact' => 0,
    'description' => E::ts('When students\' "School Grade" field is updated, students who are calcluated at this age will be placed in Kindergarten, and higher grades will be incremented based on this starting point.'),
    'X_form_rules_args' => array(
      [E::ts('The field "Kindergarten Starting Age" is required.'), 'required'],
      [E::ts('The field "Kindergarten Starting Age" must be an integer.'), 'integer'],
    ),
  ],
  'namelessprogress_completedMoveUpFullDate' => [
    'group_name' => 'namelessprogress',
    'name' => 'namelessprogress_completedMoveUpFullDate',
    'type' => 'Date',
    'add' => '5.0',
    // No title; this hides the settings field from the settings form, per
    // CRM_Namelessprogress_Form_Settings::getRenderableElementNames().
    'title' => '',
    // These attributes are also meaningless for this hidden setting:
    // 'quick_form_type' => 'Element',
    // 'html_type' => 'text',
    // 'default' => 5,
    'is_domain' => 0,
    'is_contact' => 0,
  ],

];
