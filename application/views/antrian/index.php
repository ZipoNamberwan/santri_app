<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Antrian Pelayanan Statistik Terpadu</title>
<style>
  * { box-sizing: border-box; }
  html, body { margin: 0; height: 100%; }
  body {
    font-family: "Segoe UI", "Helvetica Neue", Arial, sans-serif;
    color: #fff;
    overflow: hidden;
    /* Gradasi seperti desain; letakkan foto gedung di assets/img/antrian-bg.jpg (opsional) */
    background:
      linear-gradient(160deg, rgba(0,20,120,.92) 0%, rgba(0,110,230,.80) 30%, rgba(0,190,200,.65) 55%, rgba(40,200,90,.65) 75%, rgba(250,210,40,.85) 100%),
      url("<?= base_url('assets/img/antrian-bg.jpg') ?>") center / cover no-repeat,
      #0a2a8a;
  }
  .wrap {
    height: 100vh;
    display: flex;
    flex-direction: column;
    padding: 2.5vw 2.5vw;
    gap: 3vh;
  }
  #btnSuara {
    width: 100%;
    border: 0;
    border-radius: 6px;
    padding: 1.6vh 1rem;
    background: #1aa64a;
    color: #fff;
    font-family: inherit;
    font-weight: 700;
    font-size: clamp(18px, 1.8vw, 34px);
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(0,0,0,.25);
  }
  #btnSuara:hover { background: #17943f; }
  #btnSuara.on { background: rgba(0,0,0,.35); font-size: clamp(14px, 1.1vw, 20px); padding: 1vh 1rem; }

  h1 {
    margin: 0;
    text-align: center;
    font-weight: 900;
    font-size: clamp(32px, 5.2vw, 110px);
    line-height: 1.1;
    text-shadow: 0 4px 18px rgba(0,0,0,.35);
  }
  .clock { text-align: center; font-size: clamp(14px, 1.3vw, 26px); opacity: .9; margin-top: -1.5vh; }

  .grid {
    flex: 1;
    min-height: 0;
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 2.5vw;
  }
  .card {
    min-height: 0;
    display: flex;
    flex-direction: column;
    border-radius: 12px;
    background: rgba(10, 25, 45, .72);
    padding: 2.5vw 2vw;
    box-shadow: 0 8px 24px rgba(0,0,0,.25);
    transition: transform .3s, box-shadow .3s;
  }
  .card h2 {
    margin: 0;
    font-weight: 800;
    font-size: clamp(22px, 3.3vw, 64px);
    line-height: 1.05;
    overflow-wrap: anywhere;
  }
  .card .kode {
    margin-top: auto;
    font-weight: 900;
    font-size: clamp(36px, 5.5vw, 120px);
    line-height: 1;
    letter-spacing: .02em;
  }
  .card .nama {
    margin-top: .6vh;
    font-size: clamp(14px, 1.4vw, 28px);
    font-weight: 600;
    opacity: .9;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .card .kosong { margin-top: auto; font-size: clamp(14px, 1.4vw, 28px); opacity: .55; }
  .card.flash { animation: flash 1s ease-in-out 6; }
  @keyframes flash {
    0%, 100% { background: rgba(10,25,45,.72); transform: scale(1); }
    50%      { background: rgba(26,166,74,.9); transform: scale(1.03); }
  }

  .card.tunggu { background: rgba(220, 110, 10, .9); padding-right: 1.2vw; }
  .tunggu ol {
    list-style: none;
    margin: 2vh 0 0;
    padding: 0 .8vw 0 0;
    overflow-y: auto;
    flex: 1;
    min-height: 0;
  }
  .tunggu li {
    display: flex;
    gap: .8vw;
    align-items: baseline;
    padding: .9vh 0;
    border-bottom: 1px solid rgba(255,255,255,.25);
    font-size: clamp(14px, 1.4vw, 28px);
  }
  .tunggu li b { font-size: 1.25em; font-weight: 900; }
  .tunggu li span { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; opacity: .95; }
  .tunggu .count { font-size: clamp(13px, 1.1vw, 22px); opacity: .9; margin-top: .5vh; }
  .tunggu ol::-webkit-scrollbar { width: 6px; }
  .tunggu ol::-webkit-scrollbar-thumb { background: rgba(255,255,255,.6); border-radius: 3px; }

  .err { position: fixed; bottom: 8px; right: 12px; font-size: 12px; background: rgba(180,0,0,.8); padding: 4px 8px; border-radius: 4px; }

  @media (max-width: 900px) {
    body { overflow: auto; }
    .wrap { height: auto; min-height: 100vh; padding: 16px; }
    .grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
    .card { min-height: 180px; padding: 18px; }
    .card.tunggu { grid-column: 1 / -1; max-height: 50vh; }
  }
</style>
</head>
<body>
<div class="wrap">
  <button id="btnSuara" type="button">Aktifkan Suara</button>

  <div>
    <h1>Antrian Pelayanan Statistik<br>Terpadu</h1>
  </div>
  <div class="clock" id="clock"></div>

  <div class="grid">
    <?php foreach ($loket as $username => $label): ?>
    <div class="card" id="loket-<?= html_escape($username) ?>">
      <h2><?= html_escape($label) ?></h2>
      <div class="kosong">Belum ada panggilan</div>
    </div>
    <?php endforeach; ?>

    <div class="card tunggu">
      <h2>Daftar Tunggu</h2>
      <div class="count" id="tungguCount"></div>
      <ol id="tungguList"></ol>
    </div>
  </div>
</div>
<div class="err" id="err" hidden>Gagal memuat data</div>

<script>
(function () {
  var STATUS_URL = "<?= site_url('antrian/status') ?>";
  var POLL_MS = 3000;

  var soundOn = false;
  var lastCalled = {};   // loket id -> reservasi id terakhir yg tampil
  var firstLoad = true;
  var queue = [];
  var speaking = false;
  var voice = null;

  // ---- Suara ----
  function pickVoice() {
    if (!window.speechSynthesis) return;
    var vs = speechSynthesis.getVoices();
    voice = vs.filter(function (v) { return /^id(-|_|$)/i.test(v.lang); })[0] || null;
  }
  if (window.speechSynthesis) {
    pickVoice();
    speechSynthesis.onvoiceschanged = pickVoice;
  }

  function ejaKode(kode) {
    // "R012" -> "R, 0 1 2" agar dibaca per karakter
    return String(kode).split('').join(' ');
  }

  function say(text) {
    return new Promise(function (resolve) {
      if (!window.speechSynthesis) return resolve();
      var u = new SpeechSynthesisUtterance(text);
      u.lang = 'id-ID';
      if (voice) u.voice = voice;
      u.rate = 0.9;
      u.onend = u.onerror = function () { resolve(); };
      speechSynthesis.speak(u);
    });
  }

  function chime() {
    try {
      var Ctx = window.AudioContext || window.webkitAudioContext;
      var ctx = chime.ctx || (chime.ctx = new Ctx());
      var t = ctx.currentTime;
      [[784, 0], [659, 0.35], [523, 0.7]].forEach(function (n) {
        var o = ctx.createOscillator(), g = ctx.createGain();
        o.frequency.value = n[0];
        g.gain.setValueAtTime(0.0001, t + n[1]);
        g.gain.exponentialRampToValueAtTime(0.4, t + n[1] + 0.02);
        g.gain.exponentialRampToValueAtTime(0.0001, t + n[1] + 0.6);
        o.connect(g); g.connect(ctx.destination);
        o.start(t + n[1]); o.stop(t + n[1] + 0.65);
      });
    } catch (e) {}
    return new Promise(function (r) { setTimeout(r, 1300); });
  }

  function announce(item) { queue.push(item); runQueue(); }

  function runQueue() {
    if (speaking || !queue.length || !soundOn) return;
    speaking = true;
    var it = queue.shift();
    var text = 'Nomor antrian, ' + ejaKode(it.kode) + '. Atas nama, ' + it.nama.toLowerCase() +
               '. Silakan menuju, ' + it.label + '.';
    chime()
      .then(function () { return say(text); })
      .then(function () { return say(text); })
      .then(function () { speaking = false; runQueue(); });
  }

  document.getElementById('btnSuara').addEventListener('click', function () {
    soundOn = !soundOn;
    this.classList.toggle('on', soundOn);
    this.textContent = soundOn ? 'Suara aktif (klik untuk matikan)' : 'Aktifkan Suara';
    if (soundOn) { say(''); chime(); runQueue(); }   // buka izin audio browser
    else if (window.speechSynthesis) { speechSynthesis.cancel(); queue = []; speaking = false; }
  });

  // ---- Render ----
  function el(tag, cls, text) {
    var e = document.createElement(tag);
    if (cls) e.className = cls;
    if (text != null) e.textContent = text;
    return e;
  }

  function renderLoket(l) {
    var card = document.getElementById('loket-' + l.id);
    if (!card) return;
    var c = l.current;
    var prev = lastCalled[l.id];
    var nowId = c ? c.id : null;
    if (prev === nowId && !firstLoad) return;

    card.innerHTML = '';
    card.appendChild(el('h2', null, l.label));
    if (c) {
      card.appendChild(el('div', 'kode', c.kode));
      card.appendChild(el('div', 'nama', c.nama));
    } else {
      card.appendChild(el('div', 'kosong', 'Belum ada panggilan'));
    }

    if (!firstLoad && c && prev !== nowId) {
      card.classList.remove('flash'); void card.offsetWidth; card.classList.add('flash');
      announce({ kode: c.kode, nama: c.nama, label: l.label });
    }
    lastCalled[l.id] = nowId;
  }

  function renderTunggu(list) {
    var ol = document.getElementById('tungguList');
    ol.innerHTML = '';
    list.forEach(function (r) {
      var li = el('li');
      li.appendChild(el('b', null, r.kode));
      li.appendChild(el('span', null, r.nama));
      ol.appendChild(li);
    });
    document.getElementById('tungguCount').textContent =
      list.length ? list.length + ' orang menunggu' : 'Tidak ada antrian';
  }

  function load() {
    fetch(STATUS_URL, { cache: 'no-store' })
      .then(function (r) { if (!r.ok) throw new Error(r.status); return r.json(); })
      .then(function (d) {
        document.getElementById('err').hidden = true;
        d.loket.forEach(renderLoket);
        renderTunggu(d.tunggu || []);
        firstLoad = false;
      })
      .catch(function () { document.getElementById('err').hidden = false; })
      .then(function () { setTimeout(load, POLL_MS); });
  }

  // ---- Jam ----
  function tick() {
    var now = new Date();
    document.getElementById('clock').textContent =
      now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' }) +
      '  •  ' + now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
  }
  tick(); setInterval(tick, 1000);

  load();
})();
</script>
</body>
</html>
