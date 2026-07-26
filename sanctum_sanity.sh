#!/usr/bin/env bash

set -u -o pipefail


RED=$'\033[31m'; GRN=$'\033[32m'; YEL=$'\033[33m'; BLU=$'\033[34m'; BLD=$'\033[1m'; RST=$'\033[0m'

PASS(){ echo "${GRN}✔${RST} $*"; }

WARN(){ echo "${YEL}▲${RST} $*"; }

FAIL(){ echo "${RED}✘${RST} $*"; RET=1; }

SECTION(){ echo; echo "${BLD}== $* ==${RST}"; }

USAGE(){

  cat <<EOF

Usage: $0 -d DOMAIN [-e EMAIL -p PASS] [--host-127] [--fix] [--register]


  -d, --domain       npr. express-web.express  (ako izostane, čita iz .env APP_URL)

  -e, --email        email za login test

  -p, --password     lozinka za login test

      --register     ako user ne postoji: pokuša register pa zatim login

      --host-127     gađa http://127.0.0.1 sa Host headerom (umesto https://DOMAIN)

      --fix          automatski doda SpaAuthController + web rute (/login,/register,/logout)


Primeri:

  $0 -d express-web.express

  $0 -d express-web.express --fix

  $0 -d express-web.express -e user@example.com -p 'secret'

  $0 -d express-web.express --host-127 -e user@example.com -p 'secret'

EOF

  exit 1

}


# --- args ---

DOMAIN=""; EMAIL=""; PASSWD=""; HOST127=0; FIX=0; DO_REGISTER=0

while [[ $# -gt 0 ]]; do

  case "$1" in

    -d|--domain) DOMAIN="$2"; shift 2;;

    -e|--email) EMAIL="$2"; shift 2;;

    -p|--password) PASSWD="$2"; shift 2;;

    --host-127) HOST127=1; shift;;

    --fix) FIX=1; shift;;

    --register) DO_REGISTER=1; shift;;

    -h|--help) USAGE;;

    *) echo "Nepoznata opcija: $1"; USAGE;;

  esac

done


RET=0

req(){ command -v "$1" >/dev/null 2>&1 || { echo "Treba komanda: $1"; exit 1; }; }

req php; req grep; req sed; req awk; req curl; req cat; req head; req date


# --- pozicioniraj se ---

if [[ ! -f artisan ]]; then

  FAIL "Nisi u rootu Laravel app-a (nema 'artisan'). Uradi: cd ~/applications/ascqrnhbfh/public_html"

fi


# --- DOMAIN iz .env ako nije prosleđen ---

if [[ -z "$DOMAIN" ]]; then

  APP_URL=$(grep -E '^APP_URL=' .env | cut -d= -f2- | tr -d '"')

  DOMAIN=$(echo "$APP_URL" | sed -E 's#^[a-z]+://##; s#/.*##')

fi

[[ -z "$DOMAIN" ]] && { FAIL "Nisam uspeo da dobijem domen. Prosledi -d express-web.express"; exit 1; }


if [[ $HOST127 -eq 1 ]]; then

  BASE="http://127.0.0.1"

  HOPT=(-H "Host: $DOMAIN")

else

  BASE="https://$DOMAIN"

  HOPT=()

fi


SECTION "Laravel / PHP"

php artisan --version || true

php -v | head -n 1 || true


SECTION "Sanctum/Session .env"

ENV_SHOW=$(grep -E '^(APP_URL|APP_ENV|SESSION_DOMAIN|SESSION_SECURE_COOKIE|SESSION_SAME_SITE|SANCTUM_STATEFUL_DOMAINS)=' .env || true)

echo "$ENV_SHOW"

APEX=$(echo "$DOMAIN" | awk -F. '{print $(NF-1)"."$NF}')

EXP_DOMAIN=".$APEX"

echo

[[ "$ENV_SHOW" == *"SESSION_DOMAIN=$EXP_DOMAIN"* ]] && PASS "SESSION_DOMAIN OK ($EXP_DOMAIN)" || WARN "SESSION_DOMAIN preporuka: $EXP_DOMAIN"

