<?php $__env->startSection('title', 'Simulasi KPR BNI – Bintaro Land Property'); ?>

<?php $__env->startSection('head'); ?>
<style>
  /* ── CSS VARIABLES ─────────────────────── */
  :root {
    --bni-orange: #f37021;
    --bni-dark: #1a1a2e;
    --bni-navy: #0f3460;
    --gold: #c9a84c;
    --gold-light: #f0d080;
    --surface: #ffffff;
    --surface-2: #f8f7f5;
    --surface-3: #f0ede8;
    --text-1: #1a1a2e;
    --text-2: #4a4a6a;
    --text-3: #8a8aaa;
    --border: #e2ddd6;
    --radius: 14px;
    --radius-sm: 8px;
    --shadow: 0 2px 12px rgba(0,0,0,0.07);
    --shadow-lg: 0 8px 32px rgba(0,0,0,0.12);
  }

  /* ── PAGE HEADER ─────────────────────── */
  .kpr-page-header {
    background: linear-gradient(135deg, var(--bni-dark) 0%, var(--bni-navy) 100%);
    padding: 7.5rem 2rem 3rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 2rem;
  }
  .kpr-page-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at 70% 50%, rgba(201,168,76,0.15) 0%, transparent 60%);
  }
  .kpr-page-header-tag {
    display: inline-block;
    background: rgba(201,168,76,0.2);
    border: 1px solid rgba(201,168,76,0.4);
    color: var(--gold-light);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 5px 16px;
    border-radius: 20px;
    margin-bottom: 1rem;
    position: relative;
  }
  .kpr-page-header h1 {
    color: #fff;
    font-size: clamp(1.6rem, 4vw, 2.4rem);
    font-weight: 800;
    letter-spacing: -0.5px;
    margin-bottom: 0.75rem;
    position: relative;
  }
  .kpr-page-header p {
    color: rgba(255,255,255,0.65);
    font-size: 14px;
    max-width: 480px;
    margin: 0 auto;
    line-height: 1.6;
    position: relative;
  }

  /* ── LAYOUT ──────────────────────────── */
  .kpr-main-wrap {
    max-width: 1100px;
    margin: 0 auto;
    padding: 2rem 1.5rem 4rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    align-items: start;
  }
  @media (max-width: 860px) {
    .kpr-main-wrap { grid-template-columns: 1fr; }
  }

  /* ── CARD ────────────────────────────── */
  .kpr-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }
  .kpr-card-head {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .kpr-card-head h2 { font-size: 14px; font-weight: 700; color: var(--text-1); margin: 0; }
  .kpr-card-body { padding: 1.5rem; }

  /* ── FORM ELEMENTS ───────────────────── */
  .kpr-field { margin-bottom: 1.4rem; }
  .kpr-field:last-child { margin-bottom: 0; }
  .kpr-field-label {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
  }
  .kpr-field-label label { font-size: 13px; font-weight: 600; color: var(--text-2); }
  .val-badge, .kpr-field-label .val-badge {
    font-size: 12px;
    font-weight: 700;
    color: var(--bni-navy);
    background: #e8f0f8;
    padding: 2px 10px;
    border-radius: 20px;
  }

  .kpr-input-prefix-wrap {
    display: flex;
    align-items: stretch;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-sm);
    background: var(--surface);
    transition: border-color .2s;
    overflow: hidden;
  }
  .kpr-input-prefix-wrap:focus-within { border-color: var(--bni-navy); }
  .kpr-input-prefix {
    background: var(--surface-3);
    padding: 0 12px;
    display: flex;
    align-items: center;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-2);
    border-right: 1.5px solid var(--border);
    white-space: nowrap;
    flex-shrink: 0;
  }
  .kpr-input-prefix-wrap input {
    flex: 1;
    border: none;
    outline: none;
    padding: 11px 14px;
    font-size: 14px;
    font-weight: 600;
    font-family: inherit;
    background: transparent;
    color: var(--text-1);
    min-width: 0;
  }

  /* ── DP ROW ──────────────────────────── */
  .kpr-dp-row { display: flex; gap: 8px; margin-bottom: 10px; }
  .kpr-dp-pct-wrap {
    flex: 0 0 90px;
    display: flex;
    align-items: stretch;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-sm);
    background: var(--surface);
    transition: border-color .2s;
    overflow: hidden;
  }
  .kpr-dp-pct-wrap:focus-within { border-color: var(--bni-navy); }
  .kpr-dp-pct-wrap input {
    width: 100%;
    border: none;
    outline: none;
    padding: 11px 8px 11px 12px;
    font-size: 14px;
    font-weight: 700;
    font-family: inherit;
    color: var(--bni-navy);
    background: transparent;
    -moz-appearance: textfield;
  }
  .kpr-dp-pct-wrap input::-webkit-outer-spin-button,
  .kpr-dp-pct-wrap input::-webkit-inner-spin-button { -webkit-appearance: none; }
  .kpr-dp-pct-sym {
    padding: 0 10px 0 0;
    display: flex;
    align-items: center;
    font-size: 13px;
    font-weight: 700;
    color: var(--text-2);
  }
  .kpr-dp-nominal {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 8px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-sm);
    background: var(--surface-3);
    padding: 11px 14px;
    font-size: 13px;
    color: var(--text-2);
  }
  .kpr-dp-nominal span:first-child { font-weight: 500; flex-shrink: 0; }
  .kpr-dp-nominal span:last-child { font-weight: 700; color: var(--text-1); flex: 1; text-align: right; font-size: 14px; }

  /* ── RANGE SLIDER ────────────────────── */
  .kpr-range {
    width: 100%;
    height: 5px;
    border-radius: 10px;
    appearance: none;
    -webkit-appearance: none;
    background: linear-gradient(to right, var(--bni-navy) 0%, var(--bni-navy) var(--pct, 20%), var(--border) var(--pct, 20%));
    cursor: pointer;
    outline: none;
  }
  .kpr-range::-webkit-slider-thumb {
    appearance: none;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: var(--bni-navy);
    border: 3px solid #fff;
    box-shadow: 0 1px 4px rgba(0,0,0,0.25);
    cursor: pointer;
  }
  .kpr-range::-moz-range-thumb {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: var(--bni-navy);
    border: 3px solid #fff;
    cursor: pointer;
  }
  .kpr-range-labels { display: flex; justify-content: space-between; font-size: 11px; color: var(--text-3); margin-top: 6px; }

  /* ── QUICK TENOR PILLS ───────────────── */
  .kpr-quick-pills { display: flex; gap: 6px; margin-top: 10px; flex-wrap: wrap; }
  .kpr-pill-btn {
    flex: 1;
    min-width: 44px;
    padding: 6px 4px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-sm);
    background: var(--surface-2);
    color: var(--text-2);
    font-size: 12px;
    font-weight: 600;
    font-family: inherit;
    cursor: pointer;
    transition: all .15s;
    text-align: center;
  }
  .kpr-pill-btn.active, .kpr-pill-btn:hover {
    background: var(--bni-navy);
    color: #fff;
    border-color: var(--bni-navy);
  }

  /* ── PROMO RADIO CARDS ───────────────── */
  .kpr-promo-list { display: flex; flex-direction: column; gap: 8px; }
  .kpr-promo-card {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 12px 14px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius-sm);
    cursor: pointer;
    transition: all .15s;
    background: var(--surface);
  }
  .kpr-promo-card:hover { border-color: var(--bni-navy); }
  .kpr-promo-card.selected { border-color: var(--bni-navy); background: #f0f4fa; }
  .kpr-promo-card input[type=radio] { margin-top: 3px; accent-color: var(--bni-navy); flex-shrink: 0; }
  .kpr-promo-name { font-size: 13px; font-weight: 700; color: var(--text-1); }
  .kpr-promo-detail { font-size: 12px; color: var(--text-2); margin-top: 2px; line-height: 1.4; }
  .badge-fix { color: var(--bni-navy); font-weight: 700; }
  .badge-float { color: var(--bni-orange); font-weight: 700; }

  /* ── PLAFON FOOTER ───────────────────── */
  .kpr-plafon-bar {
    padding: 12px 1.5rem;
    background: var(--surface-3);
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .kpr-plafon-bar .lbl { font-size: 12px; color: var(--text-2); font-weight: 500; }
  .kpr-plafon-bar .val { font-size: 15px; font-weight: 800; color: var(--bni-navy); }

  /* ── DIVIDER ─────────────────────────── */
  .kpr-divider { border: none; border-top: 1px solid var(--border); margin: 1.2rem 0; }

  /* ── RIGHT CARD ──────────────────────── */
  .kpr-result-card { border-top: 4px solid var(--bni-orange); }

  .kpr-bank-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.5rem;
    background: var(--bni-dark);
    border-bottom: 1px solid rgba(255,255,255,0.08);
  }
  .kpr-bank-info { display: flex; align-items: center; gap: 12px; }
  .kpr-bank-logo {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    overflow: hidden;
  }
  .kpr-bank-logo img { height: 22px; width: auto; object-fit: contain; }
  .kpr-bank-name { color: #fff; font-weight: 700; font-size: 14px; }
  .kpr-bank-sub { color: rgba(255,255,255,0.55); font-size: 11px; margin-top: 1px; }
  .kpr-bank-tag { background: #22c55e; color: #fff; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 20px; white-space: nowrap; }

  /* ── RESULT BODY ─────────────────────── */
  .kpr-result-body { padding: 1.5rem; }

  .kpr-cicilan-section { margin-bottom: 1.2rem; }
  .kpr-cicilan-label { font-size: 12px; color: var(--text-3); margin-bottom: 6px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.8px; }
  .kpr-cicilan-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
  .kpr-cicilan-item {
    padding: 14px 16px;
    border-radius: var(--radius-sm);
    border: 1.5px solid var(--border);
  }
  .kpr-cicilan-item.fix { border-color: #c7d8ef; background: #f0f6ff; }
  .kpr-cicilan-item.float { border-color: #f9d9b8; background: #fff8f2; }
  .kpr-ci-period { font-size: 11px; color: var(--text-2); font-weight: 500; margin-bottom: 3px; line-height: 1.3; }
  .kpr-ci-bunga { font-size: 12px; font-weight: 700; margin-bottom: 8px; }
  .kpr-ci-bunga.fix { color: var(--bni-navy); }
  .kpr-ci-bunga.float { color: var(--bni-orange); }
  .kpr-ci-amount { font-size: 19px; font-weight: 800; }
  .kpr-ci-amount.fix { color: var(--bni-navy); }
  .kpr-ci-amount.float { color: var(--bni-orange); }
  .kpr-ci-unit { font-size: 11px; color: var(--text-3); margin-top: 2px; }

  /* ── ACTION BUTTONS ──────────────────── */
  .kpr-action-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin: 1.2rem 0; }
  .kpr-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 12px 16px;
    border-radius: var(--radius-sm);
    font-size: 13px;
    font-weight: 700;
    font-family: inherit;
    cursor: pointer;
    text-decoration: none;
    transition: all .15s;
    border: none;
  }
  .kpr-btn-primary { background: var(--bni-navy); color: #fff; }
  .kpr-btn-primary:hover { background: #0a2a4a; color: #fff; }
  .kpr-btn-outline {
    background: transparent;
    color: var(--bni-navy);
    border: 2px solid var(--bni-navy);
  }
  .kpr-btn-outline:hover { background: var(--bni-navy); color: #fff; }

  /* ── SUMMARY BREAKDOWN ───────────────── */
  .kpr-summary-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
  }
  .kpr-summary-head h4 { font-size: 13px; font-weight: 700; color: var(--text-1); margin: 0; }
  .kpr-summary-total { font-size: 14px; font-weight: 800; color: var(--bni-navy); }
  .kpr-summary-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; }
  .kpr-summary-item { display: flex; justify-content: space-between; align-items: center; font-size: 13px; }
  .kpr-si-left { display: flex; align-items: center; gap: 8px; color: var(--text-2); }
  .kpr-si-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--bni-navy); flex-shrink: 0; }
  .kpr-si-val { font-weight: 700; color: var(--text-1); }

  /* ── DISCLAIMER ──────────────────────── */
  .kpr-disclaimer {
    margin-top: 1.2rem;
    padding: 12px 14px;
    background: #fffbeb;
    border: 1px solid #fde68a;
    border-radius: var(--radius-sm);
    font-size: 12px;
    color: #92400e;
    line-height: 1.6;
  }

  /* ── AMORTIZATION TOGGLE ─────────────── */
  .kpr-amort-toggle-wrap { margin-top: 1.2rem; text-align: center; }
  .kpr-amort-toggle-btn {
    background: none;
    border: 1.5px solid var(--bni-navy);
    color: var(--bni-navy);
    font-family: inherit;
    font-size: 12px;
    font-weight: 700;
    padding: 8px 20px;
    border-radius: 20px;
    cursor: pointer;
    transition: all .15s;
  }
  .kpr-amort-toggle-btn:hover { background: var(--bni-navy); color: #fff; }

  /* ── AMORTIZATION TABLE ──────────────── */
  .kpr-amort-section {
    grid-column: 1 / -1;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }
  .kpr-amort-head {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .kpr-amort-head h3 { font-size: 14px; font-weight: 700; color: var(--text-1); margin: 0; }
  .kpr-amort-close {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
    color: var(--text-3);
    line-height: 1;
  }
  .kpr-table-wrap { overflow-x: auto; }
  .kpr-table-wrap table { width: 100%; border-collapse: collapse; font-size: 12px; }
  .kpr-table-wrap thead tr { background: var(--surface-3); }
  .kpr-table-wrap th { padding: 10px 14px; text-align: left; font-weight: 700; color: var(--text-2); font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; white-space: nowrap; }
  .kpr-table-wrap td { padding: 9px 14px; border-bottom: 1px solid var(--border); color: var(--text-1); font-weight: 500; white-space: nowrap; }
  .kpr-table-wrap tr:last-child td { border-bottom: none; }
  .kpr-table-wrap tr:hover td { background: var(--surface-2); }
  .kpr-table-wrap .bulan-fix td:first-child { border-left: 3px solid var(--bni-navy); }
  .kpr-table-wrap .bulan-float td:first-child { border-left: 3px solid var(--bni-orange); }
  .kpr-legend-row { display: flex; gap: 16px; padding: 12px 1.5rem; border-top: 1px solid var(--border); flex-wrap: wrap; }
  .kpr-legend-item { display: flex; align-items: center; gap: 6px; font-size: 11px; color: var(--text-2); }
  .kpr-legend-dot { width: 10px; height: 10px; border-radius: 2px; }

  /* ── MARQUEE RUNNING TEXT ──────────────── */
  .kpr-marquee-wrap {
    background: #fffbeb;
    border-top: 1px solid #fde68a;
    border-bottom: 1px solid #fde68a;
    color: #b45309;
    padding: 10px 0;
    overflow: hidden;
    position: relative;
    display: flex;
    align-items: center;
    font-size: 13px;
    font-weight: 500;
  }
  .kpr-marquee-content {
    display: inline-flex;
    white-space: nowrap;
    animation: marquee-scroll 25s linear infinite;
  }
  .kpr-marquee-content:hover {
    animation-play-state: paused;
  }
  .kpr-marquee-item {
    margin-right: 3rem;
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }
  @keyframes marquee-scroll {
    0% { transform: translateX(100vw); }
    100% { transform: translateX(-100%); }
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div x-data="kprCalculator" x-cloak>

  
  <div class="kpr-page-header">
    <div class="kpr-page-header-tag">Kalkulator Finansial</div>
    <h1>Simulasi KPR BNI Griya</h1>
    <p>Hitung estimasi cicilan KPR untuk properti impian Anda. Hasil berubah otomatis saat Anda mengubah parameter.</p>
  </div>

  
  <?php if(isset($kprPromos) && $kprPromos->count() > 0): ?>
  <div class="kpr-marquee-wrap">
    <div class="kpr-marquee-content">
        <?php $__currentLoopData = $kprPromos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="kpr-marquee-item">
                <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/></svg>
                Info Promo Terbaru: <strong><?php echo e($promo->nama); ?></strong> — Bunga Fix <strong><?php echo e($promo->bunga_fix); ?>%</strong> selama <?php echo e($promo->masa_fix); ?> Tahun, dilanjutkan Floating <?php echo e($promo->bunga_floating); ?>%. Segera konsultasikan KPR Anda!
            </span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
  <?php endif; ?>

  
  <div class="kpr-main-wrap">

    
    <div>
      <div class="kpr-card">
        <div class="kpr-card-head">
          <h2>Isi Rencana KPR</h2>
        </div>
        <div class="kpr-card-body">

          
          <div class="kpr-field">
            <div class="kpr-field-label">
              <label>Harga Properti <span style="color:#e53e3e">*</span></label>
              <span class="val-badge" x-text="formatToText(hargaRaw)"></span>
            </div>
            <div class="kpr-input-prefix-wrap">
              <span class="kpr-input-prefix">Rp</span>
              <input
                type="text"
                inputmode="numeric"
                maxlength="15"
                :value="hargaDisplay"
                @focus="$event.target.value = formatToNumber(hargaRaw)"
                @input="
                  let raw = $event.target.value.replace(/[^0-9]/g, '').substring(0, 15);
                  hargaRaw = raw ? parseInt(raw, 10) : 0;
                  hargaDisplay = formatToNumber(hargaRaw);
                  $event.target.value = hargaDisplay;
                "
                @blur="hargaDisplay = formatToText(hargaRaw)"
                placeholder="1.200.000.000"
              >
            </div>
          </div>

          
          <div class="kpr-field">
            <div class="kpr-field-label">
              <label>Uang Muka (DP)</label>
            </div>
            <div class="kpr-dp-row">
              <div class="kpr-dp-pct-wrap">
                <input
                  type="number" step="1" min="0" max="99"
                  x-model.number="dpPersen"
                  @keydown="if(['e','E','+','-','.'].includes($event.key)) $event.preventDefault()"
                  @input="
                    let v = parseInt($event.target.value) || 0;
                    dpPersen = Math.min(Math.max(v, 0), 99);
                  "
                >
                <span class="kpr-dp-pct-sym">%</span>
              </div>
              <div class="kpr-dp-nominal">
                <span>Rp</span>
                <span x-text="Math.round(dpNominal).toLocaleString('id-ID')"></span>
              </div>
            </div>
            <input class="kpr-range" type="range" x-model.number="dpPersen" min="0" max="99" step="1"
              :style="`--pct: ${dpPersen}%`">
            <div class="kpr-range-labels"><span>0%</span><span>99%</span></div>
          </div>

          <hr class="kpr-divider">

          
          <div class="kpr-field">
            <div class="kpr-field-label" style="margin-bottom: 10px;">
              <label>Program Promo BNI Griya</label>
            </div>
            <div class="kpr-promo-list">
              <template x-for="promo in daftarPromo" :key="promo.id">
                <label class="kpr-promo-card" :class="promoTerpilih === promo.id ? 'selected' : ''">
                  <input type="radio" :value="promo.id" x-model="promoTerpilih">
                  <div>
                    <div class="kpr-promo-name" x-text="promo.nama"></div>
                    <div class="kpr-promo-detail">
                      Fix <span class="badge-fix" x-text="promo.bunga_fix + '%'"></span>
                      selama <span x-text="promo.masa_fix"></span> tahun →
                      Floating <span class="badge-float" x-text="promo.bunga_floating + '%'"></span>
                    </div>
                  </div>
                </label>
              </template>
            </div>
          </div>

          <hr class="kpr-divider">

          
          <div class="kpr-field">
            <div class="kpr-field-label">
              <label>Jangka Waktu KPR (Tenor)</label>
              <span class="val-badge" x-text="tenorTahun + ' Tahun'"></span>
            </div>
            <input class="kpr-range" type="range" x-model.number="tenorTahun" min="1" max="30" step="1"
              :style="`--pct: ${((tenorTahun - 1) / 29) * 100}%`">
            <div class="kpr-range-labels"><span>1 Tahun</span><span>30 Tahun</span></div>
            <div class="kpr-quick-pills">
              <template x-for="t in [5,10,15,20,25,30]" :key="t">
                <button type="button" class="kpr-pill-btn" :class="Number(tenorTahun) === t ? 'active' : ''"
                  @click="tenorTahun = t" x-text="t + 'th'"></button>
              </template>
            </div>
          </div>

        </div>

        
        <div class="kpr-plafon-bar">
          <span class="lbl">Plafon Kredit</span>
          <span class="val" x-text="formatRp(plafon)"></span>
        </div>
      </div>
    </div>

    
    <div>
      <div class="kpr-card kpr-result-card">

        
        <div class="kpr-bank-header">
          <div class="kpr-bank-info">
            <div class="kpr-bank-logo">
              <img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/1200px-BNI_logo.svg.png" alt="BNI"
                onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-weight:800;font-size:12px;color:#f37021\'>BNI</span>'">
            </div>
            <div>
              <div class="kpr-bank-name">Bank BNI</div>
              <div class="kpr-bank-sub" x-text="promoAktif.nama"></div>
            </div>
          </div>
          <span class="kpr-bank-tag">Mudah &amp; Cepat</span>
        </div>

        <div class="kpr-result-body">

          
          <div class="kpr-cicilan-section">
            <div class="kpr-cicilan-label">Angsuran per Bulan</div>
            <div class="kpr-cicilan-grid">

              
              <div class="kpr-cicilan-item fix">
                <div class="kpr-ci-period">Tahun 1 s.d <span x-text="promoAktif.masa_fix"></span></div>
                <div class="kpr-ci-bunga fix">Bunga Fix <span x-text="promoAktif.bunga_fix + '%'"></span></div>
                <div class="kpr-ci-amount fix" x-text="formatRp(cicilanFix)"></div>
                <div class="kpr-ci-unit">/bulan</div>
              </div>

              
              <div class="kpr-cicilan-item float">
                <div class="kpr-ci-period">Tahun <span x-text="Number(promoAktif.masa_fix) + 1"></span> s.d <span x-text="tenorTahun"></span></div>
                <div class="kpr-ci-bunga float">Bunga Floating <span x-text="promoAktif.bunga_floating + '%'"></span></div>
                <div class="kpr-ci-amount float"
                  x-text="cicilanFloating > 0 ? formatRp(cicilanFloating) : '—'"></div>
                <div class="kpr-ci-unit" x-show="cicilanFloating > 0">/bulan</div>
              </div>

            </div>
          </div>

          
          <div class="kpr-action-row">
            <a :href="`https://wa.me/<?php echo e(env('WHATSAPP_NUMBER', '6281234567890')); ?>?text=Halo+saya+ingin+tanya+KPR+BNI+untuk+properti+senilai+${formatRp(hargaRaw)}`"
              target="_blank" class="kpr-btn kpr-btn-primary">
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
              Tanya KPR
            </a>
            <a href="https://eform.bni.co.id" target="_blank" class="kpr-btn kpr-btn-outline">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
              eForm BNI
            </a>
          </div>

          <hr class="kpr-divider">

          
          <div>
            <div class="kpr-summary-head">
              <h4>Estimasi Pembayaran Pertama</h4>
              <span class="kpr-summary-total" x-text="formatRp(pembayaranPertama)"></span>
            </div>
            <ul class="kpr-summary-list">
              <li class="kpr-summary-item">
                <div class="kpr-si-left"><span class="kpr-si-dot"></span> Uang Muka (DP)</div>
                <span class="kpr-si-val" x-text="formatRp(dpNominal)"></span>
              </li>
              <li class="kpr-summary-item">
                <div class="kpr-si-left"><span class="kpr-si-dot"></span> Angsuran Pertama</div>
                <span class="kpr-si-val" x-text="formatRp(cicilanFix)"></span>
              </li>
              <li class="kpr-summary-item">
                <div class="kpr-si-left">
                  <span class="kpr-si-dot"></span>
                  <span>Estimasi Biaya Lainnya</span>
                  <span title="Estimasi 5% dari Plafon: Provisi, Administrasi, Asuransi, Notaris"
                    style="color:var(--text-3);cursor:help;font-size:13px">ⓘ</span>
                </div>
                <span class="kpr-si-val" x-text="formatRp(estimasiBiayaLain)"></span>
              </li>
            </ul>
          </div>

          
          <div class="kpr-amort-toggle-wrap">
            <button class="kpr-amort-toggle-btn" @click="showAmort = !showAmort"
              x-text="showAmort ? '▲ Sembunyikan Tabel Amortisasi' : '▼ Lihat Tabel Amortisasi'">
            </button>
          </div>

          
          <div class="kpr-disclaimer">
            <strong>⚠️ Disclaimer:</strong> Hasil di atas merupakan angka estimasi. Data perhitungan dapat berbeda dengan perhitungan bank. Suku bunga floating bersifat fluktuatif mengikuti kebijakan Bank Indonesia. Hubungi kami untuk konsultasi lebih lanjut.
          </div>

        </div>
      </div>
    </div>

    
    <div class="kpr-amort-section" x-show="showAmort" x-transition>
      <div class="kpr-amort-head">
        <h3>Tabel Angsuran Lengkap — <span x-text="tenorTahun * 12"></span> Bulan</h3>
        <button class="kpr-amort-close" @click="showAmort = false">✕</button>
      </div>
      <div class="kpr-table-wrap">
        <table>
          <thead>
            <tr>
              <th>Bln</th>
              <th>Tahun</th>
              <th>Tipe</th>
              <th>Bunga</th>
              <th>Angsuran</th>
              <th>Pokok</th>
              <th>Bunga Bln</th>
              <th>Sisa Pokok</th>
            </tr>
          </thead>
          <tbody>
            <template x-for="row in tabelAmortisasi" :key="row.bulan">
              <tr :class="row.tipe === 'fix' ? 'bulan-fix' : 'bulan-float'">
                <td x-text="row.bulan"></td>
                <td x-text="row.tahun"></td>
                <td>
                  <span :style="row.tipe === 'fix' ? 'color:var(--bni-navy);font-weight:700' : 'color:var(--bni-orange);font-weight:700'"
                    x-text="row.tipe === 'fix' ? 'Fix' : 'Float'"></span>
                </td>
                <td x-text="row.bunga + '%'"></td>
                <td x-text="formatRp(row.angsuran)"></td>
                <td x-text="formatRp(row.pokok)"></td>
                <td x-text="formatRp(row.bungaBulan)"></td>
                <td x-text="formatRp(row.sisaPokok)"></td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
      <div class="kpr-legend-row">
        <div class="kpr-legend-item"><span class="kpr-legend-dot" style="background:var(--bni-navy)"></span> Periode Fix</div>
        <div class="kpr-legend-item"><span class="kpr-legend-dot" style="background:var(--bni-orange)"></span> Periode Floating</div>
      </div>
    </div>

  </div>
</div>
<?php echo $__env->make('kpr.simulasi-alpine', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u851258633/domains/bintarolandproperty.com/public_html/resources/views/kpr/simulasi.blade.php ENDPATH**/ ?>