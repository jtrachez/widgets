<?php

namespace Tequila\Widgets\Console\Commands;

use Illuminate\Console\Command;
use Tequila\Widgets\WidgetMaker;

class WidgetMake extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:widget {name} {--backend}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create widget with views';
    /**
     * @var WidgetMaker
     */
    private $maker;

    /**
     * Create a new command instance.
     *
     * @param WidgetMaker $maker
     */
    public function __construct(WidgetMaker $maker)
    {
        parent::__construct();
        $this->maker = $maker;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $is_backend = $this->option('backend');
        $name = $this->argument('name');

        $this->maker->setup($name, $is_backend);

        if (file_exists($this->maker->class_path)) {

            $this->warn('Widget already exist !!');
            $choice = $this->ask('Overwrite ? [Y/N]', 'N');

            if (ucfirst($choice) != 'Y') {
                return;
            }
        }

        $this->maker->makeClass();
        $this->maker->makeView();

    }
}
