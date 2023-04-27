<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ThumborController extends Controller
{
    public function get_spec_string(Request $request)
    {
        // ====== 控制圖片後製條件 ======
        $data = [
            "filter"    => false,
            "watermark" => false,
        ];

        $resize_checkbox = $request->input('resize-checkbox') === "true" ? true : false;
        $filter_checkbox = $request->input('filter-checkbox') === "true" ? true : false;
        $watermark_checkbox = $request->input('watermark-checkbox') === "true" ? true : false;

        if ($resize_checkbox) {
            $data['resize'] = [
                intval($request->input("resize-width")) > 0 ? intval($request->input("resize-width")) : 500,
                intval($request->input("resize-height")) > 0 ? intval($request->input("resize-height")) : 300
            ];
        }
        if ($filter_checkbox) {
            $data["filter"] = true;
        }
        if ($watermark_checkbox) {
            $data["watermark"] = true;
        }

        // ====== 取 protobuf string ======
        $response = Http::withHeaders([
            'Accept' => '*/*',
            'Content-Type' => 'application/json',
        ])->post('http://rust:3000/spec_string', $data);

        $protobuf = $response->body();

        $img_url = $request->input('target-image');
        $img_url_encode = urlencode($img_url);

        $url = sprintf('http://rust:3000/image/%s/%s', $protobuf, $img_url_encode);

        // ====== 跟 rust 要符合條件的圖片 ======
        $image_response = Http::withHeaders([
            'Accept' => '*/*',
        ])->get($url);

        if ($image_response->successful()) {
            $binary_image_data = base64_encode($image_response->body());
            return response()->json(['data' => $binary_image_data], 200);
        }

        return response()->json(['data' => '資料格式有誤'], 400);
    }
}
