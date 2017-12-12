# Tasks

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/quimgc/Tasks/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/quimgc/Tasks/?branch=master)
[![StyleCI](https://styleci.io/repos/107173094/shield?branch=master)](https://styleci.io/repos/107173094)
[![Dependency Status](https://www.versioneye.com/user/projects/5a1845d00fb24f20f940ac8d/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/5a1845d00fb24f20f940ac8d)
[![Build Status](https://travis-ci.org/quimgc/Tasks.svg?branch=master)](https://travis-ci.org/quimgc/Tasks)
[![Latest Stable Version](https://poser.pugx.org/quimgc/tasks/v/stable)](https://packagist.org/packages/quimgc/tasks)
[![Total Downloads](https://poser.pugx.org/quimgc/tasks/downloads)](https://packagist.org/packages/quimgc/tasks)
[![Latest Unstable Version](https://poser.pugx.org/quimgc/tasks/v/unstable)](https://packagist.org/packages/quimgc/tasks)
[![License](https://poser.pugx.org/quimgc/tasks/license)](https://packagist.org/packages/quimgc/tasks)
[![Monthly Downloads](https://poser.pugx.org/quimgc/tasks/d/monthly)](https://packagist.org/packages/quimgc/tasks)
[![Daily Downloads](https://poser.pugx.org/quimgc/tasks/d/daily)](https://packagist.org/packages/quimgc/tasks)
[![composer.lock](https://poser.pugx.org/quimgc/tasks/composerlock)](https://packagist.org/packages/quimgc/tasks)
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

Els requests ha de complir:

- Validacions.


# URL

Enllaç: http://acacha.org/mediawiki/URL#.WhcefU3Wx-U

**User Agent** -> browser.

Paquet es divideix amb dos parts:

- Capçalera-> Metdades.

- Dades -> la informació.


Per diferenciar entre URL i URI és:

- Si ens diu com arribar a aquella cosa és URL.
- Si identifica alguna cosa és URI.


# Helpers

Al composer.json s'ha de canviar l'autoload apuntant al fitxer helpers.php, d'aquesta forma s'aconsegueix que tothom pugui utilitzar aquest fitxer.


       "autoload": {
           ...
            "files" : [
             "app/helpers.php"
            ]
        },
        

Tot seguit s'executa:
    
    composer dumpautoload

       

# PLUCK

Aquest mètode agafa tots els valors a partir d'una clau passada com a paràmetre.

    $collection = collect([
        ['product_id' => 'prod-100', 'name' => 'Desk'],
        ['product_id' => 'prod-200', 'name' => 'Chair'],
    ]);
    
    
    $plucked = $collection->pluck('name');
    
    $plucked->all();
    
    // ['Desk', 'Chair']
    
    
 També es pot fer:
 
        $plucked = $collection->pluck('name', 'product_id');
        
        $plucked->all();
        
        // ['prod-100' => 'Desk', 'prod-200' => 'Chair']
        

# SCOPED

Assegura que només s'apliquen els canvis al style que es vol i no en general.

