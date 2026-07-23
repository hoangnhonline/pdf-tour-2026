<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $pdfData['customer_name'] }} - {{ $pdfData['brand_name'] }} Itinerary</title>
    <style>
        @font-face {
            font-family: 'Exo 2 Custom';
            src: url('fonts/Exo2-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Exo 2 Custom';
            src: url('fonts/Exo2-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }
        @page {
            margin: 110px 30px 70px 30px;
            
        }
        .pdf-background {
            position: fixed;
            top: -110px;    /* Bù lại margin-top của @page */
            left: -30px;   /* Bù lại margin-left của @page */
            width: 210mm;   /* Rộng chuẩn A4 */
            height: 297mm;  /* Cao chuẩn A4 */
            z-index: -1000; /* Luôn nằm dưới cùng */
            opacity: 0.15;  /* Độ mờ background */
        }

        body {
            font-family: 'Roboto', sans-serif;
            font-size: 13px;
            color: #2c3e50;
            line-height: 1.4;
        }

        /* 1. BACKGROUND CỐ ĐỊNH */
        #pdf-bg {
            position: fixed;
            top: -110px;
            left: -30px;
            width: 210mm;
            height: 297mm;
            z-index: -1000;
            opacity: 0.08;
        }

        /* 2. HEADER CỐ ĐỊNH MỖI TRANG */
        header {
            position: fixed;
            top: -90px;
            left: 0px;
            right: 0px;
            height: 70px;
            border-bottom: 1px solid #0f5a7e;
            padding-bottom: 0px;
        }

        .header-left {
            float: left;
            width: 60%;
        }

        .header-right {
            float: right;
            width: 35%;
            text-align: right;
        }

        .brand-title {
            font-size: 26px;
            font-weight: bold;
            color: #581c87;
        }

        .brand-sub {
            font-size: 11px;
            color: #6b7280;
            padding-top: 20px;
        }

        /* 3. FOOTER CỐ ĐỊNH MỖI TRANG */
        footer {
            position: fixed;
            bottom: -50px;
            left: 0px;
            right: 0px;
            height: 40px;
            text-align: center;
            font-size: 9px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 5px;
        }

        .pagenum:before {
            content: counter(page);
        }
       

        

        /* 4. COMPONENT STYLES */
        .section-header {
            font-family: 'Exo 2 Custom', sans-serif;
            font-size: 20px;
            font-weight: bold;
            color: #083f5b;           
            padding: 5px;
            margin-top: 10px;
            margin-bottom: 10px;
            border-left: 3px solid #0f5a7e;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        table.data-table th, table.data-table td {
            border: 1px solid #e5e7eb;
            padding: 7px 9px;
            text-align: left;
        }

        table.data-table th {
            background-color: #faf5ff;
            color: #eb6290;
            font-weight: bold;
        }

        .grid-2col {
            width: 100%;
            margin-bottom: 10px;
        }

        .grid-2col td {
            width: 50%;
            vertical-align: top;
            padding: 3px 0;
        }

        .badge {
            background-color: #dcfce7;
            color: #15803d;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
        }

        .day-box {
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 12px;
        }

        .day-title {
            font-size: 15px;
            font-weight: bold;
            color: #eb6290;
            margin-bottom: 4px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

    <!-- Background Image -->
    @if($bgBase64)
        <img src="{{ $bgBase64 }}" class="pdf-background">
    @endif

    <!-- Fixed Header -->
    <header>
        <div class="header-left">
            <img src="images/logo.png" width="100" />  
            
        </div>
        <div class="header-right">
            <div class="brand-sub">{{ $pdfData['slogan'] }}</div>         
        </div>
    </header>

    <!-- Fixed Footer -->
    <footer>
        <div>Experience this Itinerary on the <strong>30 Sundays App</strong></div>
        <div>Page <span class="pagenum"></span></div>
    </footer>

    <!-- MAIN CONTENT - PAGE 1 -->
    <main>
        <!-- Traveller Details -->
        <div class="section-header">Traveller Details</div>
        <table class="grid-2col">
            <tr>
                <td><strong>Customer Name:</strong> {{ $pdfData['customer_name'] }}</td>
                <td><strong>Travel Dates:</strong> {{ $pdfData['travel_dates'] }}</td>
            </tr>
            <tr>
                <td><strong>Duration of Stay:</strong> {{ $pdfData['duration'] }}</td>
                <td><strong>Destination:</strong> {{ $pdfData['destination'] }}</td>
            </tr>
            <tr>
                <td><strong>Number of Travellers:</strong> {{ $pdfData['travellers'] }}</td>
                <td><strong>Creation Date:</strong> {{ $pdfData['creation_date'] }}</td>
            </tr>
        </table>

        <!-- Price Quote -->
        <div class="section-header">Price Quote</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th width="15%">Sr. No</th>
                    <th width="55%">Details</th>
                    <th width="30%">Cost (₹)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pdfData['price_quote'] as $item)
                <tr>
                    <td>{{ $item['sr'] }}</td>
                    <td>{{ $item['details'] }}</td>
                    <td>{{ $item['cost'] }}</td>
                </tr>
                @endforeach
                <tr style="background-color: #faf5ff;">
                    <td colspan="2" style="text-align: right;"><strong>Total:</strong></td>
                    <td><strong style="color: #6b21a8;">₹ {{ $pdfData['total_cost'] }}</strong></td>
                </tr>
            </tbody>
        </table>

        <p style="font-size: 9px; color: #4b5563;">
            * Note: Government rules impose flat 2% TCS. Total amount including TCS is <strong>₹ {{ $pdfData['total_with_tcs'] }}</strong>.
        </p>

        <!-- Accommodation Details -->
        <div class="section-header">Accommodation Details</div>
        <img src="images/hotel.jpg" width="100%">
        <div style="margin-bottom: 8px;">
            <strong style="font-size: 13px;">{{ $pdfData['hotel']['name'] }}</strong> 
            <span class="badge">{{ $pdfData['hotel']['rating'] }}</span>
        </div>
        <p><strong>Location:</strong> {{ $pdfData['hotel']['location'] }} | <strong>Meal Plan:</strong> {{ $pdfData['hotel']['meal_plan'] }}</p>
        <p style="font-style: italic; color: #4b5563;">"{{ $pdfData['hotel']['description'] }}"</p>
        
        <p><strong>Hotel Facilities:</strong> {{ implode(' • ', $pdfData['hotel']['facilities']) }}</p>
    </main>

    <!-- FORCE PAGE BREAK FOR ITINERARY -->
    <div class="page-break"></div>

    <!-- MAIN CONTENT - PAGE 2 -->
    <main>
        <div class="section-header">Your Itinerary Details</div>

        @foreach($pdfData['itinerary'] as $day)
            <div class="day-box">
                <div class="day-title">{{ $day['day'] }}</div>
                <div style="font-weight: bold; margin-bottom: 4px;">{{ $day['title'] }} (Duration: {{ $day['duration'] }})</div>
                <ul style="margin: 0; padding-left: 18px; color: #374151;">
                    @foreach($day['details'] as $detail)
                        <li>{{ $detail }}</li>
                    @endforeach
                </ul>
                <div style="margin-top: 6px; font-size: 10px; color: #059669;">
                    ✓ <strong>Inclusions:</strong> {{ $day['inclusions'] }}
                </div>
            </div>
        @endforeach

        <div class="section-header">Terms & Conditions Summary</div>
        <p><strong>Visa Info:</strong> {{ $pdfData['visa_info'] }}</p>
        <p><strong>Payment Policies:</strong> {{ $pdfData['payment_terms'] }}</p>
    </main>

</body>
</html>