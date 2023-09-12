<?php

namespace App\Http\Controllers\Admin\Size;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        return view('admin.size.index', compact('sizes'));
    }
    public function add()
    {
        return view('admin.size.add');
    }
    public function store(Request $request)
    {

        $validate = $request->validate([
            'name' => 'required|max:50|unique:sizes,name',
        ], [
            "name.required" => "Vui lòng nhập trường này",
            "name.unique" => "Tên này đã tồn tại!",
            "name.max" => "Tối đa :max kí tự",
        ]);

        $check = Size::insert($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Thêm thành công');
        }
        return back()->with('msgError', 'Thêm thất bại!');
    }
    public function edit(Size $size)
    {
        return view('admin.size.edit', compact('size'));
    }
    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'name' => 'required|max:50|unique:sizes,name,' . $id,
        ], [
            "name.required" => "Vui lòng nhập trường này",
            "name.unique" => "Tên này đã tồn tại!",
            "name.max" => "Tối đa :max kí tự",
        ]);

        $check = Size::where('id', $id)->update($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Thêm thành công');
        }
        return back()->with('msgError', 'Thêm thất bại!');
    }
    public function delete($id)
    {

        $check =
            Size::destroy($id);
        if ($check) {
            return back()->with('msgSuccess', 'Xóa thành công');
        }
        return back()->with('msgError', 'Xóa thất bại!');
    }
}