[[ "$ENV_SHOW" == *"SESSION_SECURE_COOKIE=true"* ]] && PASS "SESSION_SECURE_COOKIE=true" || WARN "SESSION_SECURE_COOKIE nije true"

[[ "$ENV_SHOW" == *"SESSION_SAME_SITE=lax"* ]] && PASS "SESSION_SAME_SITE=lax" || WARN "SESSION_SAME_SITE: stavi 'lax'"

echo "$ENV_SHOW" | grep -q "SANCTUM_STATEFUL_DOMAINS=.*$APEX" && PASS "SANCTUM_STATEFUL_DOMAINS sadrži $APEX" || WARN "Dodaj $APEX u SANCTUM_STATEFUL_DOMAINS"

echo "$ENV_SHOW" | grep -q "SANCTUM_STATEFUL_DOMAINS=.*www.$APEX" && PASS "SANCTUM_STATEFUL_DOMAINS sadrži www.$APEX" || WARN "Dodaj www.$APEX u SANCTUM_STATEFUL_DOMAINS"


SECTION "Kernel api grupa (EnsureFrontendRequestsAreStateful)"

if grep -n "protected \$middlewareGroups" -n app/Http/Kernel.php >/dev/null 2>&1 && \

   grep -n "EnsureFrontendRequestsAreStateful" app/Http/Kernel.php >/dev/null 2>&1; then

  PASS "EnsureFrontendRequestsAreStateful postoji u Kernel-u"

else

  FAIL "Nedostaje EnsureFrontendRequestsAreStateful u api grupi (app/Http/Kernel.php)"

fi


SECTION "Provera SpaAuthController + rute"

if [[ -f app/Http/Controllers/Auth/SpaAuthController.php ]]; then

  PASS "SpaAuthController postoji"

else

  WARN "SpaAuthController NE postoji"

fi


php artisan route:list > .route_list.txt 2>/dev/null || true

grep -E "POST\s+login(\s|$)" .route_list.txt >/dev/null 2>&1 && PASS "POST /login (web) postoji" || WARN "Nema POST /login (web)"

grep -E "POST\s+register(\s|$)" .route_list.txt >/dev/null 2>&1 && PASS "POST /register (web) postoji" || WARN "Nema POST /register (web)"

grep -E "POST\s+logout(\s|$)" .route_list.txt >/dev/null 2>&1 && PASS "POST /logout (web) postoji" || WARN "Nema POST /logout (web)"

grep -E "api/user\b" .route_list.txt >/dev/null 2>&1 && PASS "GET /api/user postoji" || WARN "Nema GET /api/user (auth:sanctum)"


# --- Fix (opciono) ---

if [[ $FIX -eq 1 ]]; then

  SECTION "FIX: Kreiram SpaAuthController + web rute (ako fale)"

  if [[ ! -f app/Http/Controllers/Auth/SpaAuthController.php ]]; then

    mkdir -p app/Http/Controllers/Auth

    cat > app/Http/Controllers/Auth/SpaAuthController.php <<'PHP'

<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Auth\Events\Registered;

use App\Models\User;


class SpaAuthController extends Controller

{

    public function register(Request $request)

    {

        $rules = [

            'name'  => ['required','string','max:255'],

            'email' => ['required','string','email','max:255','unique:users,email'],

            'password' => ['required','string','min:6'],

            'referrer' => ['nullable','string','max:50'],

        ];

        if ($request->has('password_confirmation')) {

            $rules['password'][] = 'confirmed';

        }

        $validated = $request->validate($rules);


        $user = User::create([

            'name'     => $validated['name'],

            'email'    => $validated['email'],

            'password' => Hash::make($validated['password']),

        ]);


        event(new Registered($user));

        Auth::login($user);

        $request->session()->regenerate();

        return response()->noContent();

    }


    public function login(Request $request)

