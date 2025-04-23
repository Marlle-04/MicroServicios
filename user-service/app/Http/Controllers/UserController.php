<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validar la información recibida
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
    
        // Crear el usuario con los datos recibidos
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Encriptamos la contraseña
        $user->role = 'user'; // Se asigna el rol por defecto 'user'
        $user->save();
    
        // Retornar una respuesta exitosa
        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user'    => $user
        ], 201);
    }


    //funcion de login
    public function login(Request $request)
    {
        // Validar los datos del request
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string'
        ]);

        // Buscar al usuario por correo
        $user = User::where('email', $request->email)->first();

        // Verificar si el usuario existe y la contraseña es correcta
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        // Retornar respuesta exitosa
        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'user'    => $user
        ], 200);
    }

    // obtener un usuario 
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        return response()->json(['user' => $user], 200);
    }


    // funcion para actualizar perfil 
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Validación de datos. Se usa 'sometimes' para permitir enviar solo los campos que se desean actualizar.
        $data = $request->validate([
            'name'     => 'sometimes|required|string|max:255',
            'email'    => 'sometimes|required|email|unique:users,email,'.$id,
            'password' => 'sometimes|required|string|min:6',
        ]);

        // Si se envía una contraseña, se encripta antes de actualizar
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return response()->json([
            'message' => 'Usuario actualizado exitosamente',
            'user'    => $user
        ], 200);
    }

    // eliminar un usuario
    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado exitosamente'], 200);
    }


    // Cambiar el rol de un usuario
    public function updateRole(Request $request, $id)
    {
        // Validamos que se envíen los datos necesarios:
        $request->validate([
            'admin_id' => 'required|integer',
            'new_role' => 'required|string|in:admin,user',
        ]);
    
        // Buscar el usuario que se supone es admin
        $admin = User::find($request->admin_id);
        if (!$admin || $admin->role !== 'admin') {
            return response()->json(['message' => 'No autorizado: el usuario no es admin'], 403);
        }
    
        // Buscar el usuario cuyo rol se desea cambiar
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    
        // Actualizar el rol del usuario
        $user->role = $request->new_role;
        $user->save();
    
        return response()->json([
            'message' => 'Rol actualizado exitosamente',
            'user'    => $user
        ], 200);
    }
    




}    
