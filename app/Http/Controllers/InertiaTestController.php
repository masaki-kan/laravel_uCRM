<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Termwind\render;
use Inertia\Inertia;
use App\Models\InertiaTest;
use PhpParser\Node\Expr\FuncCall;

class InertiaTestController extends Controller
{
    //
    public function show($id)
    {
        // dd($id);
        return Inertia::render(
            'Inertia/Show',
            [
                'id' => $id
            ]
        );
    }

    public function create()
    {
        return Inertia::render('Inertia/Create');
    }

    public function store(Request $request)
    {

        $request->validate([
            "title" => ['required', 'max:50'],
            "content" => ['required', 'max:50'],
        ]);

        $inertiatest = new InertiaTest;
        $inertiatest->title = $request->title;
        $inertiatest->content = $request->content;
        $inertiatest->save();

        return to_route('inertia.index')->with(
            [
                'message' => '登録しました。'
            ]
        );
    }

    public function list()
    {
        return Inertia::render(
            'Inertia/List',
            [
                'lists' => InertiaTest::all()
            ]
        );
    }

    public function delete($id)
    {
        $inertia = InertiaTest::findOrFail($id);
        $inertia->delete();

        return to_route('inertia.list')->with([
            'message' => $id . '削除しました。'
        ]);
    }
}
