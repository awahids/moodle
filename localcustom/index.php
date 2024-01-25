<?php

require_once('../config.php');

require_once($CFG->dirroot . '/localcustom/table.php');

$redirect = $CFG->wwwroot . '/localcustom/index.php';

echo $OUTPUT->header();

$table = new custom_table();

echo $table->definition();
