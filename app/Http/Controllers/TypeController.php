<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    public function getByCategory($category_id)
    {
        $types = Type::where('category_id', $category_id)->get();

        if ($types->isEmpty()) {
            return response()->json(["message" => "ไม่พบข้อมูลประเภทสินค้าสำหรับหมวดหมู่ที่ระบุ"], 404);
        }

        return response()->json($types);
    }

    // สร้างฟังก์ชันเพื่อดีงมา 10 ตัว
    public function getFirstTenTypes() 
    {
        $types = Type::orderBy('type_id', 'asc')->limit(10)->get();
        return response()->json($types);
    }

}