<?php

function title(){
	return '';

    $controller = Request::route()->controller;
    $model = $controller->model;
    if($model){
	    $currentAction = Request::route()->action['as'];
	    return ucfirst(__($controller->model.'.'.$currentAction));
    }

	return '';
}


function isGranted($role){
	return auth()->user()->isGranted($role);
}

function list_actions($object){
	
	$class = get_class($object);
	$path = explode('\\', $class);
    $object_class = array_pop($path);

    $_class_upper = strtoupper($object_class);
    $_class_lower = strtolower($object_class);

	$html = '';
	
	if( method_exists($object, 'list_actions') ){
            $html .= $object->list_actions();
        }

	// if( isGranted('ROLE_'.$_class_upper.'_SHOW') )
	// 	$html .= '<a href="'.route($_class_lower.'_show',$object->id).'" class="icon pl-3"><i class="fa fa-eye"></i></a>';
	
	if( isGranted($_class_lower) && Route::has($_class_lower.'_edit',$object->id) )
		$html .= '<a href="'.route($_class_lower.'_edit',$object->id).'" class="btn btn-sm"><i class="fa fa-edit"></i></a>';
	
	if( isGranted($_class_lower) && Route::has($_class_lower.'_delete',$object->id) )
		$html .= '<a href="'.route($_class_lower.'_delete',$object->id).'"  type="button" data-toggle="modal" data-target="#confirmdelete" class="delete_btn btn btn-sm ms-2"><i class="fa fa-trash"></i></a>';

	return $html;
}

function update_actions($object=null){
	

	$html = '<div class="text-center mt-3">';
	$html .= '<button type="submit" class="primary-btn fix-gr-bg submit" id="submit" value="submit">'.__('global.submit') .'</button>';

	$_class_lower = null;

	if( $object ){
		$class = get_class($object);
		$path = explode('\\', $class);
	    $object_class = array_pop($path);

	    $_class_upper = strtoupper($object_class);
	    $_class_lower = strtolower($object_class);

	}
	
	if( $_class_lower and isGranted($_class_lower) )
		$html .= '&nbsp;&nbsp;&nbsp;<a id="list_btn" class="btn primary-btn  submit" href="'.route(strtolower($object_class)) .'"> <i class="fa fa-ban"></i>&nbsp; '. __('global.cancel') .'</a>';

	$html .= '</div>';
	return $html;
}

function base_list($results){

	$controller = Request::route()->controller;
	$f = $controller->filter();

	$fields = $f->fields;
	$filter = $f->filter;
	$model = $f->model;



$html ='<section class="admin-visitor-area up_st_admin_visitor">';
    $html .='<div class="container-fluid p-0">';
        $html .='<div class="row justify-content-center">';
                $html .='<div class="col-12">';
                    $html .='<div class="box_header common_table_header xs_mb_0">';
                        $html .='<div class="main-title d-md-flex">';
                            $html .='<h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">'.__(strtolower($model).'.list_').'</h3>';
                            $html .='<ul class="d-flex">';

                            if( isGranted($model) && Route::has(strtolower($model)."_create") )
                                $html .='<li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="'.route(strtolower($model)."_create").'"><i class="fa fa-plus"></i>'. __('global.add').'</a></li>';

                            $html .='</ul>';
                        $html .='</div>';
                    $html .='</div>';
                $html .='</div>';
                $html .='<div class="col-lg-12">';
                    $html .='<div class="QA_section QA_section_heading_custom check_box_table">';
                        $html .='<div class="QA_table ">';
                            $html .='<!-- table-responsive -->';
                            $html .='<div class="">';
                                $html .='<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">';

                                    $html .='<table class="table Crm_table_active3 dataTable no-footer dtr-inline">';
                                        $html .='<thead>';
                                            $html .='<tr role="row">';
								              		$html .= '<th class="text-center w-1">#</th>';
								              		foreach ($fields as $key => $value) {
								              			$html .= '<th class="text-center">'.__($model.'.'.$key).'</th>';
								              		}
								              		$html .= '<th>'.__('global.actions').'</th>';
                                            $html .='</tr>';
                                        $html .='</thead>';
                                        $html .='<tbody>';
							          		foreach ($results as $object ) {
									            $html .= '<tr>';
									            	$html .= '<td>'.$object->id.'</td>';
								              		foreach ($fields as $key => $value) {
								              			$geter = 'get'.$key;
										            	$html .= '<td class="td-'.$key.'">'.$object->$geter().'</td>';
								              		}
								              		
								              		$html .= '<td class="text-center table-action">';
								              			$html .= list_actions($object);
							                        $html .= '</td>';
									            $html .= '</tr>';
						              		}
                                        $html .='</tbody>';
                                    $html .='</table>';
                                $html .='<div class="row" > <div class="dt_infos col-md-6">';
						            if($results) 
						            	$html .=  __('global.pages_list',[
						                  'current'=> $results->currentPage(),
						                  'length'=> $results->lastPage(),
						                  'total'=> $results->total(),
						                  'module'=>__($model.'.'.$model)
						                ]);
                                $html .='</div>';
                                $html .='<div class="dt_paginate col-md-6">';
                                    $html .= $results->links();
                                $html .='</div></div>';
                            $html .='</div>';
                        $html .='</div>';
                    $html .='</div>';
                $html .='</div>';
            $html .='</div>';
        $html .='</div>';
    $html .='</div>';
$html .='</section>';


	echo $html;
}