{{-- resources/views/pdf/invoice.blade.php --}}
<!DOCTYPE html>
<html lang="sr">
<head>
  <meta charset="UTF-8">
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 14px; color: #111; }
    .title { font-size: 20px; font-weight: bold; margin-bottom: 10px; }
    .section { margin-bottom: 18px; }
    .label { font-weight: bold; }
    .box { border: 1px solid #ccc; padding: 10px; border-radius: 6px; margin-top: 5px; }
    table { width:100%; border-collapse: collapse; margin-top: 8px; }
    th, td { border:1px solid #ccc; padding:8px; }
    th { background:#f5f5f5; text-align:left; }
    .right { text-align:right; }
  </style>
</head>
<body>
  <div class="title">𐇾 Profaktura #{{ $invoice->id }}</div>

  @php
    use Carbon\Carbon;

    // Datumi
    $today   = Carbon::now();
    $dueDate = $today->copy()->addDays(3);

    // Kurs konverzije (fiksni za profakturu)
    $rate = 117.5;

    // Items: dozvoli i JSON string i već-dekodiran niz
    $rawItems = $invoice->items ?? [];
    if (is_string($rawItems)) {
        $items = json_decode($rawItems, true) ?: [];
    } elseif (is_array($rawItems)) {
        $items = $rawItems;
    } else {
        $items = [];
    }

    // Helper: EUR centi -> prikazana valuta (EUR ili RSD)
    $toDisplay = function (int $eurCents) use ($rate, $invoice) {
        $cents = $invoice->currency === 'rsd'
            ? (int) round($eurCents * $rate)
            : $eurCents;
        return number_format($cents / 100, 2, ',', '.');
    };

    // Izračunaj total u EUR centima (iz stavki) ili padni na amount iz baze
    $computedTotalEurCents = 0;
    foreach ($items as $it) {
        $qty     = (int)($it['quantity'] ?? $it['qty'] ?? 1);
        $unitEur = (int)($it['unit_price_cents'] ?? 0); // OČEKUJEMO EUR CENTI
        $computedTotalEurCents += $unitEur * $qty;
    }
    $totalEurCents = $computedTotalEurCents > 0
        ? $computedTotalEurCents
        : (int)($invoice->total_cents ?? $invoice->amount ?? 0);

    // Tekstovi total-a u obe valute (za napomenu u dnu)
    $totalEurText = number_format($totalEurCents / 100, 2, ',', '.') . ' EUR';
    $totalRsdText = number_format(($totalEurCents * $rate) / 100, 2, ',', '.') . ' RSD';
  @endphp

  <div class="section">
    <span class="label">Datum izdavanja:</span> {{ $today->format('d.m.Y.') }}<br>
    <span class="label">Rok za plaćanje:</span> {{ $dueDate->format('d.m.Y.') }}
  </div>

  <div class="section">
    <span class="label">Račun izdaje:</span>
    <div class="box">
      Radoje Božić pr Računarsko programiranje EXPRESS WEB Beograd-Palilula<br>
      VITEZOVA KARAĐORĐEVE ZVEZDE 50, 11050 Beograd<br>
      MB: 68170168 | PIB: 115191597<br>
      Račun: 105000000331557669
    </div>
  </div>

  <div class="section">
    <span class="label">Kupac:</span>
    <div class="box">
      Ime: {{ $invoice->name }}<br>
      Email: {{ $invoice->email }}<br>
      Valuta: {{ strtoupper($invoice->currency) }}
    </div>
  </div>

  @if (!empty($invoice->description))
    <div class="section">
      <span class="label">Predmet profakture:</span>
      <div class="box">{{ $invoice->description }}</div>
    </div>
  @endif

  @if (count($items))
    <div class="section">
      <span class="label">Stavke:</span>
      <table>
        <thead>
          <tr>
            <th>Opis</th>
            <th class="right">Količina</th>
            <th class="right">Cena ({{ strtoupper($invoice->currency) }})</th>
            <th class="right">Iznos ({{ strtoupper($invoice->currency) }})</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($items as $it)
            @php
              $name    = $it['name'] ?? 'Stavka';
              $qty     = (int)($it['quantity'] ?? $it['qty'] ?? 1);
              $unitEur = (int)($it['unit_price_cents'] ?? 0); // EUR centi
              $lineEur = $unitEur * $qty;
            @endphp
            <tr>
              <td>{{ $name }}</td>
              <td class="right">{{ $qty }}</td>
              <td class="right">{{ $toDisplay($unitEur) }}</td>
              <td class="right">{{ $toDisplay($lineEur) }}</td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th colspan="3" class="right">Ukupno ({{ strtoupper($invoice->currency) }}):</th>
            <th class="right">{{ $toDisplay($totalEurCents) }}</th>
          </tr>
          @if ($invoice->currency === 'eur')
            <tr>
              <th colspan="3" class="right">Ukupno (RSD):</th>
              <th class="right">{{ number_format(($totalEurCents * $rate) / 100, 2, ',', '.') }}</th>
            </tr>
          @endif
        </tfoot>
      </table>
      <div style="margin-top:6px;font-size:12px;color:#555;">
        Kurs konverzije 1 EUR = {{ number_format($rate, 2, ',', '.') }} RSD (NBS srednji kurs).
      </div>
    </div>
  @else
    <div class="section">
      <span class="label">Iznos za uplatu:</span><br>
      {{ $toDisplay($totalEurCents) }} {{ strtoupper($invoice->currency) }}
      @if ($invoice->currency === 'eur')
        ({{ number_format(($totalEurCents * $rate) / 100, 2, ',', '.') }} RSD)
      @endif
    </div>
  @endif

  <div class="section">
    <p>Uplatu izvršiti na račun: 105000000331557669<br>
    U pozivu na broj upisati broj profakture.</p>
    <p>Profaktura je validna bez pečata i potpisa. Preduzetnik nije u sistemu PDV-a.</p>
    <p>Hvala na poverenju.</p>
  </div>
</body>
</html>
