<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Itinerary PDF</title>
    <style>
        /* 1. Thiết lập trang A4 và Margin */
        @page {
            margin: 120px 30px 80px 30px; /* Top Right Bottom Left */
        }

        body {
            font-family: 'DejaVu Sans', sans-serif; /* DejaVu Sans hỗ trợ UTF-8 / Tiếng Việt tốt */
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* 2. Cấu hình Background lặp lại cho mọi trang */
        #pdf-background {
            position: fixed;
            top: -120px;
            left: -30px;
            width: 210mm;
            height: 297mm;
            z-index: -1000;
            opacity: 0.15; /* Làm mờ background */
        }

        /* 3. Cấu hình Header cố định */
        header {
            position: fixed;
            top: -100px;
            left: 0px;
            right: 0px;
            height: 80px;
            border-bottom: 2px solid #8e24aa;
        }

        .header-title {
            float: left;
            font-size: 28px;
            font-weight: bold;
            color: #4a148c;
            font-family: 'DejaVu Sans', cursive;
        }

        .header-logo {
            float: right;
            text-align: right;
        }

        /* 4. Cấu hình Footer cố định */
        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: center;
            font-size: 10px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 5px;
        }

        /* Đếm số trang tự động */
        .page-number:before {
            content: "Trang " counter(page);
        }

        /* 5. Style cho Nội dung */
        .section-title {
            font-size: 16px;
            color: #4a148c;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 10px;
            border-bottom: 1px solid #4a148c;
            padding-bottom: 3px;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table.data-table th, table.data-table td {
            border: 1px solid #cccccc;
            padding: 8px;
            text-align: left;
        }

        table.data-table th {
            background-color: #f3e5f5;
            color: #4a148c;
            font-weight: bold;
        }

        .info-grid {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-grid td {
            padding: 5px;
            vertical-align: top;
        }

        .hotel-image {
            width: 100%;
            max-height: 200px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

    <!-- BACKGROUND CỐ ĐỊNH -->
    @if($bgBase64)
        <img src="{{ $bgBase64 }}" id="pdf-background">
    @endif

    <!-- HEADER CỐ ĐỊNH -->
    <header>
        <div class="header-title">Vacay!</div>
        <div class="header-logo">
            <strong style="font-size: 18px; color: #333;">30 Sundays</strong><br>
            <span style="font-size: 10px;">Romantic Couple Packages</span>
        </div>
    </header>

    <!-- FOOTER CỐ ĐỊNH -->
    <footer>
        <div>Experience this Itinerary on the 30 Sundays App</div>
        <div class="page-number"></div>
    </footer>

    <!-- NỘI DUNG TRANG 1 -->
    <main>
        <div class="section-title">Traveller Details</div>
        <table class="info-grid">
            <tr>
                <td><strong>Customer Name:</strong> {{ $data->customer_name }}</td>
                <td><strong>Travel Dates:</strong> {{ $data->travel_dates }}</td>
            </tr>
            <tr>
                <td><strong>Duration:</strong> {{ $data->duration }}</td>
                <td><strong>Destination:</strong> {{ $data->destination }}</td>
            </tr>
            <tr>
                <td><strong>Travellers:</strong> {{ $data->adults_count }} Adults</td>
                <td><strong>Creation Date:</strong> {{ date('M d, Y') }}</td>
            </tr>
        </table>

        <div class="section-title">Price Quote</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th width="10%">Sr. No</th>
                    <th width="60%">Details</th>
                    <th width="30%">Cost (VND)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Hotels & Stay</td>
                    <td>15,212.00</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Activities & Transfers</td>
                    <td>48,720.00</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>GST / Taxes</td>
                    <td>2,918.00</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;"><strong>Total:</strong></td>
                    <td><strong>{{ number_format($data->total_price, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- CHÈN HÌNH ẢNH TỪ DATABASE -->
        <div class="section-title">Accommodation Details</div>
        <p><strong>Hotel:</strong> {{ $data->hotel_name }}</p>
        
        @if($hotelImgBase64)
            <div>
                <img src="{{ $hotelImgBase64 }}" class="hotel-image">
            </div>
        @endif
    </main>

    <!-- NGẮT TRANG SANG TRANG 2 -->
    <div class="page-break"></div>

    <!-- NỘI DUNG TRANG 2 -->
    <main>
        <div class="section-title">Your Itinerary at a Glance</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th width="10%">Day</th>
                    <th width="25%">Stay</th>
                    <th width="65%">Activity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data->day_details as $day)
                <tr>
                    <td>{{ $day['day'] }}</td>
                    <td>{{ $day['stay'] }}</td>
                    <td>{{ $day['activity'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>

</body>
</html>