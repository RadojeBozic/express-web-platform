
#!/usr/bin/env bash

set -euo pipefail



DOMAIN=""

EMAIL=""

PASSWORD=""

DO_REGISTER=0



usage() {

  cat <<USAGE

Usage:

  $0 -d <domen> [-e <email> -p <pass>] [--register]



Primeri:

  $0 -d express-web.express

  $0 -d express-web.express -e "admin@example.com" -p "admin123"

  $0 -d express-web.express -e "novi@example.com" -p "secret123" --register

USAGE

}



# --- arg parsing ---

while [[ $# -gt 0 ]]; do

  case "$1" in

    -d|--domain) DOMAIN="${2:-}"; shift 2;;

    -e|--email) EMAIL="${2:-}"; shift 2;;

    -p|--password) PASSWORD="${2:-}"; shift 2;;

    --register) DO_REGISTER=1; shift;;

    -h|--help) usage; exit 0;;

    *) echo "Nepoznata opcija: $1"; usage; exit 1;;

  esac

done

[[ -z "$DOMAIN" ]] && { echo "✘ Nedostaje -d <domen>"; usage; exit 1; }



JAR="cookies.txt"

HDR="headers.txt"



say() { echo -e "\n== $* =="; }

ok()  { echo "✔ $*"; }

warn(){ echo "▲ $*"; }

err() { echo "✘ $*"; }



# --- 0. Okruženje ---

say "Laravel / PHP"

php artisan --version 2>/dev/null || true

php -v | head -n 1 || true



say "Sanctum/Session .env"

grep -E '^(APP_ENV|APP_URL|SESSION_DOMAIN|SESSION_SECURE_COOKIE|SESSION_SAME_SITE|SANCTUM_STATEFUL_DOMAINS)=' .env || true



# --- 1. Kernel sanity ---

say "Kernel api grupa (EnsureFrontendRequestsAreStateful)"

if grep -q 'EnsureFrontendRequestsAreStateful' app/Http/Kernel.php; then ok "EnsureFrontendRequestsAreStateful u Kernel-u"; else warn "Nema EnsureFrontendRequestsAreStateful u api grupi"; fi



# --- 2. Rute sanity ---

say "Provera SpaAuthController + rute"

if [[ -f app/Http/Controllers/Auth/SpaAuthController.php ]]; then ok "SpaAuthController postoji"; else warn "SpaAuthController NE postoji"; fi

php artisan route:list | egrep -qi '(^|[^a-z])login([^a-z]|$)' && ok "POST /login (web) postoji" || warn "Nema POST /login (web)"

php artisan route:list | egrep -qi '(^|[^a-z])register([^a-z]|$)' && ok "POST /register (web) postoji" || warn "Nema POST /register (web)"

php artisan route:list | egrep -qi '(^|[^a-z])logout([^a-z]|$)' && ok "POST /logout (web) postoji" || warn "Nema POST /logout (web)"

php artisan route:list | egrep -qi '(^|[^a-z])api/user([^a-z]|$)' && ok "GET /api/user (auth:sanctum) postoji" || warn "Nema GET /api/user"



# --- 3. .htaccess sanity ---

say "Provera .htaccess u public/"

if [[ -f public/.htaccess ]]; then

  grep -q 'RewriteCond %{REQUEST_FILENAME} -f' public/.htaccess && ok "Rule: -f" || warn "Nedostaje -f"

  grep -qE 'REQUEST_URI\} \^\W*(api|sanctum|login|logout|register|password|email)' public/.htaccess && ok "Rule: backend rute -> index.php" || warn "Nedostaje RewriteCond za backend rute"

  grep -q 'index.html' public/.htaccess && ok "SPA fallback" || warn "Nedostaje SPA fallback"

else

  warn "public/.htaccess ne postoji"

fi



# --- 4. CSRF / session ---

say "Sanctum: CSRF cookie"

