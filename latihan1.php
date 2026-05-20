<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kalkulator Nilai SI</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f0f2f5;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      padding: 40px 16px;
    }

    .container {
      background: #fff;
      border-radius: 14px;
      padding: 32px;
      width: 100%;
      max-width: 520px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    h1 {
      font-size: 20px;
      font-weight: bold;
      color: #111;
      margin-bottom: 4px;
    }

    .subtitle {
      font-size: 13px;
      color: #999;
      margin-bottom: 28px;
    }

    /* ── SECTION TITLE ── */
    .section-title {
      font-size: 13px;
      font-weight: bold;
      color: #555;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      margin-bottom: 12px;
    }

    /* ── ASESMEN CHECKLIST ── */
    .asesmen-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
      margin-bottom: 28px;
    }

    .asesmen-item {
      display: flex;
      align-items: center;
      gap: 10px;
      background: #f7f8fa;
      border: 1.5px solid #e5e7eb;
      border-radius: 8px;
      padding: 10px 14px;
      cursor: pointer;
      transition: border-color 0.2s, background 0.2s;
      user-select: none;
    }

    .asesmen-item.checked {
      border-color: #4f7ef8;
      background: #eef3ff;
    }

    .asesmen-item input[type="checkbox"] {
      width: 16px;
      height: 16px;
      accent-color: #4f7ef8;
      cursor: pointer;
      flex-shrink: 0;
    }

    .asesmen-item label {
      font-size: 13px;
      color: #333;
      cursor: pointer;
      line-height: 1.3;
    }

    .asesmen-item.checked label {
      color: #1a4f99;
      font-weight: bold;
    }

    /* ── BOBOT INPUT ── */
    .bobot-list {
      display: flex;
      flex-direction: column;
      gap: 12px;
      margin-bottom: 28px;
    }

    .bobot-row {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .bobot-label {
      flex: 1;
      font-size: 14px;
      color: #444;
    }

    .bobot-label span {
      display: block;
      font-size: 11px;
      color: #999;
      margin-top: 1px;
    }

    .bobot-row input[type="number"] {
      width: 90px;
      padding: 8px 10px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 14px;
      text-align: right;
      outline: none;
      transition: border-color 0.2s;
    }

    .bobot-row input[type="number"]:focus {
      border-color: #4f7ef8;
    }

    .persen {
      font-size: 13px;
      color: #999;
      width: 16px;
    }

    /* ── TOTAL BOBOT ── */
    .total-bobot {
      text-align: right;
      font-size: 13px;
      color: #999;
      margin-bottom: 28px;
      margin-top: -16px;
    }

    .total-bobot.ok { color: #1a7c3e; font-weight: bold; }
    .total-bobot.err { color: #842029; font-weight: bold; }

    /* ── HASIL ── */
    .hasil-box {
      background: #f7f8fa;
      border-radius: 10px;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
    }

    .hasil-label {
      font-size: 13px;
      color: #888;
      margin-bottom: 4px;
    }

    .nilai-angka {
      font-size: 42px;
      font-weight: bold;
      color: #111;
    }

    .grade-badge {
      width: 68px;
      height: 68px;
      border-radius: 12px;
      background: #e0e0e0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 30px;
      font-weight: bold;
      color: #888;
      transition: background 0.3s, color 0.3s;
    }

    .grade-A { background: #d4edda; color: #1a7c3e; }
    .grade-B { background: #d0e8ff; color: #1a4f99; }
    .grade-C { background: #fff3cd; color: #856404; }
    .grade-D { background: #ffe5d0; color: #a0440a; }
    .grade-E { background: #f8d7da; color: #842029; }

    /* ── TABEL RANGE ── */
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }

    th {
      text-align: left;
      padding: 9px 14px;
      color: #888;
      font-weight: normal;
      background: #f7f8fa;
      border-bottom: 1px solid #eee;
    }

    td {
      padding: 9px 14px;
      border-bottom: 1px solid #eee;
      color: #333;
    }

    tr:last-child td { border-bottom: none; }
    .huruf { font-weight: bold; }

    tr.aktif td {
      background: #eef3ff;
      color: #1a4f99;
    }

    tr.aktif .huruf { color: #1a4f99; }

    hr {
      border: none;
      border-top: 1px solid #eee;
      margin: 24px 0;
    }
  </style>
</head>
<body>
<div class="container">

  <h1>Kalkulator Nilai</h1>
  <p class="subtitle">Sistem Informasi — Semester 2</p>

  <!-- JENIS ASESMEN -->
  <p class="section-title">Jenis Asesmen</p>
  <div class="asesmen-grid">
    <div class="asesmen-item checked" onclick="toggleAsesmen(this)">
      <input type="checkbox" checked onchange="toggleAsesmen(this.parentElement)">
      <label>Tes Tertulis</label>
    </div>
    <div class="asesmen-item" onclick="toggleAsesmen(this)">
      <input type="checkbox" onchange="toggleAsesmen(this.parentElement)">
      <label>Tes Lisan</label>
    </div>
    <div class="asesmen-item checked" onclick="toggleAsesmen(this)">
      <input type="checkbox" checked onchange="toggleAsesmen(this.parentElement)">
      <label>Tes Kinerja (Praktik)</label>
    </div>
    <div class="asesmen-item checked" onclick="toggleAsesmen(this)">
      <input type="checkbox" checked onchange="toggleAsesmen(this.parentElement)">
      <label>Tugas (Portofolio)</label>
    </div>
  </div>

  <hr>

  <!-- BOBOT PENILAIAN -->
  <p class="section-title">Bobot Penilaian</p>
  <div class="bobot-list">
    <div class="bobot-row">
      <div class="bobot-label">Kehadiran</div>
      <input type="number" id="b-kehadiran" value="20" min="0" max="100" oninput="hitungSemua()">
      <span class="persen">%</span>
    </div>
    <div class="bobot-row">
      <div class="bobot-label">Tugas</div>
      <input type="number" id="b-tugas" value="25" min="0" max="100" oninput="hitungSemua()">
      <span class="persen">%</span>
    </div>
    <div class="bobot-row">
      <div class="bobot-label">Project Akhir</div>
      <input type="number" id="b-project" value="55" min="0" max="100" oninput="hitungSemua()">
      <span class="persen">%</span>
    </div>
  </div>
  <p class="total-bobot ok" id="totalBobot">Total bobot: 100% ✓</p>

  <hr>

  <!-- NILAI INPUT -->
  <p class="section-title">Input Nilai</p>
  <div class="bobot-list">
    <div class="bobot-row">
      <div class="bobot-label">
        Kehadiran
        <span>bobot 20%</span>
      </div>
      <input type="number" id="v-kehadiran" min="0" max="100" placeholder="0–100" oninput="hitungSemua()">
      <span class="persen" style="visibility:hidden">%</span>
    </div>
    <div class="bobot-row">
      <div class="bobot-label">
        Tugas
        <span>bobot 25%</span>
      </div>
      <input type="number" id="v-tugas" min="0" max="100" placeholder="0–100" oninput="hitungSemua()">
      <span class="persen" style="visibility:hidden">%</span>
    </div>
    <div class="bobot-row">
      <div class="bobot-label">
        Project Akhir
        <span>bobot 55%</span>
      </div>
      <input type="number" id="v-project" min="0" max="100" placeholder="0–100" oninput="hitungSemua()">
      <span class="persen" style="visibility:hidden">%</span>
    </div>
  </div>

  <hr>

  <!-- HASIL -->
  <div class="hasil-box">
    <div>
      <p class="hasil-label">Nilai Akhir</p>
      <p class="nilai-angka" id="nilaiAngka">–</p>
    </div>
    <div class="grade-badge" id="gradeBadge">–</div>
  </div>

  <!-- TABEL RANGE -->
  <table>
    <thead>
      <tr>
        <th>Angka</th>
        <th>Huruf</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <tr id="row-A"><td>80–100</td><td class="huruf">A</td><td>Sangat Baik</td></tr>
      <tr id="row-B"><td>70–79</td><td class="huruf">B</td><td>Baik</td></tr>
      <tr id="row-C"><td>60–69</td><td class="huruf">C</td><td>Cukup</td></tr>
      <tr id="row-D"><td>31–59</td><td class="huruf">D</td><td>Kurang</td></tr>
      <tr id="row-E"><td>0–30</td><td class="huruf">E</td><td>Tidak Lulus</td></tr>
    </tbody>
  </table>

</div>

<script>
  function toggleAsesmen(el) {
    var cb = el.querySelector('input[type="checkbox"]');
    if (event.target !== cb) cb.checked = !cb.checked;
    el.classList.toggle('checked', cb.checked);
  }

  function hitungSemua() {
    var bK = parseFloat(document.getElementById('b-kehadiran').value) || 0;
    var bT = parseFloat(document.getElementById('b-tugas').value) || 0;
    var bP = parseFloat(document.getElementById('b-project').value) || 0;
    var total = bK + bT + bP;

    var totalEl = document.getElementById('totalBobot');
    totalEl.textContent = 'Total bobot: ' + total + '%' + (total === 100 ? ' ✓' : ' ✗ harus 100%');
    totalEl.className = 'total-bobot ' + (total === 100 ? 'ok' : 'err');

    // update label bobot di input nilai
    document.querySelectorAll('.bobot-label span')[0].textContent = 'bobot ' + bK + '%';
    document.querySelectorAll('.bobot-label span')[1].textContent = 'bobot ' + bT + '%';
    document.querySelectorAll('.bobot-label span')[2].textContent = 'bobot ' + bP + '%';

    var vK = parseFloat(document.getElementById('v-kehadiran').value);
    var vT = parseFloat(document.getElementById('v-tugas').value);
    var vP = parseFloat(document.getElementById('v-project').value);

    var nilaiEl = document.getElementById('nilaiAngka');
    var badgeEl = document.getElementById('gradeBadge');

    ['A','B','C','D','E'].forEach(function(g) {
      document.getElementById('row-' + g).classList.remove('aktif');
    });

    if (isNaN(vK) || isNaN(vT) || isNaN(vP) || total !== 100) {
      nilaiEl.textContent = '–';
      badgeEl.textContent = '–';
      badgeEl.className = 'grade-badge';
      return;
    }

    var nilai = Math.round((vK * bK/100) + (vT * bT/100) + (vP * bP/100));
    nilaiEl.textContent = nilai;

    var grade;
    if (nilai >= 80) grade = 'A';
    else if (nilai >= 70) grade = 'B';
    else if (nilai >= 60) grade = 'C';
    else if (nilai >= 31) grade = 'D';
    else grade = 'E';

    badgeEl.textContent = grade;
    badgeEl.className = 'grade-badge grade-' + grade;
    document.getElementById('row-' + grade).classList.add('aktif');
  }
</script>
</body>
</html>