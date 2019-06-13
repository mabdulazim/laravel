<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

// REQUESTS
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;

// REPOSITORIES
use App\Repositories\UserRepo;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepo $user)
    {
        // INITIATE USER REPO
        $this->user = $user;
        // AUTH MIDDLEWARE
        $this->middleware('auth');
        // PREMISSIONS MIDDLEWARE
        $this->middleware('permission:CREATE_USERS')->only(['create', 'store']);
        $this->middleware('permission:READ_USERS')->only('index');
        $this->middleware('permission:UPDATE_USERS')->only(['edit', 'update', 'block']);
        $this->middleware('permission:DELETE_USERS')->only('destroy');
    }

    public function index(Request $request)
    {
        $users = $this->user->filter($request->all());
        return view('user.index', compact('users'));
    }

    public function edit($id)
    {
        $user = $this->user->find($id);
        return view('user.edit', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserRequest $request)
    {        
        // INITIALIZATION
        $data = $request->all();
        $data['type'] = 'USER';

        // CREATE NEW USER 
        $this->user->create($data);

        // RETURN TO VIEW WITH SUCCESS MESSAGE
        return redirect('/users')->with(['success' => __('messages.has_been_created')]);
    }


    public function update(UserRequest $request, $id)
    {
        // INITIALIZATION
        $data = $request->password ? $request->all() : $request->except('password');

        // FIND THE USER
        $user = $this->user->find($id);

         // UPDATE USER DATA
        $user->update($data);

        // RETURN TO VIEW WITH SUCCESS MESSAGE
        return redirect('/users')->with(['success' => __('messages.has_been_updated')]);
    }

    public function destroy($id)
    {
        $user = $this->user->find($id);
        $user->delete();
        return redirect('/users')->with(['success' => __('messages.has_been_deleted')]);
    }

    public function block(Request $request, $id)
    {
        // FIND USER
        $user = $this->user->find($id);

        // UPDATE IS BLOCKED STATUS
        $user->is_blocked = $request->status;

        // SAVE CHANGES
        $user->save();

        // RETURN TO VIEW WITH SUCCESS MESSAGE
        $message = __($user->is_blocked == 1 ? 'messages.has_been_blocked' : 'messages.has_been_unblocked');
        return back()->with(['success' => $message]);
    }

}