<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\PortfolioItem;
use App\Models\SkillItem;

class DashboardController extends Controller
{
    public function index()
    {
        $blogCount = Blog::count();
        $skillCount = SkillItem::count();
        $portfolioCount = PortfolioItem::count();
        $feedbackCount = Feedback::count();
        return view('admin.dashboard', compact('blogCount', 'skillCount', 'portfolioCount', 'feedbackCount'));
    }
}
