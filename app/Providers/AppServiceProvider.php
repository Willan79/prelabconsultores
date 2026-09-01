<?php
/**
 * Los Service Providers en Laravel son clases que se encargan de registrar y
 * configurar servicios, dependencias y componentes de la aplicación.
 * Actúan como un punto central para la inicialización de servicios y la configuraciónde la aplicación.
 * Laravel utiliza un sistema de inyección de dependencias, y los Service Providers permiten definir
 * cómo se deben crear y configurar los servicios que la aplicación necesita.
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registre cualquier servicio de aplicación.
     *
     * @return void
     */
    public function register() 
    {
        //
    }

    /**
     * Inicializa cualquier servicio de aplicación.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
