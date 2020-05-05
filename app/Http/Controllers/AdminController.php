<?php

namespace App\Http\Controllers;

use App\Category;
use App\Status;
use App\User;
use App\VueTables\EloquentVueTables;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function categories()
    {
        return view("admin.categories");
    }

    public function categoriesJSON()
    {
        if (request()->ajax()) {
            $vueTables = new EloquentVueTables();
            $data = $vueTables->get(new Category(), ['id', 'title', 'cat_parent', 'order'], ['children']);

            return response()->json($data);
        }
        return abort(401);
    }

    public function category_create()
    {
        if (\request()->ajax()) {
            Category::create(\request()->input());
            return response()->json(['msg' => 'ok']);
        }

        return abort(401, "No puedes ver este contenido");
    }

    public function category_edit($id)
    {
        if (request()->ajax()) {
            $categories = Category::all();
            $category = $categories->where('id', $id)->first();

            $data = [
                "categories" => $categories,
                "category" => $category,
            ];

            return response()->json($data);
        }
        return abort(401, "No puedes ver este contenido");
    }

    public function categoryStore()
    {
        if (request()->ajax()) {
            $category = Category::find(\request('id'));
            $category->title = \request('title');
            $category->order = \request('order');
            $category->cat_parent = \request('cat_parent');

            $category->save();
            return response()->json(['msg' => 'ok']);
        }

        return abort(401, 'No puedes estar en esta zona');

    }

    public function categoryParent()
    {
        if (\request()->ajax()) {
            $data = [
                "category" => Category::where('cat_parent', '=', null)->get()
            ];

            return response()->json($data);
        }

        return abort(401, "No puedes estar en esta zona");
    }

    public function users()
    {
        return view("admin.users");
    }

    public function usersJson()
    {
        if (\request()->ajax()) {
            $vuetables = new EloquentVueTables();
            $data = $vuetables->get(new User(), ['id', 'name', 'surname', 'email', 'birthday', 'phone'], ['status']);

            return response()->json($data);
        }

        return abort(401, "No puedes estar en esta zona");
    }

    public function userBlock($id)
    {
        if (\request()->ajax()) {
            Status::updateOrCreate(['statuable_id' => $id], [
                'statuable_id' => $id,
                'statuable_type' => 'App\User',
                'status' => '3',
            ]);

            return response()->json(['msg' => 'ok']);
        }
        return abort(401, "No puedes estar en esta zona");
    }

    public function userUnblock($id)
    {
        if (\request()->ajax()) {
            Status::where('statuable_id', '=', $id)
                ->where('statuable_type', '=', "App\User")
                ->update(['status' => '1']);

            return response()->json(['msg' => 'ok']);

        }
        return abort(401, "No puedes estar en esta zona");
    }

    public function getUser($id)
    {
        if (\request()->ajax()) {
            $data = User::whereId($id)->first();

            return response()->json($data);
        }
        return abort(401, "No puedes estar en esta zona");
    }

    public function storeUser($id)
    {
        if (\request()->ajax()) {
            $user = User::find($id);

            $user->name = \request('firstName');
            $user->surname = \request('surname');
            $user->email = \request('email');
            $user->birthday = \request('birthday');
            $user->phone = \request('phone');

            $user->save();
            return response()->json(['msg' => 'ok']);
        }
        return abort(401, "No puedes estar en esta zona");
    }
}