    {

        $credentials = $request->validate([

            'email'    => ['required','string','email'],

            'password' => ['required','string'],

        ]);


        if (! Auth::attempt($credentials, true)) {

            return response()->json(['message' => 'Invalid credentials'], 401);

        }


        $request->session()->regenerate();

        return response()->noContent();

    }


    public function logout(Request $request)

    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();

    }

}

PHP

    PASS "SpaAuthController kreiran"

  fi


  # Dodaj rute ako fale (koristimo FQCN da ne moramo 'use')

  if ! grep -q "Route::post('/login'" routes/web.php; then

    cp routes/web.php "routes/web.php.bak.$(date +%Y%m%d%H%M%S)"

    cat >> routes/web.php <<'PHP'


// --- SPA auth routes (dodato skriptom) ---

Route::post('/login',    [\App\Http\Controllers\Auth\SpaAuthController::class, 'login'])->name('login');

Route::post('/register', [\App\Http\Controllers\Auth\SpaAuthController::class, 'register']);

Route::post('/logout',   [\App\Http\Controllers\Auth\SpaAuthController::class, 'logout']);

PHP

    PASS "Dodate web rute u routes/web.php"

  else

    WARN "Web rute već postoje – preskačem"

  fi


  php -l routes/web.php >/dev/null && PASS "routes/web.php sintaksa OK" || FAIL "routes/web.php ima sintaksnu grešku"

  php artisan optimize:clear >/dev/null && PASS "artisan optimize:clear" || WARN "optimize:clear nije prošao"

  php artisan route:list > .route_list.txt 2>/dev/null || true

fi


SECTION "Provera .htaccess u public/"

if [[ -f public/.htaccess ]]; then

  cat public/.htaccess | grep -q "RewriteCond %{REQUEST_FILENAME} -f" && A=1 || A=0

  cat public/.htaccess | grep -q "^  RewriteCond %{REQUEST_URI} \^/(api|sanctum|login|logout|register|password|email) \[NC\]" && B=1 || B=0

  cat public/.htaccess | grep -q "^  RewriteRule \^ index.html \[L\]" && C=1 || C=0

  [[ $A -eq 1 ]] && PASS "Rule: propusti stvarne fajlove (-f)" || WARN "Nedostaje pravilo za -f"

  [[ $B -eq 1 ]] && PASS "Rule: /api|/sanctum|/login|... → index.php" || WARN "RewriteCond za backend rute nedostaje"

  [[ $C -eq 1 ]] && PASS "Rule: SPA fallback → index.html" || WARN "Nedostaje SPA fallback"

else

  WARN "public/.htaccess ne postoji?"

fi


SECTION "Sanctum: CSRF cookie preko $BASE"

HDR=$(mktemp); COOK="cookies.$$.txt"

curl -sS -D "$HDR" -o /dev/null "${HOPT[@]}" "$BASE/sanctum/csrf-cookie" || true

CODE=$(awk 'toupper($1) ~ /^HTTP/ {c=$2} END{print c+0}' "$HDR")

SC=$(grep -i '^set-cookie:' "$HDR" || true)

echo "HTTP: $CODE"; echo "$SC"

if [[ $CODE -eq 204 || $CODE -eq 200 ]]; then

  echo "$SC" | grep -q 'XSRF-TOKEN=' && PASS "XSRF-TOKEN set" || FAIL "Nema XSRF-TOKEN Set-Cookie"

  echo "$SC" | grep -qi 'laravel' && PASS "session cookie set" || WARN "Ne vidim session cookie (laravel_session/expressajt_session)"

else

  FAIL "CSRF endpoint vratio HTTP $CODE"

fi

# Sačuvaj kolačiće

curl -sS -c "$COOK" -b "$COOK" -o /dev/null "${HOPT[@]}" "$BASE/sanctum/csrf-cookie" || true

XSRF=$(php -r 'preg_match("/XSRF-TOKEN\s+([^\s]+)/", @file_get_contents(getenv("COOK")), $m) ? print urldecode($m[1]) : "";' 2>/dev/null COOK="$COOK")

