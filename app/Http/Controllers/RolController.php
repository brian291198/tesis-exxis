<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Agregamos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RolController extends Controller
{

  /*   function __construct() 
    {
        
        $this->middleware('permission:user.create', ['only'=>['create','store']]);
        $this->middleware('permission:user.edit', ['only'=>['edit','update']]);
        $this->middleware('permission:user.destroy', ['only'=>['destroy']]);
    
        $this->middleware('permission:role.create', ['only'=>['create','store']]); 
        $this->middleware('permission:role.edit', ['only'=>['edit','update']]);
        $this->middleware('permission:role.destroy', ['only'=>['destroy']]);
    } */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     const PAGINATION=5;
   /*   public function index(Request $request)
     {
         $buscarpor=trim($request->get('buscarpor'));
         $cliente=Cliente::where('nombre','LIKE','%'.$buscarpor.'%')
         ->paginate($this::PAGINATION);;
         //return $cliente;
         return view('clientes.index', compact('cliente'));
     } */

     public function index(Request $request)
    {
        //
        $buscarpor=trim($request->get('buscarpor'));
        $roles=Role::where('name','LIKE','%'.$buscarpor.'%')
        ->paginate($this::PAGINATION);
        //return $cliente;
        return view('roles.index', compact('roles'));
    }

   /*  public function index()
    {
        //
        $roles = Role::paginate(5);
        return view('roles.index',compact('roles'));
    } */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permission = Permission::get();
        return view('roles.crear',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $rules = [
            'name' => 'required',
            'permission' => 'array',
        ];
    
        // Definición de mensajes de error personalizados
        $messages = [
            'name.required' => 'El nombre del rol es obligatorio.',
           /*  'permission.required' => 'Debe seleccionar al menos un permiso para el rol.', */
            'permission.array' => 'Los permisos deben ser proporcionados en formato de array.',
        ];
    
        // Validación de los datos del formulario
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // Manejo de errores de validación
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
    
        // Creación del nuevo rol
        $role = Role::create([
            'name' => $request->input('name'),
        ]);
    
        // Sincronización de permisos asociados al rol
        $role->syncPermissions($request->input('permission'));

    /*     $permissionIds = $request->input('permission', []);
        $permissions = Permission::whereIn('id', $permissionIds)->pluck('name')->toArray();
    
        // Sincroniza los permisos con el rol
        $role->syncPermissions($permissions); */





    
        // Redirección a la vista de índice de roles
        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //usamos metodo pluck que recupera todos los valores de un id determinado
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
           ->pluck('role_has_permissions.permission_id')
           ->all();
           return view('roles.editar', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Definición de reglas de validación
    $rules = [
        'name' => 'required',
        'permission' => 'required|array',
    ];

    // Definición de mensajes de error personalizados
    $messages = [
        'name.required' => 'El nombre del rol es obligatorio.',
        'permission.required' => 'Debe seleccionar al menos un permiso para el rol.',
        'permission.array' => 'Los permisos deben ser proporcionados en formato de array.',
    ];

    // Validación de los datos del formulario
    $validator = Validator::make($request->all(), $rules, $messages);

    // Manejo de errores de validación
    if ($validator->fails()) {
        return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
    }

    // Actualización del rol existente
    $role = Role::find($id);
    if (!$role) {
        return redirect()->route('roles.index')->with('error', 'Rol no encontrado');
    }

    $role->name = $request->input('name');
    $role->save();

    // Sincronización de permisos asociados al rol
    $role->syncPermissions($request->input('permission'));

    // Redirección a la vista de índice de roles con mensaje de éxito
    return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::table('roles')->where('id',$id)->delete();
        return redirect()->route('roles.index');
    }
}
