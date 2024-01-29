<?php
// mod/evaluation/access.php

defined('MOODLE_INTERNAL') || die();

$capabilities = array(
  'mod/evaluation:update' => array(
    'riskbitmask' => RISK_SPAM | RISK_XSS,
    'captype' => 'write',
    'contextlevel' => CONTEXT_MODULE,
    'archetypes' => array(
      'manager' => CAP_ALLOW,
      'editingteacher' => CAP_ALLOW,
      'teacher' => CAP_ALLOW,
    ),
  ),
);
