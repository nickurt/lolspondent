## De Lol Spondent - De Correspondent Artikeldatabase

### Features

* Recente artikelen
* Meest populaire artikelen
* Artikelarchief

### Installatie
#### Installatie met de composer
```sh
git clone https://github.com/nickurt/lolspondent.git
cd lolspondent
curl -sS https://getcomposer.org/installer | php
php composer.phar install
php -S 0.0.0.0:8888 -t public_html public_html/index.php
```
### Importeren
Importeer de laatste (unique) artikelen vanaf Twitter (verander de oauth/consumer keys)
```php
php import.php
```
### Requirements

* PHP5.4+
* SlimPHP