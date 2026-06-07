<script>
/**
 * resources/views/kpr/simulasi-alpine.blade.php
 *
 * Didaftarkan via Alpine.data() — cara resmi Alpine v3.
 * Script ini di-include SEBELUM endsection sehingga dieksekusi
 * sebelum Alpine.start() dipanggil di app.js (DOMContentLoaded).
 *
 * Di blade: <div x-data="kprCalculator"> (tanpa tanda kurung)
 */
document.addEventListener('alpine:init', () => {
    Alpine.data('kprCalculator', () => ({

        /* ── STATE ─────────────────────────── */
        hargaRaw:        1200000000,
        hargaDisplay:    '',
        dpPersen:        20,
        tenorTahun:      20,
        promoTerpilih:   '',
        cicilanFix:      0,
        cicilanFloating: 0,
        showAmort:       false,

        daftarPromo: <?php echo json_encode($kprPromos ?? [], 15, 512) ?>,

        /* ── INIT ──────────────────────────── */
        init() {
            if (this.daftarPromo.length > 0) {
                this.promoTerpilih = this.daftarPromo[0].id;
            }
            this.hargaDisplay = this.formatToText(this.hargaRaw);
            this.$watch('hargaRaw',      () => this.hitung());
            this.$watch('dpPersen',      () => this.hitung());
            this.$watch('tenorTahun',    () => this.hitung());
            this.$watch('promoTerpilih', () => this.hitung());
            this.hitung();
        },

        /* ── COMPUTED (getters) ────────────── */
        get promoAktif() {
            return this.daftarPromo.find(p => p.id === this.promoTerpilih) || this.daftarPromo[0];
        },

        get plafon() {
            let dp = Math.min(Math.max(Number(this.dpPersen) || 0, 0), 99);
            return Math.max(0, this.hargaRaw - (this.hargaRaw * (dp / 100)));
        },

        get dpNominal() {
            let dp = Math.min(Math.max(Number(this.dpPersen) || 0, 0), 99);
            return this.hargaRaw * (dp / 100);
        },

        get estimasiBiayaLain() {
            return this.plafon * 0.05;
        },

        get pembayaranPertama() {
            let total = this.dpNominal + this.cicilanFix + this.estimasiBiayaLain;
            return isFinite(total) ? total : 0;
        },

        get tabelAmortisasi() {
            let rows = [];
            let P = this.plafon;
            if (P <= 0) return rows;

            let promo    = this.promoAktif;
            let tenor    = Math.min(Math.max(parseInt(this.tenorTahun) || 1, 1), 30);
            let n        = tenor * 12;
            let bulanFix = Math.min(promo.masa_fix * 12, n);
            let rFix     = (promo.bunga_fix / 100) / 12;
            let rFloat   = (promo.bunga_floating / 100) / 12;

            let angsuranFix   = this.cicilanFix;
            let angsuranFloat = this.cicilanFloating;
            let sisa = P;

            for (let b = 1; b <= n; b++) {
                let isFix      = b <= bulanFix;
                let r          = isFix ? rFix : rFloat;
                let ang        = isFix ? angsuranFix : angsuranFloat;
                let bungaBulan = sisa * r;
                let pokok      = ang - bungaBulan;
                sisa = Math.max(0, sisa - pokok);

                rows.push({
                    bulan:      b,
                    tahun:      Math.ceil(b / 12),
                    tipe:       isFix ? 'fix' : 'float',
                    bunga:      isFix ? promo.bunga_fix : promo.bunga_floating,
                    angsuran:   Math.round(ang),
                    pokok:      Math.round(pokok),
                    bungaBulan: Math.round(bungaBulan),
                    sisaPokok:  Math.round(sisa),
                });
            }
            return rows;
        },

        /* ── HELPERS ───────────────────────── */
        formatToText(value) {
            let num = parseFloat(value) || 0;
            if (!isFinite(num)) return 'Rp 0';
            if (num >= 1000000000) {
                let val = num / 1000000000;
                return (Number.isInteger(val) ? val : val.toFixed(2).replace(/\.?0+$/, '')) + ' Miliar';
            }
            if (num >= 1000000) {
                let val = num / 1000000;
                return (Number.isInteger(val) ? val : val.toFixed(1).replace(/\.?0+$/, '')) + ' Juta';
            }
            return num.toLocaleString('id-ID');
        },

        formatToNumber(value) {
            let val = value.toString().replace(/[^0-9]/g, '');
            return val.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        },

        formatRp(angka) {
            let safe = (isFinite(angka) && !isNaN(angka)) ? angka : 0;
            return new Intl.NumberFormat('id-ID', {
                style:                 'currency',
                currency:              'IDR',
                maximumFractionDigits: 0
            }).format(safe);
        },

        /* ── KALKULASI UTAMA ───────────────── */
        hitung() {
            let P     = this.plafon;
            let tenor = Math.min(Math.max(parseInt(this.tenorTahun) || 1, 1), 30);
            let n     = tenor * 12;
            let promo = this.promoAktif;

            if (P <= 0 || n <= 0 || !promo) {
                this.cicilanFix      = 0;
                this.cicilanFloating = 0;
                return;
            }

            /* — Cicilan periode Fix — */
            let rFix = (promo.bunga_fix / 100) / 12;
            if (rFix > 0) {
                let denom = 1 - Math.pow(1 + rFix, -n);
                this.cicilanFix = denom !== 0 ? (P * rFix) / denom : 0;
            } else {
                this.cicilanFix = n > 0 ? P / n : 0;
            }
            if (!isFinite(this.cicilanFix) || isNaN(this.cicilanFix)) this.cicilanFix = 0;

            /* — Sisa pokok setelah masa fix — */
            let bulanFix  = Math.min(promo.masa_fix * 12, n);
            let sisaPokok = 0;
            if (rFix > 0 && this.cicilanFix > 0) {
                sisaPokok = P * Math.pow(1 + rFix, bulanFix)
                          - this.cicilanFix * ((Math.pow(1 + rFix, bulanFix) - 1) / rFix);
            } else {
                sisaPokok = P - (this.cicilanFix * bulanFix);
            }
            sisaPokok = Math.max(0, isFinite(sisaPokok) ? sisaPokok : 0);

            /* — Cicilan periode Floating — */
            let rFloat    = (promo.bunga_floating / 100) / 12;
            let sisaBulan = n - bulanFix;
            if (sisaBulan > 0 && sisaPokok > 0) {
                if (rFloat > 0) {
                    let denom = 1 - Math.pow(1 + rFloat, -sisaBulan);
                    this.cicilanFloating = denom !== 0 ? (sisaPokok * rFloat) / denom : 0;
                } else {
                    this.cicilanFloating = sisaPokok / sisaBulan;
                }
            } else {
                this.cicilanFloating = 0;
            }
            if (!isFinite(this.cicilanFloating) || isNaN(this.cicilanFloating)) this.cicilanFloating = 0;
        }
    }));
});
</script>
<?php /**PATH /home/u851258633/domains/bintarolandproperty.com/public_html/resources/views/kpr/simulasi-alpine.blade.php ENDPATH**/ ?>