<?php

defined('MOODLE_INTERNAL') || die();

function xmldb_userquiz_upgrade($oldversion): bool
{
  global $CFG, $DB;

  $dbman = $DB->get_manager(); // Loads ddl manager and xmldb classes.

  if ($oldversion < 202401200) {
    // Define field id to be added to attribute_weights.
    $table = new xmldb_table('attribute_weights');
    $field = new xmldb_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null);

    $field = new xmldb_field('attributeid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'id');

    $field = new xmldb_field('weight', XMLDB_TYPE_NUMBER, '10, 2', null, XMLDB_NOTNULL, null, '0.00', 'attributeid');

    // Conditionally launch add field id.
    if (!$dbman->field_exists($table, $field)) {
      $dbman->add_field($table, $field);
    }

    upgrade_mod_savepoint(true, 202401200, 'attribute_weights');
  }

  if ($oldversion < 202401200) {
    // Define field id to be added to attributes.
    $table = new xmldb_table('attributes');
    $field = new xmldb_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null);

    $field = new xmldb_field('label', XMLDB_TYPE_CHAR, '25', null, XMLDB_NOTNULL, null, null, 'id');

    $field = new xmldb_field('label_en', XMLDB_TYPE_CHAR, '25', null, XMLDB_NOTNULL, null, null, 'label');

    $field = new xmldb_field('value', XMLDB_TYPE_CHAR, '25', null, XMLDB_NOTNULL, null, null, 'label_en');

    // Conditionally launch add field id.
    if (!$dbman->field_exists($table, $field)) {
      $dbman->add_field($table, $field);
    }

    // Userquiz savepoint reached.
    upgrade_mod_savepoint(true, 202401200, 'evaluation');
  }

  if ($oldversion < 202401200) {
    // Define field id to be added to values.
    $table = new xmldb_table('values');
    $field = new xmldb_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null);

    $field = new xmldb_field('attributeid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'id');

    $field = new xmldb_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'attributeid');

    $field = new xmldb_field('value', XMLDB_TYPE_NUMBER, '10, 2', null, null, null, '0.00', 'userid');

    // Conditionally launch add field id.
    if (!$dbman->field_exists($table, $field)) {
      $dbman->add_field($table, $field);
    }

    // Userquiz savepoint reached.
    upgrade_mod_savepoint(true, 202401200, 'evaluation');
  }

  if ($oldversion < 202401200) {
    // Define field id to be added to userquiz.
    $table = new xmldb_table('evaluation');
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
    upgrade_mod_savepoint(true, 202401200, 'evaluation');
  }

  // Everything has succeeded to here. Return true.
  return true;
}
