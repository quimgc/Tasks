# Tasks

## Error de moustachs amb PHP

Per solucionar l'error dels {{ variable }} del vue a l'interior d'un fixer .php, la solució està en posar **@** al devant de {{ variable }}


## Enllaç de adminlte alarms

https://adminlte.io/themes/AdminLTE/pages/UI/general.html 

## JSON amb php

http://php.net/manual/es/book.json.php

json_encode és per passar d'una variable a JSON.

## PROMISES

Si va bé executarà una cosa, i si va malament, una altra.

## npm run watch // npm run watch-poll

Serveix per compilar al instant.

#Crear una comanda

Per crear una comanda s'ha de fer:

    php artisan make:command nomFitxerComanda

# Extres

## Agafar header d'una taula per no implementar-ho hardcoded

    $tasks = Task::all()->toArray();
    $headers = array_keys($tasks[0]);
    dd($headers);
    
El resultat és: 

    array:4 [
      0 => "id"
      1 => "name"
      2 => "created_at"
      3 => "updated_at"


Ara es pot utilitzar $headers per a retornar alguna cosa en format de table:

        $this->table($headers,$tasks);

D'aquesta forma, no hi ha res hardcoded i si mai es modifica la taula, el codi funcionarà igual. 

# DIRECTORI MENÚ ESQUERRA

# NPM RUN HOT

S'ha d'executar abans d'arrencar el servidor web, ja que utilitza el port 8080.


# API passport

Aquests passos es fan cada cop que es treballi amb API.

https://laravel.com/docs/5.5/passport

per executar automàticament el php artisan passport:install es pot fer:


Al fitxer **DatabaseSeeder.php** a la funció run, afegir:

    Artisan::call('passport:install');


# VUE multiselect

https://github.com/monterail/vue-multiselect


# Paquet laravel

Un paquet laravel ho és perquè té providers.
Els paquets s'instal·len gràcies als fitxers composer.json.



# CAN'T CD NODE_MODULES

S'ha de fer un npm install.

    npm install
    
# Crear un objecte de tipus REQUEST

Per crear:

    php artisan make:request nom
    


# URL

Enllaç: http://acacha.org/mediawiki/URL#.WhcefU3Wx-U

**User Agent** -> browser.

Paquet es divideix amb dos parts:

- Capçalera-> Metdades.

- Dades -> la informació.


Per diferenciar entre URL i URI és:

- Si ens diu com arribar a aquella cosa és URL.
- Si identifica alguna cosa és URI.


