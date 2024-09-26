<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdImage;
use App\Models\Branch;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{

    public function index()
    {
       $ads = Ad::with('image', 'branch')->get();

       return view('ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param $ad
     */
    public function store(Request $request): void
    {
        $ad = Ad::query()->create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'images' => 'image| mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => $request->get('address'),
            'branch_id' => $request->get('branch_id'),
            'user_id' => auth()->id(),
            'status_id' => Status::ACTIVE,
            'price' => $request->get('price'),
            'rooms' => $request->get('rooms'),
        ]);

        $file = Storage::disk('public')->put('/', $request->image);

        AdImage::query()->create([
            'ad_id' => $ad->id,
            'name' => $file,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $ad = Ad::with('branch')->find($id);
//        $branch = Branch::all();
        return view('ads.show', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
