<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    /**
     * Handle an incoming registration request.
     *
     * @param  \App\Http\Requests\Auth\RegisterRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request)
    {        
        $user_categories_id = $request->user_categories_id ? 1 : 2;

        if($user_categories_id === 1) {
            $exist = $this->duplicateCheck($request);
            if($exist === false) return back()->with('error', 'この挙式IDは既に使われております。');
        } else {
            
        }
        
        $user = User::create([
            'name' => $request->name,
            'kana' => $request->kana,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ceremonies_id' => $request->ceremonies_id,
            'is_answered' => 0,
            'user_categories_id' => $user_categories_id,
            'uuid'=> Str::uuid(),
        ]);

        event(new Registered($user));

        Auth::login($user);

        if($user['user_categories_id'] === 1) {
            User::Where('email', $request->email)->WHERE('ceremonies_id', $request->ceremonies_id)->update(['is_answered' => 1,]);
            return redirect('/admin');
        }
        if($user['user_categories_id'] === 2) return redirect('/guest');
    }

    
}
