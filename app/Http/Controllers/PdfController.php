<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Itinerary;
use PDF;

class PdfController extends Controller
{
    public function generatePdf($id)
    {
        // 1. Lấy dữ liệu từ Database
        // Giả lập dữ liệu nếu DB trống để test
        $data = Itinerary::find($id);

        if (!$data) {
            $data = (object)[
                'customer_name' => 'Ansh',
                'travel_dates' => 'Aug 1, 2026 - Aug 5, 2026',
                'duration' => '5 Days / 4 Nights',
                'destination' => 'Vietnam',
                'adults_count' => 2,
                'total_price' => 66850.00,
                'hotel_name' => 'Night Sea Hotel 4*',
                // Ảnh chèn dạng path tuyệt đối hoặc base64 để Dompdf render không bị lỗi
                'hotel_image' => public_path('images/hotel-sample.jpg'), 
                'day_details' => [
                    ['day' => 1, 'stay' => 'Phu Quoc', 'activity' => 'Phu Quoc Airport to Hotel city center | Private Transfers'],
                    ['day' => 2, 'stay' => 'Phu Quoc', 'activity' => 'Vin Wonder & Safari Combo tickets & Grand World Transfer'],
                    ['day' => 3, 'stay' => 'Phu Quoc', 'activity' => 'Cable Car + Aquatopia Water Park & 3 Island Trip By Boat'],
                    ['day' => 4, 'stay' => 'Phu Quoc', 'activity' => 'Phu Quoc Land Tour 2: Discover The North - Kayaking'],
                    ['day' => 5, 'stay' => 'Departure', 'activity' => 'Phu Quoc city center Hotel to Airport | Private Transfers'],
                ]
            ];
        }

        // Chuyển đổi ảnh sang dạng Base64 (Giúp mã hoá ảnh truyền thẳng vào HTML, tránh lỗi đường dẫn Dompdf)
        $bgImagePath = public_path('images/pdf-bg.png'); // Ảnh nền watermark/họa tiết
        $bgBase64 = file_exists($bgImagePath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($bgImagePath)) : '';

        $hotelImgPath = $data->hotel_image;
        $hotelImgBase64 = file_exists($hotelImgPath) ? 'data:image/jpeg;base64,' . base64_encode(file_get_contents($hotelImgPath)) : '';

        // Load View và xuất PDF
        $pdf = PDF::loadView('pdf.itinerary', compact('data', 'bgBase64', 'hotelImgBase64'))
                  ->setPaper('a4', 'portrait')
                  ->setOption('isRemoteEnabled', true);

        // Xem trực tiếp trên trình duyệt
        return $pdf->stream('itinerary-'.$id.'.pdf');
        
        // Hoặc tải về: return $pdf->download('itinerary.pdf');
    }
    public function testPdfFromDocument()
    {
        // Dữ liệu bóc tách chính xác từ file 30Sundays-package.pdf
        $pdfData = [
            'brand_name'    => 'Plan To Travel',
            'rating' => '',
            'slogan'        => 'Your trust, our quality',
            
            // Traveller Details
            'customer_name' => 'Ansh',
            'travel_dates'  => 'Aug 1, 2026 - Aug 5, 2026',
            'duration'      => '5 Days / 4 Nights',
            'destination'   => 'Vietnam',
            'travellers'    => '2 Adults',
            'creation_date' => 'Jul 13, 2026 03:55:12 PM',

            // Price Quote
            'price_quote'   => [
                ['sr' => 1, 'details' => 'Hotels', 'cost' => '15,212.00'],
                ['sr' => 2, 'details' => 'Activities', 'cost' => '48,720.00'],
                ['sr' => 3, 'details' => 'GST', 'cost' => '2,918.00'],
            ],
            'total_cost'    => '66,850.00',
            'total_with_tcs'=> '68,187.00',

            // Accommodation Details
            'hotel' => [
                'name'      => 'Night Sea Hotel (4 Stars)',
                'location'  => 'Phu Quoc (4N)',
                'room_type' => 'Superior Double Room',
                'meal_plan' => 'Breakfast',
                'rating'    => '8.1 Very Good (Booking.com)',
                'description' => 'Night Sea Hotel offers a romantic stay with a rooftop pool, balcony views, and candlelit dining, wrapped in lush tropical gardens on Phu Quoc\'s beloved Long Beach.',
                'facilities'  => ['Outdoor Swimming Pool', 'Restaurant', 'Breakfast', 'Airport Shuttle', 'Free Parking', 'Free WiFi', 'Bar']
            ],

            // Detailed Itinerary
            'itinerary' => [
                [
                    'day' => 'Day 1 - Phu Quoc - Aug 01, 2026',
                    'title' => 'Phu Quoc Airport to Hotel city center | Private Transfers',
                    'duration' => '1 Hour(s)',
                    'details' => [
                        'Pickup: Your driver meets you at Phu Quoc Airport arrivals after your flight lands.',
                        'Drop-off: Direct drop-off at your hotel in Phu Quoc city center (Duong Dong).'
                    ],
                    'inclusions' => 'Private AC Transfer'
                ],
                [
                    'day' => 'Day 2 - Phu Quoc - Aug 02, 2026',
                    'title' => 'Vin Wonder & Safari Combo tickets & Grand World Transfer',
                    'duration' => '12 Hour(s)',
                    'details' => [
                        'Pickup: Private pickup from your centrally located Phu Quoc hotel (~09:00 AM).',
                        'Vinpearl Safari: Discover rare wildlife in open habitats.',
                        'VinWonder: Explore thrilling rides, water slides, and themed zones.',
                        'Grand World: Venice-style canals, light shows and Teddy Bear Museum.',
                        'Drop-off: Private return transfer arriving at approximately 09:00 PM.'
                    ],
                    'inclusions' => 'Roundtrip Private transfer, Entrance ticket to VinWonder & Vinpearl Safari'
                ],
                [
                    'day' => 'Day 3 - Phu Quoc - Aug 03, 2026',
                    'title' => 'Cable Car + Aquatopia Water Park & 3 Island Trip By Boat',
                    'duration' => '8 Hour(s)',
                    'details' => [
                        'Hon Thom Cable Car: Glide on the world\'s longest sea-crossing gondola.',
                        'Aquatopia Water Park: Splash through wave pools and body slides.',
                        '3-Island boat trip: Cruise by speedboat to Pineapple, Fingernail, and Gam Ghi islands.'
                    ],
                    'inclusions' => 'Shared AC transfer, Cable car ticket, Water park entry, Lunch on boat, Snorkeling Equipment'
                ],
                [
                    'day' => 'Day 4 - Phu Quoc - Aug 04, 2026',
                    'title' => 'Phu Quoc Land Tour 2: Discover The North - Kayaking - Starfish Beach',
                    'duration' => '8 Hour(s)',
                    'details' => [
                        'Kayaking through mangrove channels.',
                        'Visit Starfish Beach and explore National Park trails.',
                        'Experience Grand World complex.'
                    ],
                    'inclusions' => 'Shared AC transfer, Sightseeing entrance fees, Lunch, 1 bottle of water'
                ],
                [
                    'day' => 'Day 5 - Departure - Aug 05, 2026',
                    'title' => 'Phu Quoc city center Hotel to Airport | Private Transfers',
                    'duration' => '1 Hour(s)',
                    'details' => [
                        'Pickup: Driver meets you in hotel lobby based on flight departure.',
                        'Drop-off: Direct drop-off at departure terminal.'
                    ],
                    'inclusions' => 'Private AC transfer'
                ]
            ],

            // Terms & Conditions
            'visa_info' => 'Tourist Visa, Duration: 30 Days, Single Entry. Processing time 7-10 working days.',
            'payment_terms' => '100% flight + 10% land cost at booking. Remaining 50% 16 days before departure.'
        ];

        // Mã hóa hình nền / Logo dạng Base64 (tránh lỗi load đường dẫn trên Dompdf)
        $bgPath = public_path('images/pdf-bg.png');
        $bgBase64 = file_exists($bgPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($bgPath)) : '';
        // Kiểm tra file có tồn tại không
        //dd($bgBase64);
        if (!file_exists($bgPath)) {
            $bgPath = null;
          //  dd('11111');
        }
       // return view('pdf.test_itinerary', compact('pdfData', 'bgBase64', 'bgPath'));
       //$pdf = PDF::loadView('pdf.test_itinerary', compact('pdfData', 'bgBase64'), [], 'utf-8')
         // ->setPaper('a4', 'portrait');
        $pdf = PDF::loadView('pdf.test_itinerary', compact('pdfData', 'bgBase64'))
              ->setPaper('a4', 'portrait'); 
        return $pdf->stream('30Sundays-Itinerary-Test.pdf');
    }
}