<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $result = Post::query();

        if ($request->has('keywords') && $request->keywords != null) {
            $result->where('name', 'like', '%' . $request->keywords . '%')
                ->orWhere('product_code', 'like', '%' . $request->keywords . '%');
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
        $posts = $result->paginate(10);
        return view('admin.post.index', compact('posts'));
    }
    public function add()
    {
        return view('admin.post.add');
    }
    public function store(Request $request)
    {


        $validate = $request->validate([
            "title" => "required|unique:posts,title",
            "slug" => "required|unique:posts,slug",
            "description" => "required|max:255",
            "content" => "required",
            "tags" => "required",
            "cover" => "required"
        ], [
            "title.required" => "Vui lòng nhập trường này!",
            "slug.required" => "Vui lòng nhập trường này!",
            "description.required" => "Vui lòng nhập trường này!",
            "content.required" => "Vui lòng nhập trường này!",
            "tags.required" => "Vui lòng nhập trường này!",
            "cover.required" => "Vui lòng nhập trường này!",
            "title.unique" => "Tiêu đề đã được sử dụng",
            "slug.unique" => "Đường dẫn này đã được sử dụng",
            "description.max" => "Tối đa :max từ!",
        ]);
        if ($request->hasFile('cover')) {
            $path_img =  $request->file('cover')->store('public/photos/1');
            // Thay thế public thành storage trong chuỗi path
            $validate['cover'] = str_replace("public", getenv('APP_URL') . "/storage", $path_img);
        }
        $validate['user_id'] = Auth::user()->id;
        $check = Post::insert($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Thêm thành công');
        }
        return back()->with('msgError', 'Thêm thất bại!');
    }
    public function edit(Post $post)
    {
        return view('admin.post.edit', compact('post'));
    }
    public function update(Request $request, $id)
    {


        $validate = $request->validate([
            "title" => "required|unique:posts,title," . $id,
            "slug" => "required|unique:posts,slug," . $id,
            "description" => "required|max:255",
            "content" => "required",
            "tags" => "required",
            "cover" => "required"
        ], [
            "title.required" => "Vui lòng nhập trường này!",
            "slug.required" => "Vui lòng nhập trường này!",
            "description.required" => "Vui lòng nhập trường này!",
            "content.required" => "Vui lòng nhập trường này!",
            "tags.required" => "Vui lòng nhập trường này!",
            "cover.required" => "Vui lòng nhập trường này!",
            "title.unique" => "Tiêu đề đã được sử dụng",
            "slug.unique" => "Đường dẫn này đã được sử dụng",
            "description.max" => "Tối đa :max từ!",
        ]);
        if ($request->hasFile('cover')) {
            $path_img =  $request->file('cover')->store('public/photos/1');
            // Thay thế public thành storage trong chuỗi path
            $validate['cover'] = str_replace("public", getenv('APP_URL') . "/storage", $path_img);
        }
        $validate['user_id'] = Auth::user()->id;
        $check = Post::where('id', $id)->update($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Cập nhật thành công');
        }
        return back()->with('msgError', 'Cập nhật thất bại!');
    }
    public function softDelete($id)
    {
        $check =
            Post::destroy($id);
        if ($check) {
            return back()->with('msgSuccess', 'Đổi trạng thái thành công');
        }
        return back()->with('msgError', 'Đổi trạng thái thất bại!');
    }
    public function restore($id)
    {
        $check = Post::onlyTrashed()->where('id', $id)->restore();
        if ($check) {
            return back()->with('msgSuccess', 'Khôi phục dùng thành công');
        }
        return back()->with('msgError', 'Khôi phục dùng thất bại!');
    }
    public function forceDelete($id)
    {

        $check = Post::onlyTrashed()->where('id', $id)->forceDelete();
        if ($check) {
            return back()->with('msgSuccess', 'Xóa thành công');
        }
        return back()->with('msgError', 'Xóa thất bại!');
    }
}
