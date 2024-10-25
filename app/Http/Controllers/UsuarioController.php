<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//Agregamos
use App\Http\Controllers\Controller;
use App\Models\User;
/* use App\Models\Advisor; */
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Request $request)
    {
        //User:all();
        $totalUsuarios = \App\Models\User::count();
        $buscarpor=trim($request->get('buscarpor'));
        $usuarios = User::where('name', 'LIKE', '%' . $buscarpor . '%')
                    ->orWhere('email', 'LIKE', '%' . $buscarpor . '%')
                    ->paginate(5);
        //return $cliente;
        return view('usuarios.index', compact('usuarios',  'totalUsuarios'));
     /*  esto va como codigo en la vista para la paginación
      {!! $usuarios->links() !!} */

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       $roles = Role::pluck('name','name')->all();
        return view('usuarios.crear',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validación
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|same:confirm-password',
        'roles' => 'required'
    ], [
        'name.required' => 'El nombre es obligatorio.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
        'email.unique' => 'El correo electrónico ya está registrado.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password.same' => 'La confirmación de la contraseña no coincide.',
        'roles.required' => 'Debe seleccionar al menos un rol.'
    ]);
    
    // Manejar errores de validación
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }
    
    // Crear el usuario
    $input = $request->all();
    $input['password'] = Hash::make($input['password']);

    // Guardar el usuario en la base de datos
    $user = User::create($input);

    // Asignar roles al usuario
    $roles = $request->input('roles');
    $user->assignRole($roles);

    // Verificar si el rol "Asesor" está en los roles asignados
   /*  if (in_array('Asesor', $roles)) {
        // Guardar en la tabla advisors
        Advisor::create([
            'user_id' => $user->id,
            'nombres' => $user->name,
            'email' => $user->email
        ]);
    } */

    // Redireccionar a la ruta de index de usuarios
    return redirect()->route('usuarios.index')->with('mensaje', 'Usuario creado exitosamente');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $usuario = [
            'nombre' => Auth::user()->name,
            'email' => Auth::user()->email,
        ];

        return view('usuarios.perfil', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

         // Buscar el usuario por su ID
    $user = User::find($id);

    // Verificar si el usuario existe
    if (!$user) {
        // Manejo de error si el usuario no existe
        return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado');
    }
 
   /*  // Obtener todos los roles disponibles
    $roles = Role::pluck('name', 'name')->all();

     // Obtener los roles del usuario actual
    $userRoles = $user->roles->pluck('name', 'name')->all();

    // Pasar los datos a la vista de edición
    return view('usuarios.editar', compact('user', 'roles', 'userRole'));  
    return view('usuarios.editar', compact('user', 'roles')); */

    $roles = Role::pluck('name', 'id')->all();
    $userRoles = $user->roles->pluck('id')->toArray();

    return view('usuarios.editar', compact('user', 'roles', 'userRoles'));
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
        //

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|min:8|same:confirm-password',
            'roles' => 'required'
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.same' => 'La confirmación de la contraseña no coincide.',
            'roles.required' => 'Debe seleccionar al menos un rol.'
        ]);
    
        // Manejar errores de validación
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        // Preparar los datos para actualizar
        $input = $request->except('_token', 'confirm-password');
        
        // Verificar si se proporcionó una nueva contraseña
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']); // Eliminar la contraseña si no se proporcionó
        }
    
        // Actualizar el usuario
        $user = User::findOrFail($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id')->delete();
        /* $user->update($input); */
    
      /*   // Actualizar roles del usuario
        DB::table('model_has_roles')->where('model_id', $id)->delete();
       /*  $user->assignRole($request->input('roles')); */
       /*  $user->syncRoles($request->input('roles', [])); */
        // Redireccionar a la lista de usuarios */


            // Aquí puedes usar $request->input('role_names') para obtener los nombres de los roles
        $roleNames = $request->input('roles', []);
        
        // Asignar los roles seleccionados al usuario
        // Aquí puedes realizar la lógica necesaria para manejar los roles por nombres
        // Esto puede implicar buscar los roles por nombre en tu base de datos y luego asignarlos al usuario
        foreach ($roleNames as $roleName) {
            $role = Role::where('name', $roleName)->first(); // Suponiendo que 'Role' sea tu modelo de Rol
            if ($role) {
                $user->assignRole($role); // Asignar el rol al usuario
            }
        }
   

   
  
        return redirect()->route('usuarios.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // Encuentra el usuario
    $user = User::findOrFail($id);
    
    // Elimina los asesores relacionados
    /* Advisor::where('user_id', $id)->delete(); */
    
    // Elimina el usuario
    $user->delete();

    return redirect()->route('usuarios.index')->with('mensaje', 'Usuario eliminado exitosamente');
    }
}
