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


