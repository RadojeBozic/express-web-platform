<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'currency',     // 'eur' ili 'rsd' (display valuta)
        'amount',       // fallback (istorijski); u centima EUR ako se koristi
        'status',       // pending|approved|paid|cancelled
        'description',
        'items',        // JSON: [{ name, quantity, unit_price_cents }]
        'total_cents',  // UKUPNO u EUR centima (canonical)
    ];

    protected $casts = [
        'items'       => 'array',
        'total_cents' => 'integer',
    ];

    # -- Lifecycle hook: normalizacija i obračun total_cents --
    protected static function booted(): void
    {
        static::saving(function (self $invoice) {
            // 1) Normalizuj valutu
            if ($invoice->currency) {
                $invoice->currency = strtolower(trim($invoice->currency));
                if (!in_array($invoice->currency, ['eur', 'rsd'], true)) {
                    $invoice->currency = 'eur';
                }
            } else {
                $invoice->currency = 'eur';
            }

            // 2) Items kao niz (ako je null)
            if (is_null($invoice->items)) {
                $invoice->items = [];
            }

            // 3) Izračunaj total u EUR centima iz stavki (ako postoje)
            $computed = 0;
            foreach ((array) $invoice->items as $it) {
                $qty     = (int)($it['quantity'] ?? $it['qty'] ?? 1);
                $unitEur = (int)($it['unit_price_cents'] ?? 0); // OČEKUJEMO EUR centi po stavci
                $computed += $unitEur * $qty;
            }

            if ($computed > 0) {
                $invoice->total_cents = $computed;
            } else {
                // Nema stavki? Osloni se na 'total_cents' ako je zadat ili na 'amount' (legacy).
                if (empty($invoice->total_cents)) {
                    $invoice->total_cents = (int) ($invoice->amount ?? 0);
                }
            }
        });
    }

    # -- Pomoćni accessor: ukupno u EUR centima (canonical) --
    public function totalEurCents(): int
    {
        if (!empty($this->total_cents)) {
            return (int) $this->total_cents;
        }
        if (!empty($this->items)) {
            $sum = 0;
            foreach ((array) $this->items as $it) {
                $qty     = (int)($it['quantity'] ?? $it['qty'] ?? 1);
                $unitEur = (int)($it['unit_price_cents'] ?? 0);
                $sum    += $unitEur * $qty;
            }
            return $sum;
        }
        return (int) ($this->amount ?? 0);
    }

    # -- Putanje i rad sa PDF-om --
    public function pdfRelativePath(): string
    {
        return "invoices/invoice-{$this->id}.pdf";
    }

    public function pdfExists(): bool
    {
        return Storage::exists($this->pdfRelativePath());
    }

    public function deletePDF(): void
    {
        if ($this->pdfExists()) {
            Storage::delete($this->pdfRelativePath());
        }
    }

    /**
     * Generiše i snima PDF u storage/app/invoices.
     * @param bool $force Ako je false i PDF već postoji – preskače generisanje (brže).
     */
    public function generatePDF(bool $force = false): void
    {
        // Kreiraj folder ako ne postoji
        if (!Storage::exists('invoices')) {
            Storage::makeDirectory('invoices');
        }

        $path = $this->pdfRelativePath();

        if (!$force && Storage::exists($path)) {
            return; // već postoji – ne renderujemo ponovo
        }

        // Render
        $pdf = Pdf::loadView('pdf.invoice', ['invoice' => $this]);

        // Snimi
        Storage::put($path, $pdf->output());
    }
}
