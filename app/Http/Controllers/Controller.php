<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public $model='';
    public $orderby='created_at';
    public $filter_action = "#";
    public $use_API = false;

    public function view_($template, $data=[]){
    	return ( $this->use_API ) ? $data : view($template, $data);
    }

    public function AsPdf($object,$filename,$view,$view_parames=[],$orientation='P',$mode='I'){
		$mpdf = new mPDF();

		$header_footer = ["header"=>'',"footer"=>''];

		if ( method_exists($object, 'pdf_initial_Header_Footer') ){
			$header_footer = $object->pdf_initial_Header_Footer();
		}
		
		$mpdf->initial_Header_Footer($header_footer['header'],$header_footer['footer']);

		$mpdf->autoScriptToLang = true;
		$mpdf->autoLangToFont = true;

		$mpdf->AddPage($orientation);

		$view_parames['object'] = $object;
		$view_parames['mpdf'] = $mpdf;
		$html = view($view, $view_parames)->render();

		$mpdf->WriteHTML($html);

		$mpdf->Output($filename.'_.pdf', $mode);
	}

    public function custom_input_filter(){
        return '';
    }
    
    public function filter_fields(){
        return [];
    }

    
    public function perpage(){
    	return ( request('perpage') ) ? (int) request('perpage') : 1;
    }

    public function onefrom2($first, $second){
    	return ( request($first) ) ? request($first) : request($second);
    }

    public function url_params($full = false,$params = []){
    	$path = request()->getPathInfo();
    	$withparams = request()->getRequestUri();

    	if( count($params) ){
    		if(!strpos($withparams,'?'))
    			$withparams = $withparams . '?';
    		foreach ($params as $key => $value){
    			if(!strpos($withparams, $key.'='))
    				$withparams = $withparams .'&'. $key."=".$value;
    			elseif($value != null){
    				$v = request($key);
    				$withparams = str_replace($key.'='.$v, $key."=".$value, $withparams);
    			}else{
    				$v = request($key);
    				$withparams = str_replace('?'.$key.'='.$v, '', $withparams);
    				$withparams = str_replace('&'.$key.'='.$v, '', $withparams);
    			}
    		}
    	}

    	if( $full )
    		return $withparams;

    	return str_replace($path, '', $withparams);
    }

    public function filter($form = true){

    	$customOptions = $this->filter_fields();

		$default_filter_options = [
			'text' => [
				'name' => '',
				'td-class' => 'w-auto',
				'operation' => 'like',
				'type' => '',
				'value' => '',
				'attributes' => 'class="input_filter_val"',
			],
			'hidden' => [
				'name' => '',
				'td-class' => 'w-auto',
				'operation' => 'like',
				'type' => '',
				'value' => '',
				'attributes' => 'class="input_filter_val"',
			],
			'datepicker' => [
				'name' => '',
				'td-class' => 'w-auto',
				'operation' => 'date-like',
				'type' => '',
				'value' => '',
				'attributes' => ' class="datepicker"',
			],
			'datetimepicker' => [
				'name' => '',
				'td-class' => 'w-auto',
				'operation' => 'date-time-like',
				'type' => '',
				'value' => '',
				'attributes' => ' class="datetimepicker"',
			],
			'number' => [
				'name' => '',
				'td-class' => 'w-auto',
				'operation' => '=',
				'type' => '',
				'value' => '',
				'attributes' => 'class="input_filter_val"',
			],
			'email' => [
				'name' => '',
				'td-class' => 'w-auto',
				'operation' => 'like',
				'type' => '',
				'value' => '',
				'attributes' => 'class="input_filter_val"',
			],
			'select' => [
				'name' => '',
				'td-class' => 'w-auto',
				'operation' => '=',
				'type' => '',
				'value' => '',
				'attributes' => '',
				'classes' => '',
				'data' => [],
				'optgroup'=>false,
	            'groupby' => 'id',
	            'distinct' => '',
				'one_empty' => 1,
	            'table' => 'groupes',
	            'join' => [],
	            'fields' => ['id as key_','name as value_'],
	            'where' => [],
	            'whereIn' => [],
			],
		];
		$filter = request('filter');

		global $html;
		$fields = [];
		$html = '';

		$html .= '<form action="'.$this->filter_action.'" method="GET" role="form" id="filterForm">';
		$html .= '<tr class="custom_filter table-active">';
		  $html .= '<th id="icon-filter" style="vertical-align: middle;"><i class="fa fa-filter" aria-hidden="true"></i></th>';

		foreach ($customOptions as $name=>$args) {
			if($args == null){
				$html .= '<th id="filter-'.$name.'" class="w-0"></th>';
				continue;
			}

			$type = $args['type'];

			if(!isset($args['value']) ){
				if( $filter != null && array_key_exists($name,$filter) )
					$args['value'] = $filter[$name]["value"];
				else
					$args['value'] = null;
			}

			$field = array_merge($default_filter_options[$type], $args);
			
		  	if(isset($field['value'])){
		  		switch ($field['operation']) {
		  			case null:
		  				break;
		  			case '=':
		  			case '!=':
		  			case '>':
		  			case '>=':
		  			case '<':
		  			case '<=':
		  				$fields[] = [ $name , $field['operation'], $field['value'] ];
		  				break;	
		  			case 'date-like':
		  				if( $field['value'] ){
			  				list($y,$m,$d) = explode('-', $field['value']);
			  				$fields[] = [ $name , 'like', '%'.$y.'-'.$m.'-'.$d.'%' ];
		  				}
		  				break;	
		  			case 'date-time-like':
		  				if( $field['value'] ){
			  				list($date,$time) = explode(' ', $field['value']);
			  				list($y,$m,$d) = explode('-', $date);
			  				list($hour,$min) = explode(':', $time);
			  				$fields[] = [ $name , 'like', '%'.$y.'-'.$m.'-'.$d.' '.$hour.'%' ];
			  				//$fields[] = [ $name , '<=', $y.'-'.$m.'-'.$d.' '.$hour.':'.$min ];
			  			}
		  				break;
		  			default:
		  				$fields[] = [ $name , $field['operation'], '%'.$field['value'].'%' ];
		  				break;
		  		}
		  	}

		  	if($form){	  		

			  	$html .= '<th id="filter-'.$name.'" class="'.$field['td-class'].'">';
			  
			      	$html .= '<input class="form-control p-1" type="hidden" name="filter['.$name.'][operation]" value="'.$field['operation'].'" >';

			      	switch ($type) {
			      		// case 'select':
			      		// 	$html .= '<select name="filter['.$name.'][value]" '.$field['attributes'].' >';

			      		// 		if( $field['one_empty'] )
			      		// 			$html .= '<option value=""></option>';

			      		// 		if( count($field['data']) ){

				      	// 			foreach ( $field['data'] as $key => $value) {
				      	// 				$selected = '';
				      	// 				if( isset($field['value']) and $field['value'] == $key)
				      	// 					$selected = 'selected="selected"';

				      	// 				$html .= '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
				      	// 			}
			      		// 		}
			      		// 		elseif($field['table']){
			      		// 			$data = \DB::table($field['table'])
			      		// 					->select($field['fields'])
			      		// 					->where( $field['where'] )
			      		// 					->get();

			      		// 			foreach ( $data as $d) {
			      		// 				$selected = '';
				      	// 				if( isset($field['value']) and $field['value'] == $d->key_)
				      	// 					$selected = 'selected="selected"';

				      	// 				$html .= '<option '.$selected.' value="'.$d->key_.'">'.$d->value_.'</option>';
				      	// 			}
			      		// 		}

			      		// 	$html .= '</select>';
			      		// 	break;
			      		case 'select':
			      			if($field['optgroup']){
				      			if($field['table']){
			      					$rowsdata = \DB::table($field['table'])
											->select($field['fields'][0],$field['fields'][1],$field['fields'][2]);
									if ($field['join']) {
										$rowsdata = $rowsdata->join($field['join'][0],$field['join'][1],'=',$field['join'][2]);
									}
									$rowsdata = $rowsdata->where( $field['where'] )->get();
									if($rowsdata->isNotEmpty()){
										foreach ($rowsdata as $rd) {
											$data[$rd->key_][$rd->value2_]=$rd->value_;
										}
										$html .= '<select name="filter['.$name.'][value]" '.$field['attributes'].' >';

					      				if( $field['one_empty'] )
					      					$html .= '<option value=""></option>';

				      					foreach ( $data as $d=>$value) {
				      						$html .='<optgroup label="'.$d.'">';
				      						foreach($value as $id=>$obj){
					      						$field['value']=$obj;
					      						$field['id']=$id;
					      						$selected = '';

					       						if(isset($field['id']) and $field['id'] == $filter['lieu']['value'])
					      							$selected = 'selected="selected"';

				      							$html .= '<option '.$selected.' value="'.$id.'">'.$obj.'</option>';
				      						}
					      					$html .= '</optgroup>';
					      				}
					      				$html .= '</select>';
			      					}
								}
				      			break;
				      		}else
				      			$html .= '<select class="'.$field['classes'].'" name="filter['.$name.'][value]" '.$field['attributes'].' >';

			      				if( $field['one_empty'] )
			      					$html .= '<option value=""></option>';

			      				if( count($field['data']) ){

				      				foreach ( $field['data'] as $key => $value) {
				      					$selected = '';
				      					if( isset($field['value']) and $field['value'] == $key)
				      						$selected = 'selected="selected"';

				      					$html .= '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
				      				}
			      				}
			      				elseif($field['table']){

			      					$data = \DB::table($field['table'])
											->select($field['fields']);
									if ($field['join']) {
										$data = $data->join($field['join'][0],$field['join'][1],'=',$field['join'][2]);
									}
									if ($field['distinct']) {
										$data = $data->distinct($field['distinct']);
									}
									if( $field['whereIn'] ){
										$data = $data->whereIn( 
											$field['whereIn'][0],
											$field['whereIn'][1] 
										);
									}
									$data = $data->where( $field['where'] )->get();

			      					// $data = \DB::table($field['table'])
			      					// 		->select(\DB::raw("CONCAT(firstname,lastname) as value_"))
			      					// 		//->where( $field['where'] )
			      					// 		->Where(\DB::raw("CONCAT(firstname,lastname) as value_"), 'LIKE', "%"."stag"."%")
			      					// 		->get();

			      					foreach ( $data as $d) {
			      						$selected = '';
				      					if( isset($field['value']) and $field['value'] == $d->key_)
				      						$selected = 'selected="selected"';

				      					$html .= '<option '.$selected.' value="'.$d->key_.'">'.$d->value_.'</option>';
				      				}
			      				}

			      			$html .= '</select>';
			      			break;

			      		case 'datepicker':
			      			$html .= '<input class="form-control p-1 w-auto input_filter_val datepicker" type="date" name="filter['.$name.'][value]" '.$field['attributes'].' value="'.$field['value'].'" style="text-align:center;">';
			      			break;
			      		case 'datetimepicker':
			      			$html .= '<input class="form-control p-1 w-auto input_filter_val datetimepicker" type="text" name="filter['.$name.'][value]" '.$field['attributes'].' value="'.$field['value'].'" style="text-align:center;">';
			      			break;
			      		case 'number':
			      			$html .= '<input class="form-control p-1" type="'.$type.'" step="0.01"  name="filter['.$name.'][value]" '.$field['attributes'].' value="'.$field['value'].'" >';
			      			break;
			      			

			      		default:
			      			$html .= '<input class="form-control p-1" type="'.$type.'"  name="filter['.$name.'][value]" '.$field['attributes'].' value="'.$field['value'].'" >';
			      			break;
			      	}

			  	$html .= '</th>';
		  	}
		}


		$html .= '<th class="button_actions text-center mt-0 p-0" style="width: 100px;vertical-align: middle;">';
			$html .= $this->custom_input_filter();
			$html .= '<input class="form-control p-1" type="hidden" name="page" id="page" value="'.request('page').'">';
			$html .= '<input class="form-control p-1" type="hidden" name="perpage" id="perpage" value="'.request('perpage').'">';
			$html .= '<button type="submit" class="btn btn-outline-secondary submit_filter">';
			  $html .= '<i class="fa fa-search" aria-hidden="true"></i>';
			$html .= '</button>';
			$html .= '<a class="btn btn-outline-secondary ms-2 remove_filter" href="?filters=reset">';
			  $html .= '<i class="fa fa-times" aria-hidden="true"></i>';
			$html .= '</a>';
		$html .= '</th>';
		$html .= '</tr>';
		$html .= '</form>';

		if($form){
			$object = (object) [
				'filter' => $html,
				'model' => $this->model,
				'fields' => $customOptions,
			];
			return $object;
		}
		else{
			return $fields;
		}
    }


    public function slugify($table, $column, $string, $separator = '-') {
        $string = trim(substr($string,0,99));
        $string = mb_strtolower($string, 'UTF-8');

        // Make alphanumeric (removes all other characters)
        // this makes the string safe especially when used as a part of a URL
        // this keeps latin characters and Persian characters as well
        //$string = preg_replace("/[^a-z0-9_\s-اآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهی]/u", '', $string);

        // Make alphanumeric (removes all other characters)
        // this makes the string safe especially when used as a part of a URL
        // this keeps latin characters and Persian characters as well
        //$string = preg_replace("/[^a-z0-9_\s-يةءاآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهی]/u", '', $string);

        $string = preg_replace('/[^أ-يA-Za-z0-9 ]/ui', '', $string);
        // Remove multiple dashes or whitespaces or underscores
        //$string = preg_replace("/[\s-_]+/", ' ', $string);

        // Convert whitespaces and underscore to the given separator
        $string = preg_replace("/[\s_]/", $separator, $string);

        return $this->checkguidifexist( $table, $column, $string );
    }

    public function checkguidifexist($table, $column, $string, $count = 0) {
        if( $count )
            $newString = $string.'-'.$count;
        else
            $newString = $string;

        $psts = \DB::table($table)->where($column,'=',$newString)->get();

        if( count($psts) ){
            $cnt = ( $count ) ? $count + 1 : count($psts);
            return $this->checkguidifexist($string, $cnt);
        }

        return $newString;
    }
}
