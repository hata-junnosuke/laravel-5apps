<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Carbon\Carbon;
class UrlController extends Controller
{
    public function index()
    {
        $urls = Url::all();
        return view('urls.index', compact('urls'));
    }

    public static function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url'
        ]);

        $shortUrl = Url::generateShortUrl($request->original_url);
        Url::create([
            'original_url' => $request->original_url,
            'short_url' => $shortUrl,
            'expired_at' => Carbon::now()->addDays(7),
        ]);

        return response()->json(['short_url' => url($shortUrl)]);
    }

    public static function redirect($shortUrl)
    {
        $url = Url::where('short_url', $shortUrl)->first();
        if (empty($url)) {
            abort(404);
        }
        // 有効期限が切れている場合は404
        if ($url->expired_at->lt(Carbon::now())) {
            abort(404);
        }

        return redirect()->to($url->original_url);
    }
}
