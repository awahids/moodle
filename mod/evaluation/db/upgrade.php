<?php

defined('MOODLE_INTERNAL') || die();

function xmldb_userquiz_upgrade($oldversion): bool
{
  global $CFG, $DB;

  $dbman = $DB->get_manager(); // Loads ddl manager and xmldb classes.

  if ($oldversion < 202401200) {
    // Define field id to be added to userquiz.
    $table = new xmldb_table('userquiz');
    $field = new xmldb_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null);

    $field = new xmldb_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'id');

    $field = new xmldb_field('quizid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'userid');

    $field = new xmldb_field('postest', XMLDB_TYPE_NUMBER, '10, 2', null, XMLDB_NOTNULL, null, '0.00', 'quizid');

    $field = new xmldb_field('bobot_postest', XMLDB_TYPE_NUMBER, '10, 2', null, XMLDB_NOTNULL, null, '0.00', 'postest');

    $field = new xmldb_field('pretest', XMLDB_TYPE_NUMBER, '10, 2', null, XMLDB_NOTNULL, null, '0.00', 'bobot_postest');

    $field = new xmldb_field('bobot_pretest', XMLDB_TYPE_NUMBER, '10, 2', null, XMLDB_NOTNULL, null, '0.00', 'pretest');

    $field = new xmldb_field('nilai_ujian', XMLDB_TYPE_NUMBER, '10, 2', null, XMLDB_NOTNULL, null, '0.00', 'bobot_pretest');

    $field = new xmldb_field('bobot_nilai_ujian', XMLDB_TYPE_NUMBER, '10, 2', null, XMLDB_NOTNULL, null, '0.00', 'nilai_ujian');

    $field = new xmldb_field('nilai_lain2', XMLDB_TYPE_NUMBER, '10, 2', null, XMLDB_NOTNULL, null, '0.00', 'bobot_nilai_ujian');

    $field = new xmldb_field('bobot_nilai_lain2', XMLDB_TYPE_NUMBER, '10, 2', null, XMLDB_NOTNULL, null, '0.00', 'nilai_lain2');

    $field = new xmldb_field('nilai_akhir', XMLDB_TYPE_NUMBER, '10, 2', null, XMLDB_NOTNULL, null, '0.00', 'bobot_nilai_lain2');

    $field = new xmldb_field('is_remedial', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0', 'nilai_akhir');

    // Conditionally launch add field id.
    if (!$dbman->field_exists($table, $field)) {
      $dbman->add_field($table, $field);
    }

    // Userquiz savepoint reached.
    upgrade_mod_savepoint(true, 202401200, 'userquiz');
  }

  // Everything has succeeded to here. Return true.
  return true;
}
