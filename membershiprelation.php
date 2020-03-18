<?php

  require_once 'membershiprelation.civix.php';
  require_once 'membershiprelation.constants.php';
  use CRM_Membershiprelation_ExtensionUtil as E;

  /**
   * Implements hook_civicrm_config().
   *
   * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
   */
  function membershiprelation_civicrm_config(&$config) {
    CRM_Core_Resources::singleton()->addStyleFile('biz.jmaconsulting.membershiprelation', 'css/memstyle.css');

    _membershiprelation_civix_civicrm_config($config);
  }

  function membershiprelation_civicrm_summaryActions(&$menu, $contactId) {
    $menu['otherActions']['user-add'] = [
      'title' => ts('Create User Record'),
      'description' => ts('Create User Record'),
      'weight' => 25,
      'ref' => 'crm-contact-user-add',
      'key' => 'user-add',
      'tab' => 'user-add',
      'class' => 'user-add',
      'href' => CRM_Utils_System::url('civicrm/contact/view/useradd', 'reset=1&action=add&cid=' . $contactId),
      'icon' => 'crm-i fa-user-plus',
    ];
  }

  function _saveChapter($id, $chapter = NULL) {
    $ch = CRM_Core_DAO::singleValueQuery("SELECT cagis_chapter_1 FROM civicrm_value_cagis_members_1 WHERE entity_id = $id");
    if (empty($ch) && !empty($chapter)) {
      CRM_Core_DAO::singleValueQuery("INSERT IGNORE INTO civicrm_value_cagis_members_1 (entity_id, cagis_chapter_1) VALUES ($id, '$chapter')");
    }
  }

  function membershiprelation_civicrm_postSave_civicrm_membership($dao) {
    if (isset($dao->owner_membership_id) && !empty($dao->owner_membership_id)) {
      $chapter = CRM_Core_DAO::singleValueQuery("SELECT cagis_chapter_1 FROM civicrm_value_cagis_members_1 WHERE entity_id = $dao->owner_membership_id");
      _saveChapter($dao->id, $chapter);
    }
  }

  function membershiprelation_civicrm_post($op, $objectName, $objectId, &$objectRef) {
    if ($op == "create" && $objectName == "Membership") {
      if (isset($objectRef->owner_membership_id) && !empty($objectRef->owner_membership_id)) {
       $chapter = CRM_Core_DAO::singleValueQuery("SELECT cagis_chapter_1 FROM civicrm_value_cagis_members_1 WHERE entity_id = $objectRef->owner_membership_id");
        _saveChapter($objectId, $chapter);
      }
    }
  }

  /**
   * Implements hook_civicrm_xmlMenu().
   *
   * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
   */
  function membershiprelation_civicrm_xmlMenu(&$files) {
    _membershiprelation_civix_civicrm_xmlMenu($files);
  }

  /**
   * Implements hook_civicrm_install().
   *
   * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
   */
  function membershiprelation_civicrm_install() {
    _membershiprelation_civix_civicrm_install();
  }

  /**
   * Implements hook_civicrm_postInstall().
   *
   * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
   */
  function membershiprelation_civicrm_postInstall() {
    _membershiprelation_civix_civicrm_postInstall();
  }

  /**
   * Implements hook_civicrm_uninstall().
   *
   * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
   */
  function membershiprelation_civicrm_uninstall() {
    _membershiprelation_civix_civicrm_uninstall();
  }

  /**
   * Implements hook_civicrm_enable().
   *
   * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
   */
  function membershiprelation_civicrm_enable() {
    _membershiprelation_civix_civicrm_enable();
  }

  /**
   * Implements hook_civicrm_disable().
   *
   * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
   */
  function membershiprelation_civicrm_disable() {
    _membershiprelation_civix_civicrm_disable();
  }

  /**
   * Implements hook_civicrm_upgrade().
   *
   * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
   */
  function membershiprelation_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
    return _membershiprelation_civix_civicrm_upgrade($op, $queue);
  }

  /**
   * Implements hook_civicrm_managed().
   *
   * Generate a list of entities to create/deactivate/delete when this module
   * is installed, disabled, uninstalled.
   *
   * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
   */
  function membershiprelation_civicrm_managed(&$entities) {
    _membershiprelation_civix_civicrm_managed($entities);
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
  function membershiprelation_civicrm_caseTypes(&$caseTypes) {
    _membershiprelation_civix_civicrm_caseTypes($caseTypes);
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
  function membershiprelation_civicrm_angularModules(&$angularModules) {
    _membershiprelation_civix_civicrm_angularModules($angularModules);
  }

  /**
   * Implements hook_civicrm_alterSettingsFolders().
   *
   * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
   */
  function membershiprelation_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
    _membershiprelation_civix_civicrm_alterSettingsFolders($metaDataFolders);
  }

  /**
   * Implements hook_civicrm_entityTypes().
   *
   * Declare entity types provided by this module.
   *
   * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
   */
  function membershiprelation_civicrm_entityTypes(&$entityTypes) {
    _membershiprelation_civix_civicrm_entityTypes($entityTypes);
  }

  /**
   * Implements hook_civicrm_thems().
   */
  function membershiprelation_civicrm_themes(&$themes) {
    _membershiprelation_civix_civicrm_themes($themes);
  }

  /**
   * Implements hook_civicrm_buildForm().
   *
   * @param string $formName
   * @param CRM_Core_Form $form
   */
  function membershiprelation_civicrm_buildForm($formName, &$form) {
    if ($formName == "CRM_Contribute_Form_Contribution_Main" && $form->getVar('_id') == 1) {
      $submitButton = [
        'type' => 'upload',
        'name' => ts('Submit'),
        'spacing' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
        'isDefault' => TRUE,
      ];
      $form->addButtons([$submitButton]);
      CRM_Core_Region::instance('page-body')->add(array(
        'template' => 'CRM/Membershiprelation/ParentChild.tpl',
      ));
      CRM_Core_Resources::singleton()->addScriptFile('biz.jmaconsulting.membershiprelation', 'js/membership-form.js');
    }
    if ($formName == "CRM_Contribute_Form_Contribution_Confirm" && $form->getVar('_id') == 1) {
      if (!empty($form->_lineItem)) {
        $membershipPriceFieldIDs = [];
        $priceSetId = key($form->_lineItem);
        foreach ((array) $form->_lineItem[$priceSetId] as $lineItem) {
          $membershipPriceFieldIDs['id'] = $priceSetId;
          $membershipPriceFieldIDs[] = $lineItem['price_field_value_id'];
        }
        $form->set('memberPriceFieldIDS', $membershipPriceFieldIDs);
      }

      $form->addButtons([
        [
          'type' => 'next',
          'name' => ts('Confirm'),
          'spacing' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
          'isDefault' => TRUE,
        ],
        [
          'type' => 'back',
          'name' => ts('Go Back'),
        ],
      ]);
    }

    if ($formName == 'CRM_Price_Form_Field') {
      // form fields of Custom Option rows
      $_showHide = new CRM_Core_ShowHideBlocks('', '');
      $attributes = CRM_Core_DAO::getAttribute('CRM_Price_DAO_PriceFieldValue');
      $financialType = CRM_Financial_BAO_FinancialType::getIncomeFinancialType();
      foreach ($financialType as $finTypeId => $type) {
        if (CRM_Financial_BAO_FinancialType::isACLFinancialTypeStatus()
          && !CRM_Core_Permission::check('add contributions of type ' . $type)
        ) {
          unset($financialType[$finTypeId]);
        }
      }
      if (count($financialType)) {
        $form->assign('financialType', $financialType);
      }
      for ($i = 1; $i <= 100; $i++) {

        //the show hide blocks
        $showBlocks = 'optionField_' . $i;
        if ($i > 2) {
          $_showHide->addHide($showBlocks);
          if ($i == 100) {
            $_showHide->addHide('additionalOption');
          }
        }
        else {
          $_showHide->addShow($showBlocks);
        }
        // label
        $attributes['label']['size'] = 25;
        $form->add('text', 'option_label[' . $i . ']', ts('Label'), $attributes['label']);

        // amount
        $form->add('text', 'option_amount[' . $i . ']', ts('Amount'), $attributes['amount']);
        $form->addRule('option_amount[' . $i . ']', ts('Please enter a valid amount for this field.'), 'money');

        //Financial Type
        $form->add(
          'select',
          'option_financial_type_id[' . $i . ']',
          ts('Financial Type'),
          ['' => ts('- select -')] + $financialType
        );
        $membershipTypes = CRM_Member_PseudoConstant::membershipType();
        $js = ['onchange' => "calculateRowValues( $i );"];

        $form->add('select', 'membership_type_id[' . $i . ']', ts('Membership Type'),
          ['' => ' '] + $membershipTypes, FALSE, $js
        );
        $form->add('text', 'membership_num_terms[' . $i . ']', ts('Number of Terms'), CRM_Utils_Array::value('membership_num_terms', $attributes));

        // weight
        $form->add('number', 'option_weight[' . $i . ']', ts('Order'), $attributes['weight']);

        // is active ?
        $form->add('checkbox', 'option_status[' . $i . ']', ts('Active?'));

        $visibilityType = CRM_Core_PseudoConstant::visibility();
        $form->add('select', 'option_visibility_id[' . $i . ']', ts('Visibility'), $visibilityType);
        $defaultOption[$i] = $form->createElement('radio', NULL, NULL, NULL, $i);

        //for checkbox handling of default option
        $form->add('checkbox', "default_checkbox_option[$i]", NULL);
      }
      //default option selection
      $form->addGroup($defaultOption, 'default_option');
      $_showHide->addToTemplate();
    }
  }

  /**
   * Implements hook_civicrm_validateForm().
   *
   * @param string $formName
   * @param CRM_Core_Form $form
   */
  function membershiprelation_civicrm_validateForm($formName, &$fields, &$files, &$form, &$errors) {
    if ($formName == "CRM_Contribute_Form_Contribution_Main" || $formName == 'CRM_Price_Form_Field') {
      if (strstr(CRM_Utils_Array::value('_qf_default', $form->_errors, ''), 'You have selected multiple memberships')) {
        unset($form->_errors['_qf_default']);
      }
    }
    if ($formName == "CRM_Contribute_Form_Contribution_Main" && $form->getVar('_id') == 1) {
      switch ($fields[CHILDPRICEM]) {
        case TWOGIRLS:
          if (empty($fields[CHILD2FNM]) && empty($fields[CHILD2LNM])) {
            $errors[CHILD2FNM] = ts('First and last name of Member 2 must be entered.');
          }
          if (empty($fields[CHILD2DOBM])) {
            $errors[CHILD2DOBM] = ts('Please enter birthday for Member 2.');
          }
          break;
        case THREEGIRLS:
          if (empty($fields[CHILD2FNM]) && empty($fields[CHILD2LNM])) {
            $errors[CHILD2FNM] = ts('First and last name of Member 2 must be entered.');
          }
          if (empty($fields[CHILD3FNM]) && empty($fields[CHILD3LNM])) {
            $errors[CHILD3FNM] = ts('First and last name of Member 3 must be entered.');
          }
          if (empty($fields[CHILD2DOBM])) {
            $errors[CHILD2DOBM] = ts('Please enter birthday for Member 2.');
          }
          if (empty($fields[CHILD3DOBM])) {
            $errors[CHILD3DOBM] = ts('Please enter birthday for Member 3.');
          }
          break;
        case FOURGIRLS:
          if (empty($fields[CHILD2FNM]) && empty($fields[CHILD2LNM])) {
            $errors[CHILD2FNM] = ts('First and last name of Member 2 must be entered.');
          }
          if (empty($fields[CHILD3FNM]) && empty($fields[CHILD3LNM])) {
            $errors[CHILD3FNM] = ts('First and last name of Member 3 must be entered.');
          }
          if (empty($fields[CHILD4FNM]) && empty($fields[CHILD4LNM])) {
            $errors[CHILD4FNM] = ts('First and last name of Member 4 must be entered.');
          }
          if (empty($fields[CHILD2DOBM])) {
            $errors[CHILD2DOBM] = ts('Please enter birthday for Member 2.');
          }
          if (empty($fields[CHILD3DOBM])) {
            $errors[CHILD3DOBM] = ts('Please enter birthday for Member 3.');
          }
          if (empty($fields[CHILD4DOBM])) {
            $errors[CHILD4DOBM] = ts('Please enter birthday for Member 4.');
          }
          break;
        default:
          break;
      }
    }
  }

  function _dedupeParams(&$params) {
    $clauses = [];
    foreach (['first_name', 'last_name', 'email'] as $attribute) {
      if (!empty($params[$attribute])) {
        if ($attribute == 'email' && !empty($params['birth_date'])) {
          $clauses[] = sprintf("( email = '%s' OR birth_date = '%s' )", $params[$attribute], CRM_Utils_Date::processDate($params['birth_date']));
        }
        else {
          $clauses[] = "{$attribute} = '" . $params[$attribute] ."'";
        }
      }
    }
    if (!empty($clauses)) {
      $clauses[] = "contact_type LIKE '%Individual%'";
      $sql = "SELECT MIN(cc.id)
        FROM civicrm_contact cc
         INNER JOIN civicrm_email e ON e.contact_id = cc.id
        WHERE " . implode (" AND ", $clauses);
      $params['contact_id'] = CRM_Core_DAO::singleValueQuery($sql);
    }
  }

  /**
   * Implements hook_civicrm_postProcess().
   *
   * @param string $formName
   * @param CRM_Core_Form $form
   * @throws CiviCRM_API3_Exception
   */
  function membershiprelation_civicrm_postProcess($formName, &$form) {
    if ($formName == 'CRM_Admin_Form_Options' && $form->getVar('_gName') == 'cagis_chapter') {
      $params = $form->exportValues();
      createMembershipTypesForChapter($params);
    }
    if ($formName == 'CRM_Custom_Form_Option') {
      $ogid = $form->getVar('_optionGroupID');
      $optionGroupDetails = civicrm_api3('OptionGroup', 'getsingle', ['id' => $ogid]);
      if ($optionGroupDetails['name'] == 'cagis_chapter') {
        $params = $form->exportValues();
        createMembershipTypesForChapter($params);
      }
    }
    if ($formName == "CRM_Contribute_Form_Contribution_Main" && $form->getVar('_id') == 1) {
      $lineItem = $form->get('lineItem');
      // remove the default price field selection from submitted variables
      $priceSetId = key($lineItem);
      foreach ($lineItem[$priceSetId] as $key => $priceFieldValue) {
        if (in_array($key, [ONEGIRL, TWOGIRLS, THREEGIRLS, FOURGIRLS])) {
          unset($lineItem[$priceSetId][$key]);
          $form->_params['amount'] -= $priceFieldValue['line_total'];
        }
      }
      $form->set('amount', $form->_params['amount']);
      unset($form->_params[CHILDPRICEM]);
      $form->set('lineItem', $lineItem);
      $form->_lineItem = $lineItem;
    }
    if ($formName == "CRM_Contribute_Form_Contribution_Confirm" && $form->getVar('_id') == 1) {
      $child1 = $form->_contactID;
      $child1Details = [];
      if (!empty($child1)) {
        $child1Details = CRM_Utils_Array::value($child1, civicrm_api3('Contact', 'get', ['id' => $child1])['values']);
      }

      $address = civicrm_api3('Address', 'get', ['contact_id' => $child1])['values'];
      $phone = civicrm_api3('Phone', 'get', ['contact_id' => $child1])['values'];
      $parent1ID = NULL;

      $relatedContacts = [
        'parent1' => [
          'first_name' => $form->_params[PARENT1FNM] ?: '',
          'last_name' => $form->_params[PARENT1LNM] ?: '',
          'email' => $form->_params[PARENT1EMAILM] ?: '',
        ],
        'parent2' => [
          'first_name' => $form->_params[PARENT2FNM] ?: '',
          'last_name' => $form->_params[PARENT2LNM] ?: '',
          'email' => $form->_params[PARENT2EMAILM] ?: '',
        ],
        'child2' => [
          'first_name' => $form->_params[CHILD2FNM] ?: '',
          'last_name' => $form->_params[CHILD2LNM] ?: '',
          'birth_date' => $form->_params[CHILD2DOBM] ?: '',
          'email' => $form->_params[CHILD2EMM] ?: '',
          GRADE => $form->_params[CHILD2G] ?: '',
        ],
        'child3' => [
          'first_name' => $form->_params[CHILD3FNM] ?: '',
          'last_name' => $form->_params[CHILD3LNM] ?: '',
          'birth_date' => $form->_params[CHILD3DOBM] ?: '',
          'email' => $form->_params[CHILD3EMM] ?: '',
          GRADE => $form->_params[CHILD3G] ?: '',
        ],
        'child4' => [
          'first_name' => $form->_params[CHILD4FNM] ?: '',
          'last_name' => $form->_params[CHILD4LNM] ?: '',
          'birth_date' => $form->_params[CHILD4DOBM] ?: '',
          'email' => $form->_params[CHILD4EMM] ?: '',
          GRADE => $form->_params[CHILD4G] ?: '',
        ],
      ];

      if (empty($form->_params['email-Primary']) && !empty($relatedContacts['parent1']['email'])) {
        civicrm_api3('Email', 'create', ['contact_id' => $child1, 'email' => $relatedContacts['parent1']['email'], 'is_primary' => 1]);
      }
      // If they have opted into the e-list subscribe the first child.
      if (!empty($form->_params['custom_43'])) {
        subscribeMemberToElist($child1);
      }

      foreach ($relatedContacts as $person => $params) {
        if (empty($params['first_name']) && empty($params['last_name'])) {
          continue;
        }
        $params['contact_type'] = 'Individual';

        if (in_array($person, ['child2', 'child3', 'child4'])) {
          $params['contact_sub_type'] = 'Child';
        }
        if ($person != 'parent1' && empty($params['email'])) {
          $params['email'] = $relatedContacts['parent1']['email'];
        }
        _dedupeParams($params);
        $contact[$person] = (array) civicrm_api3('Contact', 'create', $params)['id'];

        // Add address
        foreach ($address as $k => &$val) {
          unset($val['id']);
          $val['contact_id'] = $contact[$person][0];
          $val['master_id'] = $k;
          civicrm_api3('Address', 'create', $address[$k]);
        }

        // Add Phone
        foreach ($phone as $k => &$val) {
          unset($val['id']);
          $val['contact_id'] = $contact[$person][0];
          civicrm_api3('Phone', 'create', $phone[$k]);
        }

        // If they have opted into the e-list subscribe the related contact as well
        if (!empty($form->_params['custom_43']) && !empty($params['email'])) {
          subscribeMemberToElist($contact[$person][0]);
        }
      }

      // Create relationships
      $sibling = CRM_Core_DAO::getFieldValue('CRM_Contact_DAO_RelationshipType', 'Sibling of', 'id', 'name_a_b');
      $childRel = CRM_Core_DAO::getFieldValue('CRM_Contact_DAO_RelationshipType', 'Child of', 'id', 'name_a_b');
      $spouseRel = CRM_Core_DAO::getFieldValue('CRM_Contact_DAO_RelationshipType', 'Spouse of', 'id', 'name_a_b');

      // Parent of Relationship with 1st guardian
      if (!empty($contact['parent1'])) {
        $parent1 = $parent1ID = $contact['parent1'][0];
        createRelationshipMember($child1, $parent1, $childRel);

        // create wp user
        createWpUser($parent1, TRUE);

        foreach ($contact as $person => $con) {
          if (in_array($person, ['child2', 'child3', 'child4']) && !empty($contact[$person][0]) && ($contact[$person][0] != $parent1)) {
            createRelationshipMember($contact[$person][0], $parent1, $childRel);
          }
        }
      }

      // Parent of Relationship with 2nd guardian
      if (!empty($contact['parent2'])) {
        $parent2 = $contact['parent2'][0];
        createRelationshipMember($child1, $parent2, $childRel);
        foreach ($contact as $person => $con) {
          if (in_array($person, ['child2', 'child3', 'child4']) && !empty($contact[$person][0])) {
            createRelationshipMember($contact[$person][0], $parent2, $childRel);
          }
        }
      }

      // Spouse Relationships
      if (!empty($contact['parent1']) && !empty($contact['parent2'])) {
        createRelationshipMember($contact['parent1'][0], $contact['parent2'][0], $spouseRel);
      }

      // Child Relationships
      if (!empty($contact['child2'])) {
        createRelationshipMember($child1, $contact['child2'][0], $sibling);
      }
      if (!empty($contact['child3'])) {
        createRelationshipMember($child1, $contact['child3'][0], $sibling);
        createRelationshipMember($contact['child2'][0], $contact['child3'][0], $sibling);
      }
      if (!empty($contact['child4'])) {
        createRelationshipMember($child1, $contact['child4'][0], $sibling);
        createRelationshipMember($contact['child2'][0], $contact['child4'][0], $sibling);
        createRelationshipMember($contact['child3'][0], $contact['child4'][0], $sibling);
      }

      if (!empty($child1Details['first_name']) && !empty($child1Details['last_name']) && !empty($child1)) {
        $p = [
          'id' => $child1,
          'first_name' => $child1Details['first_name'],
          'last_name' => $child1Details['last_name'],
        ];
        if (!empty($child1Details['email'])) {
          $p['email'] = $child1Details['email'];
        }
        civicrm_api3('Contact', 'create', $p);
      }

      // part where membership is assigned to parent instead of 1st child
      /**
      $membershipID = CRM_Core_DAO::singleValueQuery("SELECT MAX(id) FROM civicrm_membership WHERE contact_id = " . $child1);
      if ($parent1ID && $membershipID) {
        civicrm_api3('Membership', 'create', [
          'id' => $membershipID,
          'contact_id' => $parent1ID,
        ]);
        if ($contributionID = CRM_Core_DAO::singleValueQuery("SELECT MAX(contribution_id) FROM civicrm_membership_payment WHERE membership_id = " . $membershipID)) {
          civicrm_api3('Contribution', 'create', [
            'id' => $contributionID,
            'contact_id' => $parent1ID,
          ]);
        }
      }
      */
    }
  }

  function createWPUser($contactID, $sendResetLink = FALSE) {
    $contact = civicrm_api3('Contact', 'getsingle', ['id' => $contactID]);
    $ufID = CRM_Core_DAO::singleValueQuery("SELECT MAX(uf_id) FROM civicrm_uf_match WHERE ( contact_id = " . $contactID . " OR uf_name = '" . $contact['email'] . "' ) ");

    if (!$ufID) {
      $cmsName = strtolower($contact['first_name'] . '.' . $contact['last_name'] . '.' . $contact['id']);
      $params = [
        'contactID' => $contact['id'],
        'cms_pass' => 'changeme',
        'cms_name' => $cmsName,
        'email' => $contact['email'],
      ];
      if ($sendResetLink) {
        $params['disable_notification'] = TRUE;
      }
      try {
        $config = CRM_Core_Config::singleton();
        $mail = 'email';
        $ufID = $config->userSystem->createUser($params, $mail);

        if ($ufID !== FALSE) {
          CRM_Core_DAO::executeQuery(sprintf("
            REPLACE INTO civicrm_uf_match(domain_id , uf_id , uf_name , contact_id)
            VALUES (%d, $ufID, '%s', %d) ", CRM_Core_Config::domainID(), $contact['email'], $contact['id']
          ));

          $u = new WP_User($ufID);
          if ($sendResetLink) {
            sendResetLink($u);
          }
        }
      }
      catch (CRM_Core_Exception $e) {}
    }
  }

  function sendResetLink($user) {
    $firstname = $user->first_name;
    $email = $user->user_email;
    $adt_rp_key = get_password_reset_key( $user );
    $user_login = $user->user_login;
    $rp_link = '<a href="' . wp_login_url()."?action=resetpass&key=$adt_rp_key&login=" . rawurlencode($user_login) . '">' . wp_login_url()."?action=resetpass&key=$adt_rp_key&login=" . rawurlencode($user_login) . '</a>';

    $message = "Hi ".$firstname.",<br>";
    $message .= "An account has been created on ".get_bloginfo( 'name' )." for email address ".$email."<br>";
    $message .= "Click here to set the password for your account: <br>";
    $message .= $rp_link.'<br>';

    //deze functie moet je zelf nog toevoegen.
    $subject = __("Your account on ".get_bloginfo( 'name'));
    $headers = array();

    add_filter( 'wp_mail_content_type', function( $content_type ) {return 'text/html';});
    $headers[] = 'From: Canadian Association for Girls In Science (CAGIS) <info@girlsinscience.ca>'."\r\n";
    wp_mail( $email, $subject, $message, $headers);

    // Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
    remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
  }

  function createRelationshipMember($cida, $cidb, $type) {
    if ($cida == $cidb) {
      return;
    }
    $relationshipParams = array(
      "contact_id_a" => $cida,
      "contact_id_b" => $cidb,
      "relationship_type_id" => $type,
    );
    $rel = civicrm_api3("Relationship", "get", $relationshipParams);
    if (empty($rel['count'])) {
      try {
        civicrm_api3("Relationship", "create", $relationshipParams);
      }
      catch (Exception $e) {
        Civi::log()->debug('Error from trying to create related member with params', ['params' => $relationshipParams]);
      }
    }
  }

  function subscribeMemberToElist($contactId) {
    civicrm_api3('GroupContact', 'create', [
      'contact_id' => $contactId,
      'group_id' => 2,
      'status' => 'Added',
    ]);
  }

  function createMembershipTypesForChapter($params) {
    $membershipID = NULL;
    if (!empty($params['label'])) {
      $chapterName = $params['label'];
      $membershipID = CRM_Utils_Array::value('id', civicrm_api3('MembershipType', 'get', ['name' => ['LIKE' => "%$chapterName%"]]));
      if ($membershipID) {
        return;
      }
      $membershipOwnerID = civicrm_api3('Contact', 'get', [
        'organisation_name' => $chapterName,
        'contact_sub_type' => 'Chapter',
      ])['id'];
      $membershipTypes = ['Individual Membership', 'Family Membership (2 Girls)', 'Family Membership (3 Girls)', 'Family Membership (4 Girls)'];
      foreach ($membershipTypes as $k => $mtype) {
        $membershipType = civicrm_api3('MembershipType', 'getsingle', [
          'name' => $mtype,
          'options' => ['limit' => 1],
        ]);
        civicrm_api3('MembershipType', 'create', [
          'name' => $chapterName . ' ' . $membershipType['name'],
          'member_of_contact_id' => $membershipOwnerID ?: $membershipType['member_of_contact_id'],
          'financial_type_id' => $membershipType['financial_type_id'],
          'minimum_fee' => $membershipType['minimum_fee'],
          'duration_unit' => $membershipType['duration_unit'],
          'duration_interval' => $membershipType['duration_interval'],
          'period_type' => 'rolling',
          'relationship_type_id' => 4,
          'relationship_direction' => 'a_b',
          'visibility' => 'Public',
          'is_active' => TRUE,
          'max_related' => $k,
        ]);
      }
    }
  }

  // --- Functions below this ship commented out. Uncomment as required. ---

  /**
   * Implements hook_civicrm_preProcess().
   *
   * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
   *
  function membershiprelation_civicrm_preProcess($formName, &$form) {

  } // */

  /**
   * Implements hook_civicrm_navigationMenu().
   *
   * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
   *
  function membershiprelation_civicrm_navigationMenu(&$menu) {
  _membershiprelation_civix_insert_navigation_menu($menu, 'Mailings', array(
  'label' => E::ts('New subliminal message'),
  'name' => 'mailing_subliminal_message',
  'url' => 'civicrm/mailing/subliminal',
  'permission' => 'access CiviMail',
  'operator' => 'OR',
  'separator' => 0,
  ));
  _membershiprelation_civix_navigationMenu($menu);
  } // */
