<?php
// custom_table.php

require_once('../config.php');
require_once("$CFG->libdir/tablelib.php");
require_once("$CFG->libdir/formslib.php");

class custom_table extends html_table
{
  public function definition()
  {
    global $CFG;

    $table = new html_table();
    $header = html_writer::tag('H1', 'Teknik Audit Berbasis Komputer (TABK)', array('style' => 'font-size: 20px;'));
    echo $header;

    $tablehtml = '<div>';
    $tablehtml .= '<table>';
    $tablehtml .= '<tr>';
    $tablehtml .= '<td>';

    $absensi = html_writer::tag('p', 'Absensi', array('style' => 'font-size: 20px;'));
    echo $absensi;

    $table->data = array(
      array('Nama Diklat', ':', '123456789', '', '', '', '', '', '', 'Jumlah JP', ':', 'abdavshgdvhg'),
      array('Unit Kerja', ':', '123456789', '', '', '', '', '', '', 'Jumlah Peserta', ':', 'abdavshgdvhg'),
      array('Jumlah Hari', ':', '123456789', '', '', '', '', '', '', 'Angka Kredit', ':', 'abdavshgdvhg'),
      array('Jumalah Kelas', ':', '123456789', '', '', '', '', '', '', '', '', ''),
    );

    $table->responsive = true;
    $table->size[9] = '10%';
    $table->size[0] = '10%';
    $table->size[2] = '10%';

    echo html_writer::table($table);

    $heading = html_writer::tag('p', 'Teknik Audit Berbantuan Komputer', array('style' => 'font-size: 20px;'));

    echo $heading;

    $mform = new my_custom_form();
    $mform->display();

    $tablehtml .= '</td>';
    $tablehtml .= '</tr>';
    $tablehtml .= '</table>';
    $tablehtml .= '</div>';
  }
}

class my_custom_form extends moodleform
{
  public function definition()
  {
    $mform = $this->_form;

    // Adding table
    $tablehtml = '<div>';
    $tablehtml .= '<table class="custom-table table">';
    $tablehtml .= '<tr>
      <td></td>
      <td></td>
      <td></td>
      <td>Persentasi</td>
      <td>' . $mform->createElement('text', 'integer1')->toHtml() . '</td>
      <td></td>
      <td>' . $mform->createElement('text', 'integer2')->toHtml() . '</td>
      <td></td>
      <td>' . $mform->createElement('text', 'integer3')->toHtml() . '</td>
      <td></td>
      <td>' . $mform->createElement('text', 'integer4')->toHtml() . '</td>';
    $tablehtml .= '<td></td>';
    $tablehtml .= '<td>';
    $submitbutton = $mform->createElement('submit', 'submitbutton', 'Submit');
    $submitbutton->updateAttributes(['style' => 'background-color: green; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;']);
    $tablehtml .= $submitbutton->toHtml();
    $tablehtml .= '</td>'; //end button
    $tablehtml .= '</tr>';
    $tablehtml .= '<tr>
      <th>No</th>
      <th>NIP</th>
      <th>Nama</th>
      <th>Posttest</th>
      <th>Postest Bobot</th>
      <th>Pretest</th>
      <th>Prestest Bobot</th>
      <th>Nilai Ujian</th>
      <th>Nilai Ujian Bobot</th>
      <th>Nilai Lain-Lain</th>
      <th>Lain-Lain Bobot</th>
      <th>Nilai Akhir</th>
      <th class="checkBox">Ujian Remedial</th>
    </tr>';
    $tablehtml .= '<tr class="list-user">
      <td>1</td>
      <td>8327483264</td>
      <td>Wahid</td>
      <td>' . $mform->createElement('text', 'posttest1')->toHtml() . '</td>
      <td>' . $mform->createElement('text', 'posttestbobot1')->toHtml() . '</td>
      <td>' . $mform->createElement('text', 'pretest1')->toHtml() . '</td>
      <td>' . $mform->createElement('text', 'pretestbobot1')->toHtml() . '</td>
      <td>' . $mform->createElement('text', 'nilaiujian1')->toHtml() . '</td>
      <td>' . $mform->createElement('text', 'nilaiujianbobot1')->toHtml() . '</td>
      <td>' . $mform->createElement('text', 'nilailainlain1')->toHtml() . '</td>
      <td>' . $mform->createElement('text', 'lainlainbobot1')->toHtml() . '</td>
      <td>' . $mform->createElement('text', 'nilaiakhir1')->toHtml() . '</td>
      <td>' . $mform->createElement('radio', 'ujianremedial1', '', '')->toHtml() . '</td>
    </tr>';
    $tablehtml .= '<tr class="list-user">
      <td>2</td>
      <td>28348237</td>
      <td>Fajar</td>
      <td>' . $mform->createElement('text', 'posttest1')->toHtml() . '</td>
      <td>' . $mform->createElement('text', 'posttestbobot1')->toHtml() . '</td>
      <td>' . $mform->createElement('text', 'pretest1')->toHtml() . '</td>
      <td>' . $mform->createElement('text', 'pretestbobot1')->toHtml() . '</td>
      <td>' . $mform->createElement('text', 'nilaiujian1')->toHtml() . '</td>
      <td>' . $mform->createElement('text', 'nilaiujianbobot1')->toHtml() . '</td>
      <td>' . $mform->createElement('text', 'nilailainlain1')->toHtml() . '</td>
      <td>' . $mform->createElement('text', 'lainlainbobot1')->toHtml() . '</td>
      <td>' . $mform->createElement('text', 'nilaiakhir1')->toHtml() . '</td>
      <td>' . $mform->createElement('radio', 'ujianremedial1', '', '')->toHtml() . '</td>
    </tr>';

    $mform->addElement('html', $tablehtml);
    $mform->addElement('html', '</div>'); // Closing the table-responsive div

    // Custom CSS styles
    $customstyles = '<style>
            .mform {
                width: 10%;
            }
            .mform .fitem {
                margin-bottom: 10px;
            }
            .mform .fsubmitrow {
                text-align: right;
            }
            .mform .fsubmitrow input[type="submit"] {
                background-color: green !important;
                color: white;
                padding: 8px 16px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            .custom-table {
                width: 100%;
                border-collapse: collapse;
            }
            .custom-table th, .custom-table td {
                padding: 8px;
                text-align: left;
            }
        </style>';

    // Adding custom CSS styles
    $mform->addElement('html', $customstyles);

    return $mform;
  }
}
