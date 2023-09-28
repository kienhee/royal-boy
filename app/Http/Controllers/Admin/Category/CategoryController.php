<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $result = Category::query();

        if ($request->has('keywords') && $request->keywords != null) {
            $result->where('name', 'like', '%' . $request->keywords . '%');
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
        $categories = $result->paginate(10);
        return view('admin.category.index', compact('categories'));
    }
    public function add()
    {
        return view('admin.category.add');
    }
    public function store(Request $request)
    {


        $validate = $request->validate([
            'name' => 'required|max:50|unique:categories,name',
            'slug' => 'required|unique:categories,slug',
            'category_id' => 'required|numeric',
            'description' => 'max:255',
        ], [
            "name.required" => "Vui lòng nhập trường này",
            "name.unique" => "Tên này đã tồn tại!",
            "name.max" => "Tối đa :max kí tự",
            "description.max" => "Tối đa :max kí tự",
            "slug.required" => "Vui lòng thêm đường dẫn",
            "slug.unique" => "Đường dẫn này đã tồn tại!",
            "category_id.required" => "Vui lòng lựa chọn",
            "category_id.numeric" => "Giá trị phải là số",
        ]);

        $check = Category::insert($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Thêm thành công');
        }
        return back()->with('msgError', 'Thêm thất bại!');
    }
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'name' => 'required|max:50|unique:categories,name,' . $id,
            'slug' => 'required|unique:categories,slug,' . $id,
            'category_id' => 'required|numeric',
            'description' => '',
        ], [
            "name.required" => "Vui lòng nhập trường này",
            "name.unique" => "Tên này đã tồn tại!",
            "name.max" => "Tối đa :max kí tự",
            "slug.required" => "Vui lòng thêm đường dẫn",
            "slug.unique" => "Đường dẫn này đã tồn tại!",
            "category_id.required" => "Vui lòng lựa chọn",
            "category_id.numeric" => "Giá trị phải là số",
        ]);
        $check = Category::where('id', $id)->update($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Cập nhật thành công');
        }
        return back()->with('msgError', 'Cập nhật thất bại!');
    }
    public function softDelete($id)
    {
        $check =
            Category::destroy($id);
        if ($check) {
            return back()->with('msgSuccess', 'Đổi trạng thái thành công');
        }
        return back()->with('msgError', 'Đổi trạng thái thất bại!');
    }
    public function restore($id)
    {
        $check = Category::onlyTrashed()->where('id', $id)->restore();
        if ($check) {
            return back()->with('msgSuccess', 'Khôi phục dùng thành công');
        }
        return back()->with('msgError', 'Khôi phục dùng thất bại!');
    }
    public function forceDelete($id)
    {
        $CheckProductExists = Product::where('category_id', $id)->get();
        if ($CheckProductExists->count() > 0) {
            return back()->with('msgError', 'Còn ' . $CheckProductExists->count() . ' sản phẩm trong bộ sưu tập , không thể xóa');
        }
        $check = Category::onlyTrashed()->where('id', $id)->forceDelete();
        if ($check) {
            return back()->with('msgSuccess', 'Xóa thành công');
        }
        return back()->with('msgError', 'Xóa thất bại!');
    }
}
