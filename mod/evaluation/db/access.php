<?php
// mod/evaluation/access.php

defined('MOODLE_INTERNAL') || die();

$capabilities = array(
  'mod/evaluation:view' => array(
    'captype' => 'read',
    'contextlevel' => CONTEXT_MODULE,
    'archetypes' => array(
      'teacher' => CAP_ALLOW,
      'student' => CAP_ALLOW,
    ),
  ),
  'mod/evaluation:addinstance' => array(
    'riskbitmask' => RISK_SPAM | RISK_XSS,
    'captype' => 'write',
    'contextlevel' => CONTEXT_MODULE,
    'archetypes' => array(
      'teacher' => CAP_ALLOW,
    ),
  ),
  'mod/evaluation:manage' => array(
    'riskbitmask' => RISK_SPAM | RISK_XSS,
    'captype' => 'write',
    'contextlevel' => CONTEXT_MODULE,
    'archetypes' => array(
      'teacher' => CAP_ALLOW,
    ),
  ),
  'mod/evaluation:delete' => array(
    'riskbitmask' => RISK_SPAM | RISK_XSS,
    'captype' => 'write',
    'contextlevel' => CONTEXT_MODULE,
    'archetypes' => array(
      'teacher' => CAP_ALLOW,
    ),
  ),
);