[[ -n "${XSRF:-}" ]] && PASS "Izvučen XSRF header" || FAIL "Ne mogu da izvučem XSRF vrednost iz cookies.txt"


login_try(){

  local email="$1" pass="$2"

  SECTION "LOGIN test za $email (204 je uspeh)"

  HDR2=$(mktemp)

  curl -sS -D "$HDR2" -o /dev/null -c "$COOK" -b "$COOK" \

    -H "X-XSRF-TOKEN: $XSRF" -H "Accept: application/json" -H "Content-Type: application/json" \

    "${HOPT[@]}" --data "{\"email\":\"$email\",\"password\":\"$pass\"}" \

    "$BASE/login" || true

  LCODE=$(awk 'toupper($1) ~ /^HTTP/ {c=$2} END{print c+0}' "$HDR2")

  echo "HTTP: $LCODE"

  if [[ $LCODE -eq 204 || $LCODE -eq 200 ]]; then

    PASS "Login uspešan"

  else

    cat "$HDR2" | tail -n +1 | sed -n '1,10p' >/dev/null

    if [[ $LCODE -eq 404 ]]; then

      FAIL "/login 404 → Web rute ne postoje na serveru"

    elif [[ $LCODE -eq 419 ]]; then

      FAIL "419 (CSRF) → proveri CSRF cookie/headers"

    elif [[ $LCODE -eq 401 ]]; then

      WARN "401 (invalid credentials)"

    else

      WARN "Neočekivan status: $LCODE"

    fi

  fi


  SECTION "GET /api/user (200 očekivan posle login-a)"

  HDR3=$(mktemp)

  BODY=$(mktemp)

  curl -sS -D "$HDR3" -o "$BODY" -c "$COOK" -b "$COOK" "${HOPT[@]}" "$BASE/api/user" || true

  UCODE=$(awk 'toupper($1) ~ /^HTTP/ {c=$2} END{print c+0}' "$HDR3")

  echo "HTTP: $UCODE"

  if [[ $UCODE -eq 200 ]]; then

    PASS "/api/user OK"

    head -n 1 "$BODY" | sed 's/.*/Primer JSON (prva linija): &/'

  else

    WARN "/api/user status: $UCODE"

    head -n 1 "$BODY" | sed 's/.*/Telo (prva linija): &/'

  fi

}


register_try(){

  local email="$1" pass="$2"

  local name="Sanity Tester"

  SECTION "REGISTER test za $email (204/201 je uspeh)"

  HDR4=$(mktemp)

  curl -sS -D "$HDR4" -o /dev/null -c "$COOK" -b "$COOK" \

    -H "X-XSRF-TOKEN: $XSRF" -H "Accept: application/json" -H "Content-Type: application/json" \

    "${HOPT[@]}" --data "{\"name\":\"$name\",\"email\":\"$email\",\"password\":\"$pass\",\"password_confirmation\":\"$pass\",\"referrer\":\"sanity\"}" \

    "$BASE/register" || true

  RCODE=$(awk 'toupper($1) ~ /^HTTP/ {c=$2} END{print c+0}' "$HDR4")

  echo "HTTP: $RCODE"

  if [[ $RCODE -eq 204 || $RCODE -eq 201 || $RCODE -eq 200 ]]; then

    PASS "Registracija OK"

  else

    WARN "Registracija status: $RCODE (možda email zauzet?)"

  fi

}


if [[ -n "${EMAIL:-}" && -n "${PASSWD:-}" ]]; then

  if [[ $DO_REGISTER -eq 1 ]]; then

    register_try "$EMAIL" "$PASSWD"

  fi

  login_try "$EMAIL" "$PASSWD"

else

  WARN "Preskačem login/register test (nisi prosledio -e/-p)"

fi


echo

SECTION "Rezime"

[[ $RET -eq 0 ]] && echo "${GRN}Sve ključne provere prošle ili imaju jasne instrukcije iznad.${RST}" || echo "${YEL}Ima stavki za doradu – vidi FAIL/WARN iznad.${RST}"

exit $RET
