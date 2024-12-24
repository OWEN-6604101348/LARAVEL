<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
class ProductController extends Controller
{
    private $products = [
    ['id' => 1, 'name' => 'จิ้งหรีด',
    'description' => 'มีโปรตีนสูง รสชาติมันและกรุบกรอบ เป็นที่นิยมในอาหารว่าง','price'=> 50,
    'image' => 'https://static.thairath.co.th/media/dFQROr7oWzulq5FZUIKuq2Pnj9uAtodE68kIfS0kFRtN1rfmDU1YCWTJp3EvFCRyS0l.webp'],

    ['id' => 2, 'name' => 'แมลงป่อง',
    'description' => 'มีเปลือกแข็งและเนื้อแน่น รสชาติออกเค็มและมัน', 'price' => 50,
    'image' => 'https://i.ytimg.com/vi/ag4m3LQXlTM/sddefault.jpg'],

    ['id' => 3, 'name' => 'ตั๊กแตน',
    'description' => 'เนื้อกรอบ หอม และมีรสเค็มเล็กน้อย นิยมรับประทานเป็นของว่างหรือกับข้าว', 'price' => 50,
    'image' => 'https://us-fbcloud.net/wb/data/1224/1224460-img.uc2i0g.1ay7a.opsc82s5.webp'],

    ['id' => 4, 'name' => 'ดักแด้ไหม',
    'description' => 'มีเนื้อฉ่ำและรสชาติออกหวานมัน เป็นแหล่งโปรตีนที่ดี', 'price' => 50,
    'image' => 'https://www.petcharavejhospital.com/userfiles/files/%E0%B8%A3%E0%B8%96%E0%B8%94%E0%B9%88%E0%B8%A7%E0%B8%99(1).jpg'],

    ['id' => 5, 'name' => 'หนอนไม้ไผ่',
    'description' => 'ตัวหนาและนุ่ม มีรสหวานมันเฉพาะตัว', 'price' => 50,
    'image' => 'http://www.farmthailand.com/webboard/data/attachment/forum/201408/31/084828ymt1livzztpjbjto.jpg'],

    ['id' => 6, 'name' => 'แมงดานา',
    'description' => 'แมลงที่มีกลิ่นหอมแรง มีรสชาติเข้มข้น', 'price' => 50,
    'image' => 'http://www.thongthailand.com/private_folder/cfood/malang1.jpg'],

    ['id' => 7, 'name' => 'แมลงเม่า',
    'description' => 'ตัวเล็กและมีรสชาติดี หอม มัน ', 'price' => 50,
    'image' => 'https://f.ptcdn.info/906/004/000/1367932777-image-o.jpg'],

    ['id' => 8, 'name' => 'ด้วงสาคู',
    'description' => 'เนื้ออ่อนและฉ่ำ รสชาติมัน มีฟาดที่ปลายลิ้น', 'price' => 50,
    'image' => 'https://scontent.fcnx3-1.fna.fbcdn.net/v/t1.6435-9/117387424_137784217979122_8301266454770454625_n.jpg?stp=dst-jpg_p180x540_tt6&_nc_cat=109&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeGzyID1G3nMaCvTRKyju-_BOFEtmefiIss4US2Z5-Iiy6U78yzv1y53lLgMkd46KBs2-UvMGPSdF4751T-KxSrt&_nc_ohc=S77He5M-e9gQ7kNvgHdZngn&_nc_oc=AdgJaj6E-y00X5lb0vaKT0ci6m6whuWL4-H0lV-sm6LnfAdwkzm9qspzMJjxPGEH9hk&_nc_zt=23&_nc_ht=scontent.fcnx3-1.fna&_nc_gid=ARe3l-zt9dkNDn_rpL3Gvzq&oh=00_AYCF9lEuuR35C7oq7VuFddBGCig5II_lnIRaHC2AtwQJFw&oe=678FBC1B'],

    ['id' => 9, 'name' => 'ไข่มดแดง',
    'description' => 'รสชาติเปรี้ยวเล็กน้อย มีโปรตีนสูง ', 'price' => 50,
    'image' => 'https://img.kapook.com/u/surauch/cook/cticoct-7o.jpg'],

    ['id' => 10, 'name' => 'แมงกระชอน',
    'description' => 'ตัวเล็กมีรสชาติมันและกรอบ ทานเป็นของขบเคี้ยว', 'price' => 50,
    'image' => 'https://t1.blockdit.com/photos/2021/03/6054d19d633e7037204bb80a_800x0xcover_JgqA4dXS.jpg'],
    ];

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ส่งข้อมูลสินค้าที่เก็บในตัวแปร $products ไปที่หน้า Inertia
        return Inertia::render('Products/Index', [
            'products' => $this->products // ส่งข้อมูลที่เก็บไว้ในตัวแปร $products
        ]);
    }
    
    public function show($id)
    {
        // ดึงข้อมูลสินค้าที่ตรงกับ ID
        $product = collect($this->products)->firstWhere('id', $id);
    
        // ถ้าไม่พบสินค้าให้แสดง error 404
        if (!$product) {
            abort(404, 'Product not found');
        }
    
        // ส่งข้อมูลสินค้าไปยัง React ผ่าน Inertia
        return Inertia::render('Products/Show', ['product' => $product]);
    }
    
}
    