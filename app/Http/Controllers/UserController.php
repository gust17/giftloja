<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Nette\Utils\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'Cadastrar usuário';
        return view('users.cad_usuario', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valida = $this->validate($request, [
            'cpf' => 'required|cpf|unique:users',
        ]);
        $cpf = preg_replace('/[^0-9]/', '', $request->cpf);
        $telefone = preg_replace('/[^0-9]/', '', $request->telefone);
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'login' => $cpf,
                'password' => bcrypt($cpf),
                'cpf' => $cpf,
                'telefone' => $telefone
            ]);
            return redirect()->back()->with('success', 'usuário salvo com sucesso');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $page = "Editar Usuario";
        return view('users.edit', compact('user', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $request['password'] = bcrypt($request['password']);
        $user->update($request->all());

        return redirect()->back()->with('success', 'Usuario Atualizado com Sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function cropImageUploadAjax(Request $request)
    {


        $folderPath = public_path('upload/');

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';

        $imageFullPath = $folderPath . $imageName;

        file_put_contents($imageFullPath, $image_base64);

        $saveFile = User::find($request->user);

        if ($saveFile->img) {
            unlink('upload/' . $saveFile->img);
        }
        $saveFile->img = $imageName;
        $saveFile->save();

        return response()->json(['success' => 'Imagem salva com sucesso']);

    }

    public function novasenha(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword()],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => bcrypt($request->new_password)]);

        return redirect()->back()->with('success', 'Senha alterada com sucesso');

    }

    public function disableUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_enabled = false;
        $user->save();
        return redirect()->back()->with('message', 'Usuário desabilitado com sucesso.');
    }

}
