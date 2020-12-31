<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {serviceName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name   =   $this->argument('serviceName');
        Storage::disk('local')->put('/app/Services/'.$name.'.php',
            "<?php
/**
 * Created by v2CRM.
 * User: tuandv
 * Date: ".Carbon::now()->toDateTimeString()."
 */
            
namespace App\Services;
            
            
            
class ".$name."
{
    function __construct(){
   
    }
   
    public function store(){
    
    }
   
    public function show(){
   
    }
   
    public function list(){
   
    }
   
    public function update(){
   
    }
   
    public function delete(){
   
    }
}
        ");
        echo 'Service created successfully';
    }
}
