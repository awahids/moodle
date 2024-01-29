<?php
// mod/evaluation/updateNilai.php
defined('MOODLE_INTERNAL') || die();

require_once('config.php');
require_once('locallib.php');

function updateNilai($id)
{
  global $DB;

  $evaluations = $DB->get_records('evaluation', ['quizid' => $id]);

  foreach ($evaluations as $key) {
    $data[] = array(
      'quizid' => $key->quizid,
      'firstname' => $key->firstname,
      'nip' => $key->nip,
      'postest' => $key->postest,
      'bobot_postest' => $key->bobot_postest,
      'pretest' => $key->pretest,
      'bobot_pretest' => $key->bobot_pretest,
      'nilai_ujian' => $key->nilai_ujian,
      'bobot_nilai_ujian' => $key->bobot_nilai_ujian,
      'nilai_lain2' => $key->nilai_lain2,
      'bobot_nilai_lain2' => $key->bobot_nilai_lain2,
      'is_remedial' => $key->is_remedial,
      'total_nilai' => $key->total_nilai,
    );
  }
}

// You may also need to add any additional functions or includes specific to this file.
