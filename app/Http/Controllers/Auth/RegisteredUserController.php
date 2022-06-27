<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

//TODO:１つのアカウントで複数の挙式に参加できる設計にするべき
//　方法：DBにもう1レコード追加する
//  1：[Guest]ログイン後画面に[別の挙式に参加する]ButtonForm[ceremonies_id]
//  2：本人確認として[name, kana, email, password]
//  3：一致していれば登録 してなければエラー表示
//  4：ログアウト下に[挙式を切り替える]メニュー

class RegisteredUserController extends Controller
{
    const ADMIN_AMOUNT_LIMIT_IN_ONE_CEREMONY = 1; //1挙式に対してAdminユーザーはひとつとする

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }
    public function createOrganizer() {
        return view('auth.register-organizer');
    }
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // TODO:Adminユーザーの登録画面作成（user_categories_id = 1のもの）
        
        $user_categories_id = $request->user_categories_id ? 1 : 2;

        $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'kana'                  => ['required', 'string', 'min:2', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'              => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required'],
            'ceremonies_id'         => ['required', 'string', 'min:8', 'max:50'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'kana' => $request->kana,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ceremonies_id' => $request->ceremonies_id,
            'user_categories_id' => $user_categories_id,
            'uuid'=> Str::uuid(),
        ]);

        event(new Registered($user));

        Auth::login($user);

        if($user['user_categories_id'] === 1) return redirect('/admin');
        if($user['user_categories_id'] === 2) return redirect('/guest');
    }

    /**
     * 背景：同一挙式IDでのAdminユーザーの作成を禁止する
     * 対策：二重チェックを行う
     * @param Request
     * @return boolean
     */
    public function duplicateCheck(Request $request){
        $adminWithSameIdCount = User::WHERE('ceremonies_id', $request->get('ceremonies_id'))->first();

        if($adminWithSameIdCount) return false;
        return true;
    }
}
