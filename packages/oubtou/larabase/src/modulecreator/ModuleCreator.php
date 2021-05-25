<?php

namespace Oubtou\Larabase\ModuleCreator;

use Illuminate\Support\Facades\File;

class ModuleCreator
{
	public $name;
	public $description;
	public $fields;

	public $translation = "";
    public $migration = "";
	public $module = "";
	public $controller = "";
	public $route = "";
	public $views = "";

	public $templatesDir = __DIR__.'/templates/';


    public function __construct()
    {

    }

    public function migration(){
    	$controllerFile = File::get( __DIR__.'/templates/controller.php' );
    	$migrationFile = File::get( __DIR__.'/templates/migration.php' );
    	$moduleFile = File::get( __DIR__.'/templates/module.php' );
    	$routeFile = File::get( __DIR__.'/templates/route.php' );
    	
    	$listview = File::get( __DIR__.'/templates/views/list.blade.php' );
    	$updateview = File::get( __DIR__.'/templates/views/update.blade.php' );

    	if( !$migrationFile || !$moduleFile || !$routeFile || !$controllerFile || !$listview || !$updateview )
    		return false;

        $translate__ = "<?php \nreturn [\n";
        $translate__ .= "    'module_name'  => '".ucfirst($this->name)."',\n";
        $translate__ .= "    'list_'  => 'List of ".ucfirst($this->name)."s',\n";
        $translate__ .= "    '".$this->name."'  => '".ucfirst($this->name)."',\n";
        $translate__ .= "    '".$this->name."_create'  => 'Add ".ucfirst($this->name)."',\n";
        $translate__ .= "    '".$this->name."_edit'  => 'Edit ".ucfirst($this->name)."',\n";
        $translate__ .= "    '".$this->name."_show'  => 'Show ".ucfirst($this->name)."',\n";
        $translate__ .= "    'description'  => '".$this->description."',\n\n\n";

        $mgr_flds__ = '';

    	$mdl_flds__ = '';
    	$mdl_getters__ = '';

    	$cntrl_creation_fields__ = '';
    	$cntrl_update_fields__ = '';
    	$cntrl_filter_fields__ = '';
    	$view_update_fields__ = '';

    	foreach ($this->fields as $field) {
    		$field = (object) $field;

    		$translate__ .= "    '".$field->name."'  => '".$field->title."',\n";

            $mgr_flds__ .= '            $table->'.$field->type.'(\''.$field->name.'\')'.( isset($field->nullable) ? '->nullable()' : '' )."; \n";


    		$mdl_flds__ .= '\''. $field->name .'\',';
    		$mdl_getters__ .= "\n    public function get".$field->name.'(){ return $this->'.$field->name.'; }';


    		$cntrl_filter_fields__ .= "            '". $field->name ."'=>[ 'type'=>'text' ],\n";
    		$cntrl_creation_fields__ .= "            '". $field->name ."'=>request('". $field->name ."'),\n";
    		$cntrl_update_fields__ .= '        $'.$this->name.'->'. $field->name ."=request('". $field->name ."');\n";


			$view_update_fields__ .= "        <div class='col-md-6'> \n";
			$view_update_fields__ .= "          <div class='form-group'> \n";
			$view_update_fields__ .= "            <label class='form-label'>{{ __('".$this->name.".".$field->name."') }}</label> \n";
			$view_update_fields__ .= '            <input class="form-control" id="'.$field->name.'" name="'.$field->name.'" value="@if($object->id){{ $object->'.$field->name.' }}@else{{ old("'.$field->name.'") }}@endif" type="text" '. ( isset($field->nullable) ? 'required=""' : '' ) ." > \n";
			$view_update_fields__ .= "          </div> \n";
			$view_update_fields__ .= "        </div> \n";
    	}

    	// Create Translation File
        $translate__ .= "];";
        $this->translation = base_path().'/resources/lang/en/'.$this->name.'.php';
        File::put( $this->translation, $translate__ );


        // Create Migration File
    	$migrationFile= str_replace('__ModuleName__', ucfirst($this->name), $migrationFile);
    	$migrationFile= str_replace('__tableName__', $this->name.'s', $migrationFile);
    	$migrationFile= str_replace('__tableColumns__', $mgr_flds__, $migrationFile);
    	$this->migration = base_path().'/database/migrations/'.date('Y_m_d_His').'_create_'.$this->name.'s_table.php';
    	File::put( $this->migration, $migrationFile );

    	// Create Module File
    	$moduleFile= str_replace('__ModuleName__', ucfirst($this->name), $moduleFile);
    	$moduleFile= str_replace('__ModuleLower__', $this->name, $moduleFile);
    	$moduleFile= str_replace('__FillableFields__', $mdl_flds__, $moduleFile);
    	$moduleFile= str_replace('__Getters__', $mdl_getters__, $moduleFile);
    	$this->module = base_path().'/app/'.ucfirst($this->name).'.php';
    	File::put( $this->module, $moduleFile );

    	// Create Controller File
    	$controllerFile= str_replace('__Module__', ucfirst($this->name), $controllerFile);
    	$controllerFile= str_replace('__ModuleLower__', $this->name, $controllerFile);
    	$controllerFile= str_replace('__ModuleFilterField__', $cntrl_filter_fields__, $controllerFile);
    	$controllerFile= str_replace('__ModuleCreationFields__', $cntrl_creation_fields__, $controllerFile);
    	$controllerFile= str_replace('__ModuleUpdateFields__', $cntrl_update_fields__, $controllerFile);    	
    	$this->controller = base_path().'/app/Http/Controllers/'.ucfirst($this->name).'Controller.php';
    	File::put( $this->controller, $controllerFile );

    	// Create Route File
    	$routeFile= str_replace('__ModuleController__', ucfirst($this->name), $routeFile);
    	$routeFile= str_replace('__ModuleLower__', $this->name, $routeFile);
    	$this->route = base_path().'/routes/'.$this->name.'.php';
    	$webroute = File::get(  base_path().'/routes/web.php' );
        File::put( $this->route, $routeFile );
    	File::put( base_path().'/routes/web.php', $webroute."\ninclude '".$this->name.".php';" );

    	// Create Views Files

    	$this->views = base_path().'/resources/views/'.$this->name.'/';    	
    	
    	if( ! File::exists( $this->views ) )
    		File::makeDirectory( $this->views );

    	$updateview= str_replace('__ModuleLower__', $this->name, $updateview);
    	$updateview= str_replace('__ModuleFields__', $view_update_fields__, $updateview);

    	File::put( $this->views.'/list.blade.php', $listview);
    	File::put( $this->views.'/update.blade.php', $updateview);


    	return True;
    }

}
