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


# SPA


# Toggle button

Primer que tot s'ha d'instal·lar:

https://github.com/euvl/vue-js-toggle-button

Tot seguit a l'**/home/quim/Code/Tasks/resources/assets/js/quimgc-tasks/index.js** s'ha d'afegir:

    import ToggleButton from 'vue-js-toggle-button'
    Vue.use(ToggleButton)


Un cop fet això, el que s'ha de fer és **wrapper**, al fitxer **Task.php** s'ha d'afegir:

    public function toArray()
        {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'user_id' => $this->user_id,
                'completed' => $this->completed? true:false,
                'created_at' => $this->created_at."",
                'updated_at' => $this->updated_at."",
            ];
        }
        
        
Amb això sobreescrivim el mèotode toArray per canviar el 0 o 1 per false o true.


#Laravel Dusk

https://laravel.com/docs/5.5/dusk

S'han de crear tests de tipus **Browser** seguint les tres fases:

- Preparació

- Executar

- Comprovar

## Instal·lació

    composer require --dev laravel/dusk
    php artisan dusk:install

La última comanda crea una carpeta on s'emmagatzemen imatges del moment que ha fallat per poder veure l'error a posteriori.

Per crear un test:

    php artisan dusk:make nomTest
    
Per executar un test no es pot fer amb shit + f10, s'ha de fer per terminal:

    php artisan dusk /ruta/fins/al/test
    
Però també s'ha de tenir un servidor obert per poder executar el test.

Si es comenta una linia del fitxer **DuskTestCase.php** es pot veure com s'executa el test:

     protected function driver()
        {
            $options = (new ChromeOptions)->addArguments([
                '--disable-gpu',
                //'--headless' linia a comentar
            ]);
    
            return RemoteWebDriver::create(
                'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
                    ChromeOptions::CAPABILITY, $options
                )
            );
        }



Per configurar el port del test és a **.env.dusk.local**:

Recomanació: Separar els entorns (Bd, Ports, Controladors,...) per cada cosa.


    ...
    APP_URL=http://localhost:8090
    
    DB_CONNECTION=sqlite_dusk_testing
    ...

Estem indicant que per als test s'utilitzarà el port 8090 i la bd sqlite_dusk_testing.


Modificar també amb la mateix configuració **.env.dusk.testing**.

S'ha de tenir en compte que s'ha d'obrir un servidor escoltant pel mateix port que s'executarà el test:

    php artisan serve --port=8090

També s'ha de modificar el fitxer **database.php** i afeigr:

    'sqlite_dusk_testing' => [
                'driver'   => 'sqlite',
                'database' => env('DB_DATABASE_TESTING', database_path('nom.bd.creada')),
                'prefix'   => '',
            ],
            
            
           
# Comunicació entre pare i fill

Per parlar del fill al pare;

- És necessita events.
- Propietats.


# VUE CUSTOM-UI

Enllaç wiki acacha:
- http://acacha.org/mediawiki/CSS#.WljKDk3Wx-U

S'ha creat un nou projecte vue:

    vue init webpack nomPlantilla
    
S'ha executat **npm run dev** per executar i veure les modificacions al navegador.


- CSS Normalize per evitar els css dels user agents:
https://necolas.github.io/normalize.css/


Per veure la disponibilitat de les etiquetes CSS als diferents navegadors:
- https://caniuse.com/


# VUE QUILL EDITOR

https://github.com/surmon-china/vue-quill-editor

# CREAR CONTROLADORS

    php artisan make:controller nomControlador
  
Automàticament apareixerà a l'apartat de controladors del nostre projecte.