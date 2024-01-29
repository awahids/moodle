<?php
// mod/evaluation/locallib.php

defined('MOODLE_INTERNAL') || die();

function get_data_from_database($id)
{
  global $DB;

  $sql = "SELECT
        e.*,
        u.id as nip,
        u.firstname as firstname
    FROM {evaluation} e
    JOIN {user} u ON e.userid = u.id
    WHERE e.quizid = :quizid";

  $params = ['quizid' => $id];
  $table = $DB->get_recordset_sql($sql, $params);

  if (!$table) {
    return array();
  }

  $data = array();
  $count = 0; // Initialize count

  foreach ($table as $record) {
    $data[] = array(
      'quizid'            => $record->quizid,
      'firstname'         => $record->firstname,
      'nip'               => $record->nip,
      'postest'           => $record->postest,
      'bobot_postest'     => $record->bobot_postest,
      'pretest'           => $record->pretest,
      'bobot_pretest'     => $record->bobot_pretest,
      'nilai_ujian'       => $record->nilai_ujian,
      'bobot_nilai_ujian' => $record->bobot_nilai_ujian,
      'nilai_lain2'       => $record->nilai_lain2,
      'bobot_nilai_lain2' => $record->bobot_nilai_lain2,
      'nilai_akhir'       => $record->nilai_akhir,
      'is_remedial'       => $record->is_remedial,
      'total_peserta'     => ++$count // Increment count
    );
  }

  $table->close();

  return $data;
}
