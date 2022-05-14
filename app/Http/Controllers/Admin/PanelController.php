<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {

        $users = User::query()->count();
        $articles = Article::query()->count();
        return view('admin.index', compact('users','articles'));
    }
}
