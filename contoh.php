<!DOCTYPE html>
<html>
<head>
<title>Kalkulator Nilai Akhir</title>
<style>
body {
  font-family: Arial, sans-serif;
  background-color: #f0f2f5;
  padding: 30px;
}
h2 {
  text-align: center;
  color: #003399;
  margin-bottom: 5px;
}
p.sub {
  text-align: center;
  font-size: 13px;
  color: #555;
  margin-bottom: 20px;
}
table {
  width: 100%;
  border-collapse: collapse;
  background-color: white;
  margin-bottom: 20px;
}
th {
  background-color: #003399;
  color: white;
  padding: 8px;
  text-align: center;
  font-size: 14px;
}
td {
  padding: 8px 10px;
  border: 1px solid #ccc;
  font-size: 14px;
}
td.label {
  background-color: #f7f7f7;
  font-weight: bold;
  width: 40%;
}
input[type="number"] {
  width: 80px;
  padding: 4px 6px;
  border: 1px solid #aaa;
  border-radius: 3px;
  font-size: 14px;
}
input[type="checkbox"] {
  margin-right: 5px;
}
.hasil-box {
  background-color: #eef3ff;
  border: 1px solid #003399;
  padding: 15px 20px;
  margin-bottom: 20px;
}
.hasil-box p {
  margin: 4px 0;
  font-size: 14px;
}
.nilai-besar {
  font-size: 36px;
  font-weight: bold;
  color: #003399;
}
.grade {
  font-size: 20px;
  font-weight: bold;
  color: #333;
}
.keterangan {
  font-size: 13px;
  color: #555;
}
tr.aktif {
  background-color: #d0e8ff;
  font-weight: bold;
}
</style>
</head>
<body>
 
<h2>Kalkulator Nilai Akhir</h2>
<p class="sub">Mata Kuliah: Web Programming I &nbsp;|&nbsp; Sistem Informasi &mdash; Semester 2</p>
 
<table>
  <tr>
    <th colspan="2">Jenis Asesmen</th>
  </tr>
  <tr>
    <td class="label"><input type="checkbox" id="cb1" checked onchange="hitungSemua()"> Tes Tertulis</td>
    <td class="label"><input type="checkbox" id="cb2" onchange="hitungSemua()"> Tes Lisan</td>
  </tr>
  <tr>
    <td class="label"><input type="checkbox" id="cb3" checked onchange="hitungSemua()"> Tes Kinerja (Praktik)</td>
    <td class="label"><input type="checkbox" id="cb4" checked onchange="hitungSemua()"> Tugas (Portofolio)</td>
  </tr>
</table>
 
<table>
  <tr>
    <th colspan="3">Bobot Penilaian</th>
  </tr>
  <tr>
    <td class="label">Kehadiran</td>
    <td><input type="number" id="b_kehadiran" value="20" min="0" max="100" oninput="hitungSemua()"> %</td>
    <td id="info1" class="keterangan"></td>
  </tr>
  <tr>
    <td class="label">Tugas</td>
    <td><input type="number" id="b_tugas" value="25" min="0" max="100" oninput="hitungSemua()"> %</td>
    <td id="info2" class="keterangan"></td>
  </tr>
  <tr>
    <td class="label">Project Akhir</td>
    <td><input type="number" id="b_project" value="55" min="0" max="100" oninput="hitungSemua()"> %</td>
    <td id="info3" class="keterangan"></td>
  </tr>
  <tr>
    <td class="label">Total Bobot</td>
    <td colspan="2" id="total_bobot">100% &#10003;</td>
  </tr>
</table>
 
<table>
  <tr>
    <th colspan="3">Input Nilai (0 - 100)</th>
  </tr>
  <tr>
    <td class="label">Kehadiran <span class="keterangan" id="lbl1">(bobot 20%)</span></td>
    <td><input type="number" id="v_kehadiran" min="0" max="100" placeholder="0-100" oninput="hitungSemua()"></td>
    <td id="hasil1" class="keterangan"></td>
  </tr>
  <tr>
    <td class="label">Tugas <span class="keterangan" id="lbl2">(bobot 25%)</span></td>
    <td><input type="number" id="v_tugas" min="0" max="100" placeholder="0-100" oninput="hitungSemua()"></td>
    <td id="hasil2" class="keterangan"></td>
  </tr>
  <tr>
    <td class="label">Project Akhir <span class="keterangan" id="lbl3">(bobot 55%)</span></td>
    <td><input type="number" id="v_project" min="0" max="100" placeholder="0-100" oninput="hitungSemua()"></td>
    <td id="hasil3" class="keterangan"></td>
  </tr>
