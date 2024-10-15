[phases.setup]
runtime = "php81.withExtensions (pe: pe.enabled ++ [])"
packages = ["nginx", "libmysqlclient", "nodejs_18"]

[phases.install]
commands = [
  "mkdir -p /var/log/nginx",
  "mkdir -p /var/cache/nginx",
  "curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer",
  "composer install --ignore-platform-reqs",
  "yarn install --frozen-lockfile"
]

[phases.build]
commands = [
  "yarn run prod"
]

[phases.start]
commands = [
  "node /assets/scripts/prestart.mjs /assets/nginx.template.conf /nginx.conf",
  "php-fpm -y /assets/php-fpm.conf & nginx -c /nginx.conf"
]
