<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class AuthorController extends Controller {
    
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:authors',                       
            'email' => 'required|email|unique:users',
            'pwd'   => 'required',
            'cpwd'  => 'required|same:pwd'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();

        $user = new User();
        $user->name = $input['name'];
        $user->password = Hash::make($input['pwd']);
        $user->email = $input['email'];

        $user->save();

        $user->addRole('author');

        $userAuthor = new Author();
        $userAuthor->name = $user->name;
        $userAuthor->save();

        $user->author()->associate($userAuthor);
        $userAuthor->user()->associate($user);

        $userAuthor->save();
        $user->save();
        
        $token = $user->createToken('author', ['author'])->plainTextToken;

        $user->save();

        return response()
            ->json([
                "name"  => $user->name,
                "token" => $token,
            ]);
    }

    public function get_token (Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'pwd' => 'required',
        ]);    
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
     
        $user = User::where('email', $request->email)->first();
     
        if (!$user || !Hash::check($request->pwd, $user->password) || !$user->hasRole('author')) {
            return response()->json(['error' => 'The provided credentials are incorrect or user is not author.'], 401);
        }
     
        return response()->json([
            'name'  => $user->name,
            'token' => $user->createToken('author', ['author'])->plainTextToken
        ]);
    }

    public function list (Request $request) {

        $authors = Author::paginate(3);

        return AuthorResource::collection($authors);
    }

    public function show (Request $request, int $id) {

        $author = Author::find($id);

        if (!$author) {
            return [
                'error' => 'author not found',
            ];
        }

        return [
            'id'    => $author->id,
            'name'  => $author->name,
            'books' => $author->books,
        ];
    }

    public function update (Request $request, int $id) {
    
        $author = Author::find($id);
    
        if (!$author) {
          return [
            'error' => 'author not found',
          ];
        }

        if (PersonalAccessToken::findToken($request->bearerToken())->tokenable->author != $author) {
            return [
                'error' => 'you are not selected author',
            ];
        }
    
        $validator = Validator::make($request->all(), [
          'name' => 'unique:authors, name, {$author->id}',
        ]);    
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $author->name = $request->name ? $request->name : $author->name;

        $author->save();

        return [
            'success' => 'author successfully updated',
        ];
    }
}