</table>
 
<div class="hasil-box">
  <p>Nilai Akhir :</p>
  <p class="nilai-besar" id="nilai_akhir">-</p>
  <p class="grade" id="grade_huruf"></p>
  <p class="keterangan" id="grade_ket"></p>
</div>
 
<table>
  <tr>
    <th>Nilai Angka</th>
    <th>Huruf</th>
    <th>Keterangan</th>
  </tr>
  <tr id="rowA"><td>80 - 100</td><td>A</td><td>Sangat Baik</td></tr>
  <tr id="rowB"><td>70 - 79</td><td>B</td><td>Baik</td></tr>
  <tr id="rowC"><td>60 - 69</td><td>C</td><td>Cukup</td></tr>
  <tr id="rowD"><td>31 - 59</td><td>D</td><td>Kurang</td></tr>
  <tr id="rowE"><td>0 - 30</td><td>E</td><td>Tidak Lulus</td></tr>
</table>
 
<script>
function hitungSemua() {
  var bK = parseFloat(document.getElementById('b_kehadiran').value) || 0;
  var bT = parseFloat(document.getElementById('b_tugas').value) || 0;
  var bP = parseFloat(document.getElementById('b_project').value) || 0;
  var total = bK + bT + bP;
 
  var tdTotal = document.getElementById('total_bobot');
  if (total == 100) {
    tdTotal.innerHTML = '100% &#10003;';
    tdTotal.style.color = 'green';
  } else {
    tdTotal.innerHTML = total + '% &#10007; (harus 100%)';
    tdTotal.style.color = 'red';
  }
 
  document.getElementById('lbl1').innerText = '(bobot ' + bK + '%)';
  document.getElementById('lbl2').innerText = '(bobot ' + bT + '%)';
  document.getElementById('lbl3').innerText = '(bobot ' + bP + '%)';
 
  var vK = parseFloat(document.getElementById('v_kehadiran').value);
  var vT = parseFloat(document.getElementById('v_tugas').value);
  var vP = parseFloat(document.getElementById('v_project').value);
 
  var rows = ['A','B','C','D','E'];
  for (var i = 0; i < rows.length; i++) {
    document.getElementById('row' + rows[i]).classList.remove('aktif');
  }
 
  var elNilai = document.getElementById('nilai_akhir');
  var elGrade = document.getElementById('grade_huruf');
  var elKet = document.getElementById('grade_ket');
 
  if (isNaN(vK) || isNaN(vT) || isNaN(vP) || total != 100) {
    elNilai.innerText = '-';
    elGrade.innerText = '';
    elKet.innerText = '';
    document.getElementById('hasil1').innerText = '';
    document.getElementById('hasil2').innerText = '';
    document.getElementById('hasil3').innerText = '';
    return;
  }
 
  var k1 = Math.round(vK * bK / 100 * 100) / 100;
  var k2 = Math.round(vT * bT / 100 * 100) / 100;
  var k3 = Math.round(vP * bP / 100 * 100) / 100;
 
  document.getElementById('hasil1').innerText = '= ' + k1;
  document.getElementById('hasil2').innerText = '= ' + k2;
  document.getElementById('hasil3').innerText = '= ' + k3;
 
  var nilai = Math.round(k1 + k2 + k3);
  elNilai.innerText = nilai;
 
  var grade, ket;
  if (nilai >= 80) { grade = 'A'; ket = 'Sangat Baik'; }
  else if (nilai >= 70) { grade = 'B'; ket = 'Baik'; }
  else if (nilai >= 60) { grade = 'C'; ket = 'Cukup'; }
  else if (nilai >= 31) { grade = 'D'; ket = 'Kurang'; }
  else { grade = 'E'; ket = 'Tidak Lulus'; }
 
  elGrade.innerText = 'Grade : ' + grade;
  elKet.innerText = 'Keterangan : ' + ket;
  document.getElementById('row' + grade).classList.add('aktif');
}
</script>
 
</body>
</html>
 