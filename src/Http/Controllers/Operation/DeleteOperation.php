<?php


namespace Tessa\Admin\Http\Controllers\Operation;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

trait DeleteOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $route_name  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected static function setupDeleteRoutes($segment, $route_name, $controller)
    {
        Route::post($segment.'/delete', [
            'as'        => $route_name.'.delete',
            'uses'      => $controller.'@delete',
            'operation' => 'delete',
        ]);
    }

    protected function setupDeleteDefault() {
        $this->crud->allowAccess('delete');
    
        $this->crud->addButton([
            'stack' => 'line',
            'view' => 'view',
            'name' => 'delete',
            'content' => 'crud::buttons.delete',
        ]);
    }

    public function setupDeleteOperation() {
        //
    }
    
    public function delete($id) {

        if ($this->crud->delete($id)) {
            return response()->json(['message' => 'OK'], 200);
        } else {
            return response()->json(['message' => 'Fail'], 500);
        }
    }


}