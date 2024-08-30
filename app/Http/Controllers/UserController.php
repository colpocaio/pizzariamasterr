<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 * @author Vinícius Sarmento
 * @link https://github.com/ViniciusSCS
 * @date 2024-08-23 21:48:54
 * @copyright UniEVANGÉLICA
 */
class UserController extends Controller
{
    public function index()
    {
        $user = User::select('id', 'name', 'email')->paginate('2');

        return [
            'status' => 200,
            'mensagem' => 'Usuários encontrados.',
            'user' => $user
        ];
    }

    public function create()
    {

    }

    public function store(UserCreateRequest $request)
    {
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return [
            'status' => 200,
            'mensagem' => 'Usuário cadastrado com sucesso.',
            'user' => $user
        ];
    }

    public function show(string $id)
    {
        $user = User::find($id);

        return response()->json([
            'status' => 200,
            'user' => $user
        ]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        $data = $request->all();

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return response()->json([
            'status' => 200,
            'mensagem' => 'Usuário atualizado com sucesso.',
            'user' => $user
        ]);
    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->delete();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Usuário removido com sucesso.'
        ]);
    }
}