rm -f "$JAR" "$HDR"

HTTP=$(curl -si -c "$JAR" -b "$JAR" "https://$DOMAIN/sanctum/csrf-cookie" | tee "$HDR" | awk 'NR==1{print $2}')

echo "HTTP: $HTTP"

grep -qi '^set-cookie:.*XSRF-TOKEN=' "$HDR" && ok "XSRF-TOKEN set" || err "Nema XSRF-TOKEN u Set-Cookie"

grep -qi '^set-cookie:.*\(laravel_session\|expressajt_session\)=' "$HDR" && ok "Session cookie set" || warn "Ne vidim session cookie (možda se postavlja tek na loginu)"



# XSRF ekstrakcija + URL decode (kao u browseru)

XSRF=$(awk -F'XSRF-TOKEN=' 'BEGIN{IGNORECASE=1} /^set-cookie:/ {split($2,a,";"); if(a[1]!=""){print a[1]; exit}}' "$HDR")

XSRF=$(XSRF="$XSRF" php -r 'echo urldecode(getenv("XSRF"));')

[[ -n "$XSRF" ]] && ok "XSRF token izdvojen" || err "Ne mogu da izvučem XSRF"



# --- 5. Optional: REGISTER ili LOGIN ---

if [[ -n "$EMAIL" && -n "$PASSWORD" ]]; then

  if [[ $DO_REGISTER -eq 1 ]]; then

    say "REGISTER (204/201/200 je ok; 422 -> validacija)"

    curl -si -c "$JAR" -b "$JAR" \

      -H "X-XSRF-TOKEN: $XSRF" \

      -H "Accept: application/json" \

      -H "Content-Type: application/json" \

      -H "X-Requested-With: XMLHttpRequest" \

      --data "{\"name\":\"Test User\",\"email\":\"$EMAIL\",\"password\":\"$PASSWORD\",\"password_confirmation\":\"$PASSWORD\"}" \

      "https://$DOMAIN/register" | awk 'NR==1{print; exit}'

  fi



  say "LOGIN test (204 je uspeh)"

  LHTTP=$(curl -si -c "$JAR" -b "$JAR" \

      -H "X-XSRF-TOKEN: $XSRF" \

      -H "Accept: application/json" \

      -H "Content-Type: application/json" \

      -H "X-Requested-With: XMLHttpRequest" \

      --data "{\"email\":\"$EMAIL\",\"password\":\"$PASSWORD\"}" \

      "https://$DOMAIN/login" | tee login.out | awk 'NR==1{print $2}')

  echo "HTTP: $LHTTP"

  if [[ "$LHTTP" == "204" ]]; then ok "Login OK (204)"; elif [[ "$LHTTP" == "401" ]]; then warn "401 (kredencijali?)"; elif [[ "$LHTTP" == "419" ]]; then err "419 (CSRF)"; else warn "Neočekivan login status: $LHTTP"; fi



  say "GET /api/user (200 ako si ulogovan; 401 ako nisi)"

  UHTTP=$(curl -si -c "$JAR" -b "$JAR" \

      -H "Accept: application/json" \

      -H "X-Requested-With: XMLHttpRequest" \

      "https://$DOMAIN/api/user" | tee user.out | awk 'NR==1{print $2}')

  echo "HTTP: $UHTTP"

  [[ "$UHTTP" == "200" ]] && ok "/api/user → 200" || warn "/api/user → $UHTTP (ako 302, dodaćemo Accept/XRW; ako 401, nisi ulogovan)"

else

  warn "Preskačem register/login test (nisi prosledio -e/-p)"

fi



echo

say "Rezime"

echo "Domen: $DOMAIN"

[[ -n "${EMAIL}" ]] && echo "Email: $EMAIL"

[[ -n "${PASSWORD}" ]] && echo "Password: (skr.)"

echo "Cookie jar: $JAR"

echo "Gotovo."

