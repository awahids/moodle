<?php
// mod/evaluation/views.php
require_once('../../config.php');
require_once('lib.php');
require_once('locallib.php');

$id = required_param('id', PARAM_INT);

$PAGE->set_url('/mod/evaluation/view.php');
$PAGE->set_title("TABK");
$PAGE->set_heading("Teknik Audit Berbasis Komputer (TABK)");

echo $OUTPUT->header();

$data = get_data_from_database($id);

$hero_section = new CustomTable();
echo $hero_section->definition($data);

$table = new ListUser();
echo $table->definition($data);

echo $OUTPUT->footer();
