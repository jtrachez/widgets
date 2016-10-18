<?php

namespace Tequila\Widgets;


use Illuminate\Filesystem\Filesystem;

class WidgetMaker
{

    use Stub;

    protected $type;
    protected $view_path;
    protected $name;

    public $class_path;

    /**
     * @var Filesystem
     */
    private $files;

    /**
     * WidgetMaker constructor.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    /**
     * @return int
     */
    public function makeClass()
    {

        $directory = app_path("Widgets/{$this->type}");

        $stub_file = __DIR__ . '/stubs/app/widget.class.stub';
        $namespace = config('widgets.namespaces')[0];

        $content = $this->stub($stub_file, [
            'type'             => $this->type,
            'class_name'       => studly_case($this->name),
            'class_name_snake' => snake_case(studly_case($this->name)),
            'type_snake'       => snake_case($this->type),
            'namespace'        => $namespace,
        ]);

        if (!is_dir($directory)) {
            $this->files->makeDirectory($directory);
        }

        return $this->files->put($this->class_path, $content);

    }

    /**
     * @return int
     */
    public function makeView()
    {
        return $this->files->put($this->view_path, '');
    }


    /**
     * @param $name
     * @param $is_backend
     */
    public function setup($name, $is_backend)
    {
        $this->name = $name;
        $this->type = $is_backend ? 'Backend' : 'Frontend';

        $this->class_path = app_path('Widgets/' . $this->type . '/' . studly_case($name) . '.php');

        $this->view_path = config('view.paths')[0]
            . '/'
            . strtolower($this->type)
            . '/'
            . 'widgets'
            . '/'
            . $this->name . '.blade.php';

    }
}