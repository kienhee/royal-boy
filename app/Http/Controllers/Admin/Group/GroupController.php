<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all();
        return view('admin.group.index', compact('groups'));
    }

    public function add()
    {
        return view('admin.group.add');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:50',
        ], [
            'name.max' => 'Tối đa :max kí tự',
            'name.required' => 'Vui lòng nhập tên nhóm',
        ]);

        $check = Group::insert($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Thêm nhóm thành công');
        }
        return back()->with('msgError', 'Thêm nhóm thất bại!');
    }

    public function edit(Group $group)
    {
        return view('admin.group.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required|max:50',
        ], [
            'name.max' => 'Tối đa :max kí tự',
            'name.required' => 'Vui lòng nhập tên nhóm',
        ]);

        $check = Group::where('id', $id)->update($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Cập nhật thành công');
        }
        return back()->with('msgError', 'Cập nhật thất bại!');
    }

    public function delete($id)
    {
        $CheckUserExists = User::where('group_id', $id)->get();
        if ($CheckUserExists->count() > 0) {
            return back()->with('msgError', 'Còn ' . $CheckUserExists->count() . ' người dùng trong nhóm , không thể xóa');
        }
        $check =
            Group::destroy($id);
        if ($check) {
            return back()->with('msgSuccess', 'Xóa thành công');
        }
        return back()->with('msgError', 'Xóa thất bại!');
    }

    public function permissions(Group $group)
    {
        $roleArr = [
            'view' => 'Xem',
            'add' => 'Thêm',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
        ];
        $modules = Module::all();

        $roleJson = json_decode($group->permissions, true);
        if (!empty($roleJson)) {
            $roleData = $roleJson;
        } else {
            $roleData = [];
        }
        return view('admin.group.permission', compact('group', 'roleArr', 'modules', 'roleData'));
    }

    public function postPermissions(Request $request, $id)
    {
        if (!empty($request->role)) {
            $roleJson = json_encode($request->role);
        } else {
            $roleJson = [];
        }
        $check = Group::where('id', $id)->update(['permissions' => $roleJson]);
        if ($check) {
            return back()->with('msgSuccess', 'Phân quyền thành công');
        }
        return back()->with('msgError', 'Phân quyền thất bại!');
    }
}
