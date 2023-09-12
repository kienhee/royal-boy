<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $result = User::query();

        if ($request->has('keywords') && $request->keywords != null) {
            $result->where('full_name', 'like', '%' . $request->keywords . '%')
                ->orWhere('email', 'like', '%' . $request->keywords . '%')
                ->orWhere('phone_number', 'like', '%' . $request->keywords . '%');
        }

        if ($request->has('group_id') && $request->group_id != null) {
            $result->where('group_id', $request->group_id);
        }
        if ($request->has('sort') && $request->sort != null) {
            $result->orderBy('created_at', $request->sort);
        } else {
            $result->orderBy('created_at', 'desc');
        }
        if ($request->has('status') && $request->status != null && $request->status == 'active') {
            $result->where('deleted_at', "=", null);
        } elseif ($request->has('status') && $request->status != null && $request->status == 'inactive') {
            $result->onlyTrashed();
        } else {
            $result->withTrashed();
        }
        $users = $result->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function add()
    {
        return view('admin.user.add');
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'full_name' => 'required|max:50',
            'group_id' => 'required|numeric',
            'phone_number' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ], [
            "full_name.required" => "Vui lòng nhập trường này",
            "group_id.required" => "Vui lòng thêm nhóm quyền",
            "phone_number.numeric" => "Vui lòng nhập đúng định dạng",
            "phone_number.required" => "Vui lòng thêm nhóm quyền",
            "group_id.numeric" => "Giá trị phải là số",
            "full_name.max" => "Tối đa :max kí tự",
            "email.required" => "Vui lòng nhập email",
            "email.email" => "Vui lòng nhập đúng định dạng",
            "email.unique" => "Email này đã được sử dụng",
            "password.required" => "Vui lòng nhập mật khẩu",
            "password.min" => "Mật khẩu phải lớn hơn hoặc bằng :min kí tự",
            "password.confirmed" => "Xác nhận trường mật khẩu không khớp.",
            "password_confirmation.required" => "Vui lòng xác nhận mật khẩu",
            "password_confirmation.min" => "Mật khẩu phải lớn hơn hoặc bằng :min kí tự",

        ]);
        $validate['password'] = Hash::make($validate['password']);

        unset($validate['password_confirmation']);
        $check = User::insert($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Thêm thành viên thành công');
        }
        return back()->with('msgError', 'Thêm thành viên thất bại!');
    }
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        if (Auth::user()->id != $id) {
            return abort(401);
        }
        $validate = $request->validate([
            'full_name' => 'required|max:50',
            'group_id' => 'required|numeric',
            'phone_number' => 'required|numeric',
            'avatar' =>  'image'
        ], [
            "full_name.required" => "Vui lòng nhập trường này",
            "group_id.required" => "Vui lòng thêm nhóm quyền",
            "phone_number.numeric" => "Vui lòng nhập đúng định dạng",
            "phone_number.required" => "Vui lòng thêm nhóm quyền",
            "group_id.numeric" => "Giá trị phải là số",
            "password.required" => "Vui lòng nhập mật khẩu",
            "password.min" => "Mật khẩu phải lớn hơn hoặc bằng :min kí tự",
            "password.confirmed" => "Xác nhận trường mật khẩu không khớp.",
            "password_confirmation.required" => "Vui lòng xác nhận mật khẩu",
            "password_confirmation.min" => "Mật khẩu phải lớn hơn hoặc bằng :min kí tự",
            "avatar.image" => "Vui lòng chọn đúng định dạng ảnh!",

        ]);
        if ($request->hasFile('avatar')) {
            $path_img =  $request->file('avatar')->store('public/photos/1/profile');
            // Thay thế public thành storage trong chuỗi path
            $validate['avatar'] = str_replace("public", getenv('APP_URL') . "/storage", $path_img);
        }
        $check = User::where('id', $id)->update($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Cập nhật thành công');
        }
        return back()->with('msgError', 'Cập nhật thất bại!');
    }
    public function softDelete($id)
    {
        $check =
            User::destroy($id);
        if ($check) {
            return back()->with('msgSuccess', 'Đổi trạng thái thành công');
        }
        return back()->with('msgError', 'Đổi trạng thái thất bại!');
    }
    public function restore($id)
    {
        $check = User::onlyTrashed()->where('id', $id)->restore();
        if ($check) {
            return back()->with('msgSuccess', 'Khôi phục dùng thành công');
        }
        return back()->with('msgError', 'Khôi phục dùng thất bại!');
    }
    public function forceDelete($id)
    {
        if (Auth::user()->id != $id) {
            return abort(401);
        }
        $check = User::onlyTrashed()->where('id', $id)->forceDelete();
        if ($check) {
            return back()->with('msgSuccess', 'Xóa người dùng thành công');
        }
        return back()->with('msgError', 'Xóa người dùng thất bại!');
    }
    public function AccountSetting()
    {
        return view('admin.user.Account');
    }
}