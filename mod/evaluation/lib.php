<?php
// mod/evaluation/lib.php
defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/tablelib.php");
require_once("$CFG->libdir/formslib.php");
require_once('locallib.php');

class CustomTable extends html_table
{
  public function definition($data = array())
  {
    global $CFG;

    $table = new html_table();

    $tablehtml = '<div>';
    $tablehtml .= '<table>';
    $tablehtml .= '<tr>';
    $tablehtml .= '<td>';

    $absensi = html_writer::tag('p', 'Absensi', array('style' => 'font-size: 20px;'));
    echo $absensi;

    $key = array();
    foreach ($data as $record) {
      $key['total_peserta'] = $record['total_peserta'];
    }

    $table->data = array(
      array('Nama Diklat', ':', '123456789', '', '', '', '', '', '', 'Jumlah JP', ':', 'abdavshgdvhg'),
      array('Unit Kerja', ':', '123456789', '', '', '', '', '', '', 'Jumlah Peserta', ':', $key['total_peserta'] ?? 0),
      array('Jumlah Hari', ':', '123456789', '', '', '', '', '', '', 'Angka Kredit', ':', 'abdavshgdvhg'),
      array('Jumalah Kelas', ':', '123456789', '', '', '', '', '', '', '', '', ''),
    );

    $table->responsive = true;
    $table->size[9] = '10%';
    $table->size[0] = '10%';
    $table->size[2] = '10%';

    echo html_writer::table($table);

    $tablehtml .= '</td>';
    $tablehtml .= '</tr>';
    $tablehtml .= '</table>';
    $tablehtml .= '</div>';

    return $tablehtml;
  }
}

class ListUser extends html_table
{
  public function definition($data = array())
  {
    $id = required_param('id', PARAM_INT);

    global $CFG;

    $heading = html_writer::tag('p', 'Teknik Audit Berbantuan Komputer', array('style' => 'font-size: 20px;'));

    echo $heading;

    $tablehtml = '<div>';
    $tablehtml .= '<form method="post" action="form_percentage.php?id=' . $id . '">';
    $tablehtml .= '<table class="custom-table table">';
    $tablehtml .= '<tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Persentasi</td>
                <td><input type="number" name="bobot_postest"></td>
                <td></td>
                <td><input type="number" name="bobot_pretest"></td>
                <td></td>
                <td><input type="number" name="bobot_nilai_ujian"></td>
                <td></td>
                <td><input type="number" name="bobot_nilai_lain2"></td>';
    $tablehtml .= '<td></td>';
    $tablehtml .= '<td>';
    $tablehtml .= '<input type="submit" name="submitbutton" value="Submit" style="background-color: green; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">';
    $tablehtml .= '</td>'; // end button
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

    $no = 1;
    foreach ($data as $row) {
      $tablehtml .= '<tr class="list-user">';
      $tablehtml .= '<td>' . $no++ . '</td>';
      $tablehtml .= '<td>' . $row['nip'] . '</td>';
      $tablehtml .= '<td>' . $row['firstname'] . '</td>';
      $tablehtml .= '<td>' . $row['postest'] . '</td>';
      $tablehtml .= '<td>' . $row['bobot_postest'] . '</td>';
      $tablehtml .= '<td>' . $row['pretest'] . '</td>';
      $tablehtml .= '<td>' . $row['bobot_pretest'] . '</td>';
      $tablehtml .= '<td>' . $row['nilai_ujian'] . '</td>';
      $tablehtml .= '<td>' . $row['bobot_nilai_ujian'] . '</td>';
      $tablehtml .= '<td>' . $row['nilai_lain2'] . '</td>';
      $tablehtml .= '<td>' . $row['bobot_nilai_lain2'] . '</td>';
      $tablehtml .= '<td>' . $row['nilai_akhir'] . '</td>';
      $tablehtml .= '<td>' . $row['is_remedial'] . '</td>';
      $tablehtml .= '</tr>';
    }

    $tablehtml .= '</table>';
    $tablehtml .= '</form>';
    $tablehtml .= '</div>';

    return $tablehtml;
  }
}

class CustomTableDinamis extends html_table
{
  public function definition()
  {
    global $DB;

    $attributes = $this->getAttributesFromDatabase();

    $data = $this->prepareTableData($attributes);

    $heading = html_writer::tag('p', 'Teknik Audit Berbantuan Komputer', array('style' => 'font-size: 20px;'));
    echo $heading;

    // Output dynamic table
    $table = new html_table();
    $table->responsive = true;

    $tableHtml = '<div>';
    $tableHtml .= '<table>';
    $tableHtml .= '<form method="post">';
    $tableHtml .= '<table class="custom-table table">';
    $tableHtml .= '<tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Persentasi</td>';

    foreach ($data['valueAttributes'] as $index => $key) {
      $tableHtml .= '<td><input type="number" name="' . $key . $data['attributeIds'][$index] . '"></td>';
    }

    $tableHtml .= '<td></td>';
    $tableHtml .= '<td>';
    $tableHtml .= '<input type="submit" name="submitbutton" value="Submit" style="background-color: green; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">';
    $tableHtml .= '</td>';
    $tableHtml .= '</table>';
    $tableHtml .= '</form>';
    $tableHtml .= '</div>';

    $table->head = $data['labels'];
    $output_array = [];
    $count = 1;
    foreach ($data['user'] as $index => $user) {
      $output_array[] = array_merge(array($count++), $data['nip'][$index], $user, $data['userValues'][$index]);
    }

    foreach ($output_array as $key) {
      $table->data[] = $key;
    }

    echo $tableHtml;
    return html_writer::table($table);
  }

  private function getAttributesFromDatabase()
  {
    global $DB;
    $sql = "SELECT * FROM mdl_attributes";
    return $DB->get_records_sql($sql);
  }

  private function prepareTableData($attributes)
  {
    global $DB;

    $data = array();

    $data['labels'] = array("No", "NIP", "Nama");
    $data['userValues'] = array();

    foreach ($attributes as $attribute) {
      $sql = "SELECT u.firstname as nama, 
                            u.id as nip,
                            v.value as value
                    FROM mdl_values as v
                    JOIN mdl_user as u ON v.userid = u.id
                    JOIN mdl_attributes as a ON v.attributeid = a.id
                    WHERE v.attributeid = :attributeid
                    GROUP BY u.id";

      $params = ['attributeid' => $attribute->id];
      $values = $DB->get_records_sql($sql, $params);

      foreach ($values as $value) {
        $data['nip'][$value->nip] = array_unique((array)$value->nip);
        $data['user'][$value->nip] = array_unique((array)$value->nama);
        $data['userValues'][$value->nip][] = $value->value;
      }

      $data['labels'][] = $attribute->label;

      if ($attribute->value == "bobot") {
        $data['valueAttributes'][$attribute->id] = $attribute->value;
        $data['attributeIds'][$attribute->id] = $attribute->id;
      }
    }

    return $data;
  }
}
