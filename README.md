# v2CRM
v2CRM CMS to build amazing manager software so easy and flexible!

# Features
- Theme managament and Plugin managament ready!
- Manage branches and users groups, fit with companies model
- Permission base on route + user group so flexiable with permissions table
- ....

# Installation
## Manually
#### 1. Clone source from this git
```sh
$ git clone https://github.com/tuandinhvu/v2CRM
```
#### 2. Run composer install
```sh
$ composer install
```

NOTE: In this step, some issue as
> [Symfony\Component\Debug\Exception\FatalThrowableError]
> Call to undefined method Illuminate\Foundation\Application::share()

This issue because share method removed from Laravel 5.4. To fix, you can open vendor/efriandika/src/SettingServiceProvider.php, replace register method by:

>public function register()
>   {
>        $this->mergeConfigFrom(
>            __DIR__ . '/config/settings.php', 'settings'
>        );
>        $this->app->singleton('settings', function ($app) {
>            $config = $app->config->get('settings', [
>                'cache_file' => storage_path('settings.json'),
>                'db_table'   => 'settings'
>            ]);
>            return new Settings($app['db'], new Cache($config['cache_file']), $config);
>        });
>    }

#### 3. Creating .ENV file
```sh
$ cp .env.example .env
```

#### 4. Config Database infomations
open .ENV and config

#### 5. Creating hashing Key
```sh
$ php artisan key:generate
```

#### 6. Setup database
```sh
$ php artisan migrate
```
and
```sh
$ php artisan db:seed
```

#### 7. Enjoy it with
Username: 1 
Password: 123456
