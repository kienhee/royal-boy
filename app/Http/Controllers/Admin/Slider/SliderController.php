<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $sliders = Slider::orderBy('created_at', 'DESC')->withTrashed()->paginate(10);


        return view('admin.slider.index', compact('sliders'));
    }
    public function add()
    {
        return view('admin.slider.add');
    }
    public function store(Request $request)
    {


        $validate = $request->validate([
            'title' => 'required|max:50|unique:sliders,title',
            'category_id' => 'required|numeric',
            'description' => 'required|max:255',
            "image" => "required"
        ], [
            "title.required" => "Vui lòng nhập trường này",
            "title.unique" => "Tiêu đề này đã tồn tại!",
            "title.max" => "Tối đa :max kí tự",
            "description.max" => "Tối đa :max kí tự",
            "description.required" => "Vui lòng nhập trường này",
            "category_id.required" => "Vui lòng lựa chọn",
            "category_id.numeric" => "Giá trị phải là số",
            "image.required" => "Vui lòng thêm ảnh!",
        ]);
        if ($request->hasFile('image')) {
            $path_img =  $request->file('image')->store('public/photos/1');
            // Thay thế public thành storage trong chuỗi path
            $validate['image'] = str_replace("public", getenv('APP_URL') . "/storage", $path_img);
        }
        $check = Slider::insert($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Thêm thành công');
        }
        return back()->with('msgError', 'Thêm thất bại!');
    }
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }
    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'title' => 'required|max:50|unique:sliders,title,' . $id,
            'category_id' => 'required|numeric',
            'description' => 'required|max:255',
            "image" => "required"
        ], [
            "title.required" => "Vui lòng nhập trường này",
            "title.unique" => "Tiêu đề này đã tồn tại!",
            "title.max" => "Tối đa :max kí tự",
            "description.max" => "Tối đa :max kí tự",
            "description.required" => "Vui lòng nhập trường này",
            "category_id.required" => "Vui lòng lựa chọn",
            "category_id.numeric" => "Giá trị phải là số",
            "image.required" => "Vui lòng thêm ảnh!",
        ]);
        if ($request->hasFile('image')) {
            $path_img =  $request->file('image')->store('public/photos/1');
            // Thay thế public thành storage trong chuỗi path
            $validate['image'] = str_replace("public", getenv('APP_URL') . "/storage", $path_img);
        }
        $check = Slider::where('id', $id)->update($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Cập nhật thành công');
        }
        return back()->with('msgError', 'Cập nhật thất bại!');
    }
    public function softDelete($id)
    {
        $check =
            Slider::destroy($id);
        if ($check) {
            return back()->with('msgSuccess', 'Đổi trạng thái thành công');
        }
        return back()->with('msgError', 'Đổi trạng thái thất bại!');
    }
    public function restore($id)
    {
        $check = Slider::onlyTrashed()->where('id', $id)->restore();
        if ($check) {
            return back()->with('msgSuccess', 'Khôi phục dùng thành công');
        }
        return back()->with('msgError', 'Khôi phục dùng thất bại!');
    }
    public function forceDelete($id)
    {

        $check = Slider::onlyTrashed()->where('id', $id)->forceDelete();
        if ($check) {
            return back()->with('msgSuccess', 'Xóa thành công');
        }
        return back()->with('msgError', 'Xóa thất bại!');
    }
}
