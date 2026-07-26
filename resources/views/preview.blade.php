<!doctype html>

<html lang="sr">

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width,initial-scale=1">

  <title>{{ $data->name ?? 'Prezentacija' }}</title>

  <style>

    :root { --ink:#0f172a; --muted:#475569; --line:#e2e8f0; --brand:#6d28d9; }

    * { box-sizing: border-box; }

    body { margin:0; font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, Noto Sans, 'Helvetica Neue', Arial, sans-serif; color:var(--ink); background:#fff; }

    .wrap { max-width: 1000px; margin: 32px auto; padding: 0 16px; }

    header { display:flex; align-items:center; justify-content:space-between; padding-bottom:16px; border-bottom:1px dashed var(--line); margin-bottom:24px; gap:16px; }

    .brand { display:flex; align-items:center; gap:12px; }

    .brand img { width:56px; height:56px; object-fit:contain; border-radius:50%; }

    .muted { color:var(--muted); font-size:14px; }

    h1,h2 { margin:0 0 8px; }

    h1 { font-size:22px; }

    h2 { font-size:20px; color:var(--brand); }

    .hero { margin:24px 0 32px; }

    .hero img { width:100%; height:360px; object-fit:cover; border-radius:12px; margin:12px 0; }

    .section { margin:32px 0; }

    .grid { display:grid; grid-template-columns: repeat( auto-fit, minmax(220px, 1fr) ); gap:16px; }

    .card { border:1px solid var(--line); border-radius:12px; padding:10px; background:#fff; }

    .card img { width:100%; height:170px; object-fit:cover; border-radius:8px; }

    footer { border-top:1px solid var(--line); margin-top:40px; padding:16px 0; text-align:center; color:var(--muted); font-size:14px; }

    .sr { position:absolute; left:-9999px; }

    iframe { border:1px solid var(--line); border-radius:8px; }

  </style>

</head>

<body>

  <div class="wrap">


    {{-- Header --}}

    <header>

      <div class="brand">

        @if(!empty($media['logo']))

          <img src="{{ $media['logo'] }}" alt="Logo {{ e($data->name) }}" loading="lazy">

        @endif

        <div>

          <h1>{{ $data->name ?? 'Va≈°a firma' }}</h1>

          @if(!empty($data->template))

            <div class="muted">{{ strtoupper($data->template) }}</div>

          @endif

        </div>

      </div>

      <div style="text-align:right">

        @if(!empty($data->email)) <div class="muted">{{ e($data->email) }}</div> @endif

        @if(!empty($data->phone)) <div class="muted">{{ e($data->phone) }}</div> @endif

      </div>

    </header>


    {{-- Hero --}}

    <section class="hero">

      @if(!empty($media['hero']))

        <img src="{{ $media['hero'] }}" alt="Hero slika" loading="lazy">

      @endif

      @if(!empty($data->hero_title))

        <h2>{{ $data->hero_title }}</h2>

      @endif

      @if(!empty($data->hero_subtitle))

        <p class="muted">{!! nl2br(e($data->hero_subtitle)) !!}</p>

      @endif

    </section>


    {{-- Opis delatnosti --}}

    @if(!empty($data->description))

      <section class="section">

        <h2>Ì†ΩÌ≥ã Opis delatnosti</h2>

        <p>{!! nl2br(e($data->description)) !!}</p>

      </section>

    @endif


    {{-- O nama --}}

    @if(!empty($data->about_title) || !empty($data->about_text) || !empty($media['about']))

      <section class="section">

        @if(!empty($data->about_title))

          <h2>Ì†ΩÌ±• {{ $data->about_title }}</h2>

        @endif

        <div class="grid">

          @if(!empty($media['about']))

            <div class="card"><img src="{{ $media['about'] }}" alt="O nama slika" loading="lazy"></div>

          @endif

          @if(!empty($data->about_text))

            <div class="card" style="display:flex;align-items:center;">

              <p>{!! nl2br(e($data->about_text)) !!}</p>

            </div>

          @endif

        </div>

      </section>

    @endif


    {{-- Ponuda / Galerija --}}

    @if(!empty($data->offer_title) || count($offerImages))

      <section class="section">

        <h2>Ì†ΩÌªçÔ∏è {{ $data->offer_title ?: 'Na≈°a ponuda' }}</h2>

        @if(count($offerImages))

          <div class="grid">

            @foreach($offerImages as $it)

              <figure class="card">

                <img src="{{ $it['image'] }}" alt="{{ e($it['title'] ?: 'Stavka ponude') }}" loading="lazy">

                @if(!empty($it['title']))

                  <figcaption class="muted" style="margin-top:8px">{{ e($it['title']) }}</figcaption>

                @endif

              </figure>

            @endforeach

          </div>

        @else

          <p class="muted">Ponuda jo≈° nije popunjena.</p>

        @endif

      </section>

    @endif


    {{-- PDF --}}

    @if(!empty($media['pdf']))

      <section class="section">

        <h2>Ì†ΩÌ≥Ñ PDF</h2>

        <iframe src="{{ $media['pdf'] }}" width="100%" height="600" loading="lazy" title="PDF dokument"></iframe>

      </section>

    @endif


    {{-- Mapa --}}

    @php

      $map = null;

      if (!empty($data->google_map_link) && preg_match('/\/maps\/embed/i', $data->google_map_link)) {

          $map = $data->google_map_link;

      } elseif (!empty($data->address)) {

          $map = 'https://www.google.com/maps?q='.urlencode($data->address).'&output=embed';

      }

    @endphp

    @if($map)

      <section class="section">

        <h2>Ì†ΩÌ≥ç Lokacija</h2>

        <iframe src="{{ $map }}" width="100%" height="360" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Mapa"></iframe>

      </section>

    @endif


    {{-- Footer --}}

    <footer>

      ¬© {{ now()->year }} {{ $data->name ?? 'Va≈°a firma' }} ‚Äî

      <span class="muted">Prezentacija</span>

    </footer>

  </div>

</body>

</html>
