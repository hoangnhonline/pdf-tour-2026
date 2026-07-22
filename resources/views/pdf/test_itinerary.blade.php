<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $pdfData['customer_name'] }} - {{ $pdfData['brand_name'] }} Itinerary</title>
    <style>
        @page {
            margin: 110px 30px 70px 30px; /* Top Right Bottom Left */
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
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
            border-bottom: 2px solid #6b21a8;
            padding-bottom: 5px;
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
            font-size: 9px;
            color: #6b7280;
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
            font-size: 14px;
            font-weight: bold;
            color: #581c87;
            background-color: #f3e8ff;
            padding: 6px 10px;
            margin-top: 15px;
            margin-bottom: 10px;
            border-left: 4px solid #7e22ce;
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
            color: #581c87;
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
            background-color: #ffffff;
        }

        .day-title {
            font-size: 12px;
            font-weight: bold;
            color: #6b21a8;
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
        <img src="{{ $bgBase64 }}" id="pdf-bg">
    @endif

    <!-- Fixed Header -->
    <header>
        <div class="header-left">
            <div class="brand-title">Vacay!</div>
            <div class="brand-sub">{{ $pdfData['slogan'] }}</div>
        </div>
        <div class="header-right">
            <strong style="font-size: 16px; color: #581c87;">{{ $pdfData['brand_name'] }}</strong><br>
            <span style="font-size: 9px; color: #16a34a;">★ {{ $pdfData['rating'] }}</span>
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