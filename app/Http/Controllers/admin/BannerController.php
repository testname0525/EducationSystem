<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showBannerEdit()
    {
        $banners = Banner::all();
        return view('admin.banner_edit', compact('banners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('new_images')) {
            return response()->json(['error' => '新しい画像が追加されていません。'], 422);
        }
        
        DB::beginTransaction();
        try {

            // 既存の画像の更新
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $id => $image) {
                    $banner = Banner::findOrFail($id);
                    $fileName = time() . '_' . $image->getClientOriginalName();
                    $filePath = $image->storeAs('images/banner/', $fileName, 'public');
                    $dbPath = 'storage/images/banner/' . $fileName;
                    $banner->update(['image' => $dbPath ]);
                }
            }
    
            // 新しい画像の追加
            if ($request->hasFile('new_images')) {
                foreach ($request -> file('new_images') as $image) {
                    $fileName = time() . '_' . $image->getClientOriginalName();
                    $filePath = $image->storeAs('images/banner/', $fileName, 'public');
                    $dbPath = 'storage/images/banner/' . $fileName;
                    Banner::create(['image' => $dbPath ]);
                }
            }
    
            DB::commit();
            return response()->json(['message' => 'バナーが正常に更新されました']);
        } catch (\Exception $e) {
                DB::rollBack();
                // エラー時もJSONレスポンスを返す
                return response()->json(['error' => 'バナーの更新に失敗しました: ' . $e->getMessage()], 422);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            // 古い画像を削除
            Storage::delete('public/' . $banner->image);
    
            // 新しい画像を保存
            $path = $request->file('image')->store('banners', 'public');
            $banner->image = $path;
        }
    
        $banner->save();
    
        return redirect()->route('admin.banner.edit')->with('success', 'バナーが更新されました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        DB::beginTransaction();
        try {
            Storage::disk('public') -> delete($banner->image);
            $banner -> delete();
            return redirect() -> route('show.banner.edit')
                -> with('success', '画像を削除しました');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect() -> back()
                -> with('error', '画像の削除に失敗しました');
        }
    }
}
