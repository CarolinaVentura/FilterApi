<?php

namespace App\Http\Controllers;

use App\Ingredient;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Validation\Rules\In;

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
        $users = User::All();
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {

    }*/


    public function store(UserStoreRequest $request)
    {
//
        $data=$request->only('name', 'email','password', 'profile_image', 'ingredient_id', 'product_id');
        if(!$request->file(['profile_image'])){
            $data['profile_image']='userImages/default.png';
        } else {
            $path = $request->file('profile_image')->store('userImages', 'public');
            $data['profile_image'] = $path;
        }

        $data['password']=bcrypt($data['password']);
        $user=\App\User::create($data);


        $array = $data['ingredient_id'];
        $arrayProducts = $data['product_id'];

        $ingredients = Ingredient::find($array);
        $user->ingredients()->sync($ingredients);

        $products = Product::find($arrayProducts);
        $user->products()->sync($products);


        return response ([
            'status'=> '201',
            'msg'=>'Utilizador criado',
            'data'=>$user
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data= $request -> only(['name', 'email', 'password', 'profile_image', 'ingredient_id', 'product_id']);
        $path = $request->file('profile_image')->store('userImages', 'public');
        $data['profile_image'] = $path;

        //verificar se o campo titulo,data e descricao foram preenchidos
        if($request->only(['name'])){
            $user->name=$data['name'];
        }
        if($request->only(['email'])){
            $user->email=$data['email'];
        }
        if($request->only(['password'])){
            $user->password=bcrypt($data['password']);
        }
        if($request->only(['ingredient_id'])){
            $user->ingredient_id=$data['ingredient_id'];
        }
        if($request->only(['product_id'])){
            $user->product_id=$data['product_id'];
        }
        if($request->file(['profile_image'])){
            $user->profile_image=$data['profile_image'];
        }

        $user->save();

        return response ([
            'status'=> '200',
            'data'=>$user,
            'msg'=>'Alteração guardada com sucesso',
        ], 200);

    }



    public function destroy(User $user)
    {
        $user->delete();
        return response ([
            'status'=>200,
            'data'=>$user,
            'msg'=>'Utilizador eliminado'
        ],200);
    }

    public function showIngredients(User $user){


        $user_id = $user['id'];

        $ingredients = User::find($user_id)->ingredients()->orderBy('name')->get();



        return response ([
            'status'=>200,
            'data'=>$ingredients,
            'msg'=>'MERDA PA ISTO TUDO'
        ],200);
    }

    public function showProducts(User $user){


        $user_id = $user['id'];

        $products = User::find($user_id)->products()->orderBy('name')->get();



        return response ([
            'status'=>200,
            'data'=>$products,
            'msg'=>'MERDA PA ISTO TUDO'
        ],200);
    }

    public function alterarUser(UserUpdateRequest $request, User $user) {
        $data= $request -> only(['name', 'email', 'password', 'profile_image', 'ingredient_id', 'product_id']);
        $path = $request->file('profile_image')->store('userImages', 'public');
        $data['profile_image'] = $path;

        //verificar se o campo titulo,data e descricao foram preenchidos
        if($request->only(['name'])){
            $user->name=$data['name'];
        }
        if($request->only(['email'])){
            $user->email=$data['email'];
        }
        if($request->only(['password'])){
            $user->password=bcrypt($data['password']);
        }
        if($request->only(['ingredient_id'])){
            $user->ingredient_id=$data['ingredient_id'];
        }
        if($request->only(['product_id'])){
            $user->product_id=$data['product_id'];
        }
        if($request->file(['profile_image'])){
            $user->profile_image=$data['profile_image'];
        }

        /*$user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->profile_image=$data['profile_image'];
        $user->ingredient_id=$data['ingredient_id'];
        $user->product_id=$data['product_id'];*/

        $user->save();

        return response ([
            'status'=> '200',
            'data'=>$user,
            'msg'=>'Alteração guardada com sucesso',
        ], 200);
    }
}
