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
      CRM_Core_DAO::singleValueQuery("INSERT INTO civicrm_value_cagis_members_1 (entity_id, cagis_chapter_1) VALUES ($id, '$chapter')");
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
    }
    if ($formName == "CRM_Contribute_Form_Contribution_Confirm" && $form->getVar('_id') == 1) {
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
  }

  /**
   * Implements hook_civicrm_validateForm().
   *
   * @param string $formName
   * @param CRM_Core_Form $form
   */
  function membershiprelation_civicrm_validateForm($formName, &$fields, &$files, &$form, &$errors) {
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

  /**
   * Implements hook_civicrm_postProcess().
   *
   * @param string $formName
   * @param CRM_Core_Form $form
   * @throws CiviCRM_API3_Exception
   */
  function membershiprelation_civicrm_postProcess($formName, &$form) {
    if ($formName == "CRM_Contribute_Form_Contribution_Confirm" && $form->getVar('_id') == 1) {
      $child1 = $form->_contactID;
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

      foreach ($relatedContacts as $person => $params) {
        if (empty($params['first_name']) && empty($params['last_name'])) {
          continue;
        }
        $dedupeParams = CRM_Dedupe_Finder::formatParams($params, 'Individual');
        $dedupeParams['check_permission'] = FALSE;
        $dupes = CRM_Dedupe_Finder::dupesByParams($dedupeParams, 'Individual', NULL, array(), 1);
        $cid = CRM_Utils_Array::value('0', $dupes, NULL);
        $params['contact_type'] = 'Individual';
        if ($cid) {
          $params['contact_id'] = $cid;
        }
        if (in_array($person, ['child2', 'child3', 'child4'])) {
          $params['contact_sub_type'] = 'Child';
        }
        if ($person != 'parent1' && empty($params['email'])) {
          $params['email'] = $relatedContacts['parent1']['email'];
        }
        $contact[$person] = (array) civicrm_api3('Contact', 'create', array_merge($params, ['id' => $cid]))['id'];

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
          if (in_array($person, ['child2', 'child3', 'child4']) && !empty($contact[$person][0])) {
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
    $rp_link = '<a href="' . wp_login_url()."/resetpass/?key=$adt_rp_key&login=" . rawurlencode($user_login) . '">' . wp_login_url()."/resetpass/?key=$adt_rp_key&login=" . rawurlencode($user_login) . '</a>';

    $message = "Hi ".$firstname.",<br>";
    $message .= "An account has been created on ".get_bloginfo( 'name' )." for email address ".$email."<br>";
    $message .= "Click here to set the password for your account: <br>";
    $message .= $rp_link.'<br>';

    //deze functie moet je zelf nog toevoegen.
    $subject = __("Your account on ".get_bloginfo( 'name'));
    $headers = array();

    add_filter( 'wp_mail_content_type', function( $content_type ) {return 'text/html';});
    $headers[] = 'From: Your company name <cagis@uwo.ca>'."\r\n";
    wp_mail( $email, $subject, $message, $headers);

    // Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
    remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
  }

  function createRelationshipMember($cida, $cidb, $type) {
    $relationshipParams = array(
      "contact_id_a" => $cida,
      "contact_id_b" => $cidb,
      "relationship_type_id" => $type,
    );
    $rel = civicrm_api3("Relationship", "get", $relationshipParams);
    if ($rel['count'] == 0) {
      civicrm_api3("Relationship", "create", $relationshipParams);
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
