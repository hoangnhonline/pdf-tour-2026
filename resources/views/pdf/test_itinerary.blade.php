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
        /* Khối Exclusions tổng quan */
        .exclusions-section {
            margin-top: 25px;
            padding: 15px 20px;
            background-color: #fef2f2; /* Nền đỏ nhạt nhẹ nhàng */
            border-left: 4px solid #ef4444; /* Viền màu đỏ cảnh báo */
            border-radius: 4px;
            page-break-inside: avoid; /* Tránh ngắt trang dở dang trên PDF */
        }

        .exclusions-title {
            color: #991b1b;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
        }

        .exclusions-list {
            margin: 0;
            padding-left: 18px;
            list-style-type: disc;
        }

        .exclusions-list li {
            font-size: 17px;
            color: #374151;
            line-height: 1.6;
            margin-bottom: 6px;
        }
        ul {
            line-height: 27px;
        }
        /* Khối tóm tắt Inclusion/Exclusion ở cuối mỗi Day Block */
        .day-summary-footer {
            margin-top: 12px;
            padding-top: 8px;
            border-top: 1px dashed #e5e7eb;
            font-size: 17px; /* Cập nhật font-size 17px */
            color: #4b5563;
            line-height: 1.5;
        }

        .day-summary-footer .inc-label {
            color: #0891b2;
            font-weight: bold;
        }

        .day-summary-footer .exc-label {
            color: #ef4444;
            font-weight: bold;
        }
        .content-level1 h3{
            font-family: 'Exo 2 Custom';
            color:#0f766e;
            font-size: 20px;
            
        }
        .content-level1 h4{
         
            font-size: 18px;
        }
        .content-level1, .content-level2{padding-left: 15px;}
        .bold{
            font-weight: bold;
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
            font-size: 16px;
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
            font-size: 24px;
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
            font-size: 18px;
            font-weight: bold;
            color: #eb6290;
            margin-bottom: 4px;
        }

        .page-break {
            page-break-after: always;
        }
        h1.title-general{
            color: #0b3c5d; font-size: 24px; text-transform: uppercase; margin-bottom: 5px;
            font-family: 'Exo 2 Custom', sans-serif;
        }
        /* Font & Reset cơ bản */
        .day-block {
            font-family: 'Exo 2 Custom', sans-serif;
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin-bottom: 20px;
            page-break-inside: avoid; /* Đảm bảo không vỡ trang giữa chừng */
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        /* Header của Ngày */
        .day-header {
            background: #f9cfde;
            color: #ffffff;
            padding: 10px 18px;
            border-top-left-radius: 7px;
            border-top-right-radius: 7px;
        }

        .day-badge {
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
            color: #0c0c0c;
            display: block;
            margin-bottom: 2px;
        }

        .day-title {
            font-size: 17px;
            font-weight: 700;
            margin: 0;
            color: #595353;
        }

        /* Phần nội dung dạng dòng đơn */
        .day-body {
            padding: 15px 18px;
        }

        /* Tóm tắt tổng quan ngắn (nếu có) */
        .day-summary {
            font-size: 11px;
            font-style: italic;
            color: #0891b2;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px dashed #e5e7eb;
        }

        /* Danh sách các điểm tham quan / hoạt động */
        .activity-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .activity-item {
            position: relative;
            padding-left: 18px;
            margin-bottom: 10px;
        }

        .activity-item:last-child {
            margin-bottom: 0;
        }

        /* Dấu gạch / Bullet icon đồng bộ màu nhận diện */
        .activity-item::before {
            content: "•";
            color: #0891b2;
            font-size: 16px;
            font-weight: bold;
            position: absolute;
            left: 0;
            top: -2px;
        }

        .activity-title {
            font-size: 18px;
            font-weight: 700;
            color: #0b3c5d;
            display: inline;
        }

        .activity-desc {
            font-size: 17px;
            line-height: 1.5;
            color: #4b5563;
            margin: 3px 0 0 0;
        }
        .option-divider {
            margin: 15px 0 10px 0;
            padding-bottom: 5px;
            border-bottom: 2px solid #0891b2;
            color: #0b3c5d;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
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
        <div>Experience this Itinerary on the <strong>Plan To Travel App</strong></div>
        <div>Page <span class="pagenum"></span></div>
    </footer>
    
    <main>
        <div style="text-align: center; margin-bottom: 30px;">
            <h1 class="title-general">
                Phu Quoc & Da Nang Discovery
            </h1>
            <div style="color: #0891b2; font-size: 14px; font-weight: bold; letter-spacing: 1px;font-family: 'Exo 2 Custom', sans-serif;">
                6 DAYS / 5 NIGHTS ITINERARY
            </div>
        </div>
        
        <div class="day-block">
            <!-- Header -->
            <div class="day-header">
                <span class="day-badge">DAY 1</span>
                <h3 class="day-title">Welcome to Phu Quoc</h3>
            </div>

            <!-- Main Content -->
            <div class="day-body">
                
                <ul class="activity-list">
                    <li class="activity-item">
                        <span class="activity-title">Airport Arrival & Private Transfer:</span>
                        <p class="activity-desc">
                            Warm welcome upon arrival at Phu Quoc International Airport. Your private vehicle will driver-transfer you smoothly to the hotel.
                        </p>
                    </li>

                    <li class="activity-item">
                        <span class="activity-title">Lunch & Check-in:</span>
                        <p class="activity-desc">
                            Savor a delicious lunch (Indian menu option available), followed by hotel check-in and time to unwind at your leisure.
                        </p>
                    </li>

                    <li class="activity-item">
                        <span class="activity-title">Evening at Leisure:</span>
                        <p class="activity-desc">
                            Enjoy a relaxed evening at your own pace—stroll along the beach, catch a famous Phu Quoc sunset, or explore the local night market.
                        </p>
                    </li>
                </ul>

                <!-- Inclusions & Exclusions Summary Bar -->
               <div class="day-summary-footer">
                    <span class="inc-label">✔ Inclusions:</span> Airport pickup (Private vehicle), Accommodation (CP), Lunch.<br>
                    <span class="exc-label">✖ Exclusions:</span> Dinner, drinks, personal expenses.
                </div>

            </div>
        </div><!--day 1-->
        <div class="day-block">
            <!-- Header -->
            <div class="day-header">
                <span class="day-badge">DAY 2</span>
                <h3 class="day-title">VinWonders Adventure & Night Market Experience</h3>
            </div>

            <!-- Main Content -->
            <div class="day-body">
                
                <ul class="activity-list">
                    <li class="activity-item">
                        <span class="activity-title">Morning Breakfast & Park Transfer:</span>
                        <p class="activity-desc">
                            Start your day with breakfast at the hotel before your private transfer takes you to VinWonders Phu Quoc—Vietnam's largest theme park.
                        </p>
                    </li>

                    <li class="activity-item">
                        <span class="activity-title">Full Day at VinWonders:</span>
                        <p class="activity-desc">
                            Immerse yourself in world-class rides, vibrant cultural shows, and the breathtaking underwater world at the Sea Shell Aquarium.
                        </p>
                    </li>

                    <li class="activity-item">
                        <span class="activity-title">Phu Quoc Night Market & Indian Dinner:</span>
                        <p class="activity-desc">
                            In the evening, transfer to the lively Phu Quoc Night Market to soak in the local atmosphere, followed by a delicious, authentic Indian dinner.
                        </p>
                    </li>

                    <li class="activity-item">
                        <span class="activity-title">Return Transfer:</span>
                        <p class="activity-desc">
                            After dinner, your private driver will escort you back to the hotel for a restful night.
                        </p>
                    </li>
                </ul>

                <!-- Inclusions & Exclusions Summary Bar -->
                <div class="day-summary-footer">
                    <span class="inc-label">✔ Inclusions:</span> Private transfers, VinWonders entrance tickets, Indian dinner.<br>
                    <span class="exc-label">✖ Exclusions:</span> Lunch, drinks, personal expenses.
                </div>

            </div>
        </div><!--day 2-->
        <div class="day-block">
            <!-- Header -->
            <div class="day-header">
                <span class="day-badge">DAY 3</span>
                <h3 class="day-title">Island Exploration & Leisure (Selectable Options)</h3>
            </div>

            <!-- Main Content -->
            <div class="day-body">
                
                <!-- ================= OPTION 1 ================= -->
                <div class="option-divider">Option 1: 3-Island Speedboat & Snorkeling Tour</div>

                <ul class="activity-list">
                    <li class="activity-item">
                        <span class="activity-title">Island Hopping & Snorkeling Adventure:</span>
                        <p class="activity-desc">
                            Enjoy breakfast at the hotel, followed by a shared group (SIC) transfer to the harbor. Board a high-speed boat to explore Phu Quoc’s pristine southern islands, swim, and snorkel in crystal-clear waters.
                        </p>
                    </li>

                    <li class="activity-item">
                        <span class="activity-title">Island Lunch & Relaxation:</span>
                        <p class="activity-desc">
                            Savor a local island lunch (vegetarian options available), then unwind on white sandy beaches before returning to your hotel.
                        </p>
                    </li>
                </ul>

                <!-- Inclusions/Exclusions for Option 1 -->
                <div class="day-summary-footer">
                    <span class="inc-label">✔ Inclusions (Opt 1):</span> Shared group transfers, Speedboat, Tour guide, Island lunch, Snorkeling gear.<br>
                    <span class="exc-label">✖ Exclusions:</span> Dinner, drinks, personal expenses.
                </div>


                <!-- ================= OPTION 2 ================= -->
                <div class="option-divider" style="margin-top: 25px;">Option 2: Hon Thom Cable Car & Sunset Town Experience</div>

                <ul class="activity-list">
                    <li class="activity-item">
                        <span class="activity-title">World's Longest Cable Car Ride:</span>
                        <p class="activity-desc">
                            After breakfast, enjoy a private transfer to Sunset Town and board the world’s longest 3-wire cable car to Hon Thom Island for spectacular aerial ocean views.
                        </p>
                    </li>

                    <li class="activity-item">
                        <span class="activity-title">Kiss Bridge & Sunset Town Walk:</span>
                        <p class="activity-desc">
                            Explore the Mediterranean-inspired Sunset Town and visit the iconic Kiss Bridge before your private transfer takes you back to the hotel.
                        </p>
                    </li>
                </ul>

                <!-- Inclusions/Exclusions for Option 2 -->
                <div class="day-summary-footer">
                    <span class="inc-label">✔ Inclusions (Opt 2):</span> Private transfers, Cable car round-trip ticket, Kiss Bridge entry ticket.<br>
                    <span class="exc-label">✖ Exclusions:</span> Lunch, Dinner, drinks, personal expenses.
                </div>

            </div>
        </div><!--day 3-->
        <div class="day-block">
            <!-- Header -->
            <div class="day-header">
                <span class="day-badge">DAY 4</span>
                <h3 class="day-title">Flight to Da Nang & Enchanting Hoi An Exploration</h3>
            </div>

            <!-- Main Content -->
            <div class="day-body">
                
                <ul class="activity-list">
                    <li class="activity-item">
                        <span class="activity-title">Phu Quoc Departure & Fly to Da Nang:</span>
                        <p class="activity-desc">
                            Enjoy breakfast and check out of your hotel. Your private transfer will escort you to Phu Quoc Airport for your domestic flight to Da Nang. Upon arrival, transfer to your hotel for check-in.
                        </p>
                    </li>

                    <li class="activity-item">
                        <span class="activity-title">Hoi An Ancient Town & Cam Thanh Coconut Village:</span>
                        <p class="activity-desc">
                            In the afternoon, embark on a private 5-hour excursion to the lush Cam Thanh Coconut Village and the lantern-lit streets of Hoi An Ancient Town.
                        </p>
                    </li>

                    <li class="activity-item">
                        <span class="activity-title">Return Transfer:</span>
                        <p class="activity-desc">
                            After exploring the charming culture and night views of Hoi An, your private cab will comfortably drive you back to your hotel in Da Nang.
                        </p>
                    </li>
                </ul>

                <!-- Inclusions/Exclusions Summary Bar -->
                <div class="day-summary-footer">
                    <span class="inc-label">✔ Inclusions:</span> Domestic flight ticket, Private airport transfers, Private 5-hr Hoi An cab, Accommodation (CP).<br>
                    <span class="exc-label">✖ Exclusions:</span> Lunch, Dinner, drinks, Coconut boat ride ticket, personal expenses.
                </div>

            </div>
        </div><!--day 4-->
        <div class="day-block">
            <!-- Header -->
            <div class="day-header">
                <span class="day-badge">DAY 5</span>
                <h3 class="day-title">Ba Na Hills & Iconic Golden Bridge</h3>
            </div>

            <!-- Main Content -->
            <div class="day-body">
                
                <ul class="activity-list">
                    <li class="activity-item">
                        <span class="activity-title">Morning Departure:</span>
                        <p class="activity-desc">
                            Enjoy a wholesome breakfast at your hotel before your private vehicle picks you up for a scenic drive to Ba Na Hills.
                        </p>
                    </li>

                    <li class="activity-item">
                        <span class="activity-title">Ba Na Hills & Golden Bridge Exploration:</span>
                        <p class="activity-desc">
                            Ascend via cable car to marvel at the iconic Golden Bridge held by giant stone hands. Spend the day exploring the French Village, Le Jardin D'Amour gardens, and exciting rides at Fantasy Park.
                        </p>
                    </li>

                    <li class="activity-item">
                        <span class="activity-title">Return Transfer:</span>
                        <p class="activity-desc">
                            After a full day of sightseeing, descend via cable car and relax as your private transfer comfortably takes you back to your hotel in Da Nang.
                        </p>
                    </li>
                </ul>

                <!-- Inclusions/Exclusions Summary Bar -->
                <div class="day-summary-footer">
                    <span class="inc-label">✔ Inclusions:</span> Private transfers, Ba Na Hills entry & cable car tickets.<br>
                    <span class="exc-label">✖ Exclusions:</span> Lunch, Dinner, drinks, personal expenses.
                </div>

            </div>
        </div><!--day 5-->
        <div class="day-block">
            <!-- Header -->
            <div class="day-header">
                <span class="day-badge">DAY 6</span>
                <h3 class="day-title">Departure & Journey Home</h3>
            </div>

            <!-- Main Content -->
            <div class="day-body">
                
                <ul class="activity-list">
                    <li class="activity-item">
                        <span class="activity-title">Breakfast & Hotel Check-out:</span>
                        <p class="activity-desc">
                            Enjoy your final breakfast at the hotel and complete the check-out procedure.
                        </p>
                    </li>

                    <li class="activity-item">
                        <span class="activity-title">Airport Departure Transfer:</span>
                        <p class="activity-desc">
                            Your private vehicle will pick you up from the hotel and provide a smooth transfer to the airport for your onward flight home, marking the end of your memorable trip.
                        </p>
                    </li>
                </ul>

                <!-- Inclusions/Exclusions Summary Bar -->
                <div class="day-summary-footer">
                    <span class="inc-label">✔ Inclusions:</span> Private airport transfer.<br>
                    <span class="exc-label">✖ Exclusions:</span> Lunch, Dinner, drinks, personal expenses.
                </div>

            </div>
        </div><!--day 6-->
        <div class="exclusions-section">
            <div class="exclusions-title">❌ What's Not Included</div>
            <ul class="exclusions-list">
                <li><strong>Airfare:</strong> International & domestic flights (unless specifically mentioned in day inclusions).</li>
                <li><strong>Visa:</strong> Entry visa fees and approval letter processing.</li>
                <li><strong>Meals:</strong> Lunches & dinners (unless explicitly specified in the itinerary).</li>
                <li><strong>Activities:</strong> Cam Thanh Coconut Boat Ride ticket and optional tour add-ons.</li>
                <li><strong>Personal Expenses:</strong> Shopping, tips, porterage, laundry, minibar, spa services, and room service.</li>
                <li><strong>Insurance & Surcharges:</strong> Travel insurance, unexpected tax increases, or fuel surcharges.</li>
                <li><strong>Other:</strong> Anything not explicitly mentioned under the "Inclusions" section of this itinerary.</li>
            </ul>
        </div>
    </main>
    <!-- MAIN CONTENT - PAGE 2 -->
    <main>     

       
        <div class="section-header">Terms & Conditions </div>
        <div class="content-level1">
            <h3>Visa, Immigration and Customs Procedures </h3>
            
            <ul style="list-style: none;" class="ul-lv1">
                <li><span class="bold">1. Visa Specification Details</span>
                    <ul>
                        <li><span class="bold">Visa Type:</span> Tourist Visa (Permits entry for tourism, leisure, or visiting friends/family).</li>
                        <li><span class="bold">Validity & Duration:</span> 30 Days.</li>
                        <li><span class="bold">Entry Type:</span> Single Entry.</li>
                    </ul>                     
                </li><!--Visa Specification Details-->
                <li><span class="bold">2. Visa Application Process & Documentation</span>
                    <ul>
                        <li><span class="bold">Processing Time:</span> Standard Vietnam visa processing typically takes 7–10 working days. Processing may be extended due to public holidays, consulate overload, or administrative background checks.</li>
                        <li><span class="bold">Required Documents:</span>
                            <ul>
                                <li><span class="bold">Passport:</span> Must be valid for at least 6 months beyond the planned entry date, intact with no physical damage, wear and tear, or fraudulent markings, and contain a minimum of 2 blank pages.</li>
                                <li><span class="bold">Photo:</span> Recent passport-sized portrait photo adhering to Immigration Department regulations.</li>
                                <li><span class="bold">Flight Tickets:</span> Confirmed round-trip flight itinerary indicating clear entry and exit dates.</li>
                            </ul>
                        </li>
                        <li><span class="bold">Client Responsibility:</span> Passengers are solely responsible for the authenticity, legality, and condition of all personal identification documents provided.</li>
                        <li><span class="bold">Submission Deadline & Last-Minute Bookings:</span>
                            <ul>
                                <li>For standard visa processing through Plan To Travel, full documentation must be provided at least 30 days prior to departure. We disclaim responsibility for any delays resulting from late submissions.</li>
                                <li>For last-minute bookings (made within 30 days prior to departure) requiring visa assistance, the client agrees to pay any applicable express visa surcharges and assumes all risks associated with potential delays or rejections by immigration authorities.</li>

                            </ul>
                        </li>
                    </ul>                     
                </li><!--Visa Processing & Documentation-->
                <li><span class="bold">3. General Visa Conditions</span>
                    <ul>
                        <li><span class="bold">Accuracy of Information:</span> All submitted details must strictly match the applicant's official passport. Discrepancies may cause application rejection, for which Plan To Travel shall not be held responsible.</li>
                        <li><span class="bold">Embassy Authority & Rejection:</span> Visa approval is at the sole discretion of the Vietnam Immigration Department/Embassy. Plan To Travel acts solely as an application facilitator and accepts no liability for visa delays, rejections, or cancellations.
                        </li>
                        <li><span class="bold">Compliance with Stay Limits:</span> Granted visas carry strict validity dates and permitted stay lengths. Overstaying may incur heavy fines, deportation, or future entry bans.</li>
                        <li><span class="bold">Non-Refundable Visa Fees:</span> All visa application fees are 100% non-refundable once submitted, regardless of the visa application outcome (approval, rejection, or delay).</li>
                    </ul>                     
                </li><!--General Visa Conditions-->
                <li><span class="bold">4. Important Operational Notes</span>
                    <ul>
                        <li><span class="bold">Right of Entry:</span> Holding a valid visa does not guarantee entry into Vietnam. Final entry authorization rests strictly at the discretion of border control immigration officers.</li>
                        <li><span class="bold">Embassy Closures:</span> Processing timelines will automatically extend during government holidays or unscheduled consulate closures.
                        </li>
                        <li><span class="bold">Express Processing:</span> Urgent or express visa processing services are available upon request, subject to additional government/service surcharges and immigration eligibility.</li>
                    </ul>                     
                </li><!--Important Operational Notes-->
            </ul><!--ul-lv1-->

            </div>
            
            <h3 style="margin-bottom: 0px;">General Terms & Conditions </h3>
                <div class="content-level2">
                    <h4 style="margin-bottom: 5px;">1. Booking and Payment Policies </h4>
                        <div style="padding-left: 20px">
                            <p style="font-style: italic;">Note: In these terms, "land cost" refers to all non-flight components of your package (hotels, transfers, activities, etc.). </p>                       
                        <div>
                            <p style="font-weight: bold">A. Bookings with Flights</p>
                            <ul style="list-style: disc;">
                                <li><span class="bold">At time of booking:</span> 100% of flight cost + 10% of land cost.</li>
                                <li>
                                    <span class="bold">Between booking date and 16 days prior to departure:</span> 40% of land cost.</li>
                                <li>
                                    <span class="bold">16 days prior to departure:</span> Remaining 50% balance of land cost.</li>
                            </ul>
                        </div>
                        <div>
                            <p style="font-weight: bold">B. Bookings without Flights</p>
                            <ul style="list-style: disc;">
                                <li> 
                                    <span class="bold">At time of booking:</span> 25% of land cost.</li>
                                <li>
                                    <span class="bold">Between booking date and 16 days prior to departure:</span> 25% of land cost.</li>
                                <li><span class="bold">16 days prior to departure:</span> Remaining 50% balance of land cost.</li>
                            </ul>
                        </div>
                        <div>
                            <p style="font-weight: bold">C. Important Payment Notes</p>
                            <ul style="list-style: disc;">
                                <li> 
                                    <span class="bold">Timely Payment & Default:</span> Prompt payments are required to guarantee and retain your reservations. Failure to settle balance dues by the stipulated deadlines will result in automatic booking cancellation without prior notice, and all prior payments will be forfeited.</li>
                                <li>
                                    <span class="bold">Last-Minute Bookings:</span> For bookings made within 21 days of departure, 100% full payment is required immediately at the time of booking.</li>
                                <li>
                                    <span class="bold">Flight Costs:</span> Flight fares must always be paid in full (100%) upon booking, regardless of travel date.
                                </li>
                                <li>
                                    <span class="bold">Payment Methods Accepted:</span>
                                    <ul>
                                        <li>UPI Payment Gateways</li>
                                        <li>Bank Transfers (NEFT / IMPS / Direct Deposit)</li>
                                        <li>Credit / Debit Cards (subject to a processing fee of up to 2.75%, calculated at checkout)</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </div><!--padding lef 20px-->
                    
                    <h4>2. Force Majeure & Unforeseen Events </h4>
                    <ul style="list-style: disc;">
                        <li>
                            <span class="bold">Limitation of Liability:</span> Plan To Travel shall not be held liable for failure, delay, or disruption of services caused by circumstances beyond reasonable control. This includes, but is not limited to, natural disasters, political instability, health crises/pandemics, volcanic eruptions, strikes, airspace closures, or airline operational disruptions.
                        </li>
                        <li>
                            <span class="bold">Third-Party Terms:</span> In such cases, refunds or booking adjustments are subject strictly to the cancellation and refund policies of third-party suppliers (airlines, hotels, transport providers). We cannot guarantee refunds or free rebookings.
                        </li>
                        <li>
                            <span class="bold">Additional Expenses:</span> Any supplementary expenses arising from force majeure events—including fare differences for alternative flights or extended accommodation—remain the responsibility of the traveler. 
                        </li>
                    </ul>
                    <h4>3. Pricing & Availability </h4>
                    <ul style="list-style: disc;">
                        <li>
                            <span class="bold">Price Modifications:</span>  Quotations and published rates are subject to change without prior notice. In the event of a pricing error, we will notify you promptly, allowing you the option to accept the corrected rate or cancel without penalty.
                        </li>
                        <li>
                            <span class="bold">Real-time Availability:</span>  Airline seats, hotel rooms, and excursion spots are subject to live availability at the time of final booking confirmation.
                        </li>
                    </ul>

                    <h4>4. Cancellation and Refund Policy </h4>
                    <p style="font-style: italic;">Written notification by the lead traveler is required for all cancellations.</p>
                    <ul id="cancellations" style="list-style: none;">
                        <li>
                            <span class="bold">A. Cancellation Fees (Hotels, Activities & Transfers)</span>
                            <ul>
                                
                                <li>
                                    <span class="bold">More than 45 days prior to departure:</span>  10% deduction of total package cost (plus any non-refundable supplier components).
                                </li>
                                <li>
                                    <span class="bold">Between 45 and 21 days prior to departure:</span>  25% deduction of total package cost (plus any non-refundable supplier components). 
                                </li>
                                <li>
                                    <span class="bold">Within 21 days of departure:</span>  100% non-refundable (full package cost forfeited).
                                </li>
                            </ul>
                        </li>
                                
                              
                        <li><span class="bold">B. Flight Cancellations:</span>  
                            <ul>
                                <li>
                                    <span class="bold">Low-Cost Carriers (LCC):</span>  Tickets on budget airlines (e.g., VietJet Air, AirAsia, Scoot, Batik Air) are strictly non-cancellable and non-refundable. 
                                </li>
                                <li>
                                    <span class="bold">Full-Service Carriers (FSC):</span>  Airlines such as Thai Airways, Lufthansa, Singapore Airlines, etc., are governed by their respective fare rules. Refunds/penalties will be processed strictly per airline policy. 
                                </li>
                            </ul>
                        </li>

                        <li><span class="bold">C. Booking Modifications Requested by Guests: </span>
                            <ul>
                                <li>
                                    <span class="bold">Amendments & Adjustments:</span>  Any request to alter or amend an itinerary must be submitted in writing by the lead guest named on the booking. Modification charges and rate adjustments may apply and tend to increase closer to the departure date. 
                                </li>
                                <li>
                                    <span class="bold">Non-Amendable Components:</span>  Certain flight tickets, hotel promotional rates, or activity passes are strictly non-amendable once confirmed. Modifying these components may result in up to 100% cancellation/reissuance charges. 
                                </li>
                            </ul>
                        </li>
                        <li><span class="bold">D. Refund Terms & Timelines:</span> 
                            <ul>
                                <li>
                                    <span class="bold">Standard Processing Time:</span>  Approved refunds are typically initiated within 3–4 working days and completed within 7 working days from the official confirmation date.
                                </li>
                                <li>
                                    <span class="bold">Refund Method:</span>  Reimbursements will be credited back to the original payment method. If a reversal to the original channel is not feasible, the refund will be transferred directly to the primary buyer’s verified bank account within 7 working days following account verification.
                                </li>
                                <li>
                                    <span class="bold">Activity Refunds:</span> 
                                    <ul>
                                        <li>Refunds for unfulfilled or non-operational paid activities will be processed within 7 working days post-trip completion (or up to 30 working days depending on local third-party vendor reconciliation).</li>
                                        <li><span class="bold">Complimentary Services:</span>  No refunds or cash equivalencies will be provided for complimentary or non-charged activities that are canceled or skipped.</li>
                                      
                                    </ul>
                                </li>
                            </ul>
                        </li>                          
                     
                        <li>
                            <span class="bold">E. Partial Cancellations & Group Changes</span>
                            <p>If a subset of travelers within a single group booking cancels, package costs for the remaining travelers will be recalculated, which may result in single-occupancy or extra room surcharges.</p>
                        </li>
                        <li>
                            <span class="bold">F. Modifications or Cancellations by Us</span> 
                            <p>We reserve the right to correct errors or adjust itineraries both before and after booking confirmation. In the rare event of a major itinerary alteration or cancellation initiated by us, travelers will be notified as soon as possible and offered the choice to:</p>
                            <ul>
                                <li>
                                    1. Accept the revised travel arrangements.
                                </li>
                                <li>
                                    2. Switch to an alternative package of equivalent standard (with price differentials refunded or charged accordingly).
                                </li>
                            </ul>
                        </li>
                    </ul> <!-- cancel ul -->

                </div><!--content level2-->
        </div><!--content level1-->
        




<div class="section-header">Hotels & Flights</div> 
<div class="content-level1">
    <h3>Hotel & Accommodation Terms: </h3>
    <ul>
        <li><span class="bold">Bedding Preferences:</span> Bed types (e.g., King/Double, Twin, or Sofa Bed) are subject to hotel/cruise availability upon check-in and cannot be guaranteed in advance.</li>
        <li><span class="bold">Room Occupancy & Extra Beds:</span> Maximum room capacity is 3 adults. The third adult occupant will be provided with an extra rollaway bed or mattress. Requests for extra beds for children must be arranged directly with the hotel.</li>
        <li><span class="bold">Hotel Substitutions:</span> If a confirmed hotel becomes unavailable due to operational reasons, an alternative property of an equivalent star rating and category will be provided.</li>
        <li><span class="bold">Check-in / Check-out Policy:</span> Standard check-in time is 2:00 PM and check-out is 11:00 AM. Early check-in or late check-out is subject to room availability and may incur additional hotel charges.</li>
        <li><span class="bold">Incidental / Security Deposit:</span> Certain hotels may collect a refundable security deposit upon check-in (via cash or credit card authorization) to cover incidental charges, fully refundable upon check-out as per hotel policy.</li>
        <li><span class="bold">Personal Incidental Expenses:</span> Any personal expenses outside the agreed tour package (e.g., room service, minibar, laundry, telephone calls) must be settled directly by the guest prior to check-out.</li>
    </ul>
    <h3>Flights Terms & Conditions </h3>
    <div class="content-level2">
        <p style="font-weight: bold; margin-top: 5px;">Flight Status & Schedule Changes: </p>
        <ul>
            <li><span class="bold">Flight Status Verification:</span> Travelers are advised to reconfirm flight schedules 24 hours prior to departure, as airline timetables are subject to change without prior notice.</li>
            <li><span class="bold">Airline Schedule Changes, Cancellations & Rerouting:</span> Airlines reserve the right to reschedule, reroute, or cancel flights independently. As a booking facilitator, Plan To Travel shall not be held liable for any direct or incidental losses resulting from airline schedule modifications, delays, or cancellations.</li>
            <li>Rescheduling & Fare Differences:</span> Should flight rebooking or rescheduling become necessary, any applicable fare differences and airline modification fees shall be borne by the traveler. New fare options will be presented for your approval prior to processing. If declined, a refund may be requested subject to the operating airline's policy.</li>  
        </ul>
         
        <p style="font-weight: bold">Refunds: </p>
        <ul>
            <li><span class="bold">Processing Timeline:</span> Eligible flight refunds typically take 7–21 working days to process, depending on the airline’s internal procedures and policy timelines.</li>
        </ul>
        <p style="font-weight: bold">Baggage Allowance: </p>
        <ul>
            <li><span class="bold">Standard Allowance:</span> Allowance limits vary by airline, route, and fare class. It is the traveler’s responsibility to verify the specific baggage entitlement for their ticket.</li>
            <li><span class="bold">Excess Baggage:</span> Baggage exceeding the permitted allowance will incur additional fees per airline rates, payable directly by the passenger.</li>
        </ul>

        <p style="font-weight: bold">Name Changes & Corrections: </p>
        <ul>
            <li><span class="bold">Ticket Amendments:</span> Corrections or name updates post-issuance are subject strictly to airline regulations. Certain airlines prohibit name changes entirely, which may require ticket cancellation and re-issuance at the traveler’s expense.</li>
        </ul>
        <p style="font-weight: bold">No-Show Policy: </p>
        <ul>
            <li><span class="bold">Non-Refundable:</span> Passengers who fail to check in or board their scheduled flight will be classified as a "no-show." Under standard airline policies, the ticket will be non-refundable, and the full fare will be forfeited.</li>
        </ul>

        <p style="font-weight: bold">Important Operational Notes: </p>
        <ul>
            <li><span class="bold">Missed Flights:</span> Plan To Travel is not responsible for missed flights due to personal circumstances, late airport arrivals, incorrect date selection, or failure to comply with airline check-in deadlines.</li>
            <li><span class="bold">Connecting Flights & Layovers:</span> For multi-leg itineraries, travelers must ensure sufficient layover time. Plan To Travel assumes no liability for missed connections due to initial flight delays or unforeseen circumstances.</li>
            <li><span class="bold">Travel Documentation:</span> Travelers are solely responsible for ensuring they possess valid passports (minimum 6 months validity), required visas, and relevant travel permits. Boarding refusal by airlines due to incomplete documentation remains the sole responsibility of the traveler.
         </li>
        </ul>        
    </div><!--content-level2-->
   
</div><!--content-level1-->


<div class="section-header">Tours and Transfers </div>
<div class="content-level1">
    <h3>General Transfers Regulations: </h3>
    <ul>
        <li><span class="bold">Seat-in-Coach (SIC) Transfers:</span> Vehicles operate on a shared basis with other passengers. Please be at the designated pickup point or hotel lobby at least 5 minutes prior to the scheduled time. Delays of 30–45 minutes may occur due to traffic or pickups at other hotels.</li>
        <li><span class="bold">Maximum Waiting Time:</span> SIC transfers will wait a maximum of 5 minutes at the pickup point. Beyond this window, clients must arrange their own transport to the tour location at their own expense.</li>
        <li><span class="bold">Driver Tipping Policy:</span>
            <ul>
                <li>Driver gratuity is set at USD 3 per person / day for private half-day or full-day tours (not mandatory for airport transfers).</li>
                <li>This amount may be included in the total prepaid package invoice or paid directly on-site, as indicated in your booking confirmation.</li>
            </ul>
        </li>   
    </ul>
     
    <h3>Drivers and Vehicles: </h3>
    <ul>
        <li><span class="bold">Drivers:</span> Drivers might speak basic English and provide essential 
    information about tour sites. Comprehensive guides can be arranged at an 
    additional cost.</li>
        <li><span class="bold">Vehicles:</span> The type of vehicle provided depends on the number of 
    travelers. Extra charges will apply for additional vehicles or larger capacity 
    vehicles due to excess or oversized luggage.</li>
        <li>Activity times are fixed. In case of vehicle usage beyond the expected 
    time, additional charges may incur.</li>   
    </ul>

    <h3>Activity-Specific Terms & Conditions: </h3>
    <ul>
        <li><span class="bold">Weather & Force Majeure:</span> In the event of rain, severe weather, or natural conditions affecting the tour, no refunds will be provided for any cancellations, schedule modifications, or missed activities.</li>
        <li><span class="bold">Activity Adjustments:</span> Activity sequences and options are subject to local availability, operational schedules, and physical conditions.</li>
        <li><span class="bold">Water Sports:</span> 
            <ul>
                <li>All water activities are strictly weather-dependent and non-refundable.</li>
                <li>Upgrades to alternative activities due to weather conditions may be offered, subject to guest consent and applicable surcharges.</li>
                <li>Standard parasailing relies on water currents; Adventure Parasailing may be made available as an upgraded option with additional charges.</li>          
            </ul>
        </li>
        <li><span class="bold">Trekking & Hiking:</span> Trekking activities may be canceled at any time without prior notice in compliance with revised local government regulations or safety mandates.</li>
    </ul> 
</div><!--content-level1-->

<div class="section-header">Exclusions </div>
<div class="content-level1">
    </div>
<ul>
    <li><span class="bold">Documents & Taxes:</span> Passport fees, immunizations, local city taxes, and airport departure taxes </li>
    <li><span class="bold">Flights & Visas:</span> Any flights, visa fees, or travel insurance (unless explicitly specified in inclusions) </li>
    <li><span class="bold">Meals & Baggage:</span> Unspecified meals/drinks and excess baggage charges.</li>
    <li><span class="bold">Upgrades & Extras:</span> Flight/room upgrades, optional sightseeing/activities, and local camera/video fees.</li>
    <li><span class="bold">Gratuities:</span> Tips for guides, drivers, and service staff. </li>
</ul>
<div class="section-header">Important Notes </div>
<div class="content-level1">
    <ul>
        <li><span class="bold">Itinerary Changes:</span> Timing and schedules are indicative and subject to change due to traffic, local ceremonies, road closures, or attraction operating hours.</li>
        <li><span class="bold">Driver Waiting Time:</span>
            <ul>
                <li><span class="bold">Airport Arrivals:</span> Maximum 2 hours from scheduled land time (extended in case of flight delays).</li>
                <li><span class="bold">Other Pickups:</span> Maximum 1 hour from the designated pickup time.</li>
            </ul>
        </li>
    </ul>
</div><!--content-level1-->

<div class="section-header">Important Tax & Payment Updates (TCS) </div>
<div class="content-level1">
    <p>Any Tax Collected at Source (TCS) applicable under the laws of the Government of India shall be borne by the traveler or the booking agent in India. Plan To Travel shall not be responsible for the collection or payment of such taxes. Travelers are advised to consult their tax advisor regarding the eligibility to claim TCS as a tax credit when filing their Income Tax Return (ITR)</p>
    <h3>Terms & Conditions for Add-Ons </h3>
    <ul style="list-style: none;">    
        <li>
            <span class="bold">1. Form-Filling Assistance Services</span> 
            <ul>    
                <li><span class="bold">Service Fee:</span> INR 500 per person, per form (plus 18% GST)</li>
                <li><span class="bold">Scope:</span> Assistance with Vietnam travel documentation, including visa applications (where applicable), visa support documents, arrival information, immigration declarations, travel forms, and other documentation required for entry into or travel within Vietnam. Plan To Travel provides assistance only and does not guarantee the approval of any visa, entry permit, or immigration application, as all decisions are made solely by the relevant government authorities.</li>        
                <li><span class="bold">Liability:</span> Guests are responsible for providing accurate and complete information. The service provider accepts no liability for errors or delays resulting from incorrect details submitted by the guest.</li>
            </ul>
        </li>
        <li>
            <span class="bold">2. Travel Insurance Facilitation</span>
            <ul>
                <li><span class="bold">Service Fee:</span> Provider’s Policy Rate + INR 500 facilitation fee per person (plus 18% GST)</li>
                <li><span class="bold">Terms:</span> The policy is governed strictly by the terms and conditions of the insurance provider. Guests are strongly advised to thoroughly review policy coverage, inclusions, and exclusions prior to departure.</li> 
            </ul>
        </li>
        <li>
            <span class="bold">3. Web Check-In Services </span>
            <ul>
                <li><span class="bold">Service Fee:</span> INR 500 per person, per flight segment (plus 18% GST)</li>
                <li><span class="bold">Terms:</span>
                    <ul>
                        <li>Web check-in will be processed based on the details supplied by the guest.</li>
                        <li>Post-check-in modifications, seat adjustments, or corrections may not be permitted and remain subject entirely to individual airline policies.</li>
                    </ul>
                </li> 
            </ul>
        </li>
        <li>
            <span class="bold">4. Custom Certificate & Document Formatting (Wedding / Anniversary)</span>
            <ul>
                <li><span class="bold">Service Fee:</span> INR 2,000 per document (plus 18% GST)</li>
                <li><span class="bold">Scope:</span> Customization or creation of standard wedding cards or anniversary certificates upon guest request.</li> 
                <li><span class="bold">Terms:</span> This service covers standard design templates and minor text edits. Complex design requests or advanced custom layouts may incur additional design fees.</li>
            </ul>
        </li>
        <li>
            <span class="bold">5. Third-Party Reservation Support (External Bookings) </span>
            <ul>
                <li><span class="bold">Service Fee:</span> INR 1,000 per query (plus 18% GST)</li>
                <li><span class="bold">Scope:</span> Liaison and coordination services for hotels or flight bookings not originally reserved through our agency platform.</li> 
                <li><span class="bold">Terms:</span> Our service includes actively following up and communicating on the guest’s behalf; however, final resolutions and outcomes are governed strictly by the respective third-party provider's policies.</li>
            </ul>
        </li>    
    </ul>

    <h3>General Terms for Add-On Services</h3>
    <ul>
        <li>Non-refundable Policy: Add-on service fees are non-refundable once service processing has commenced.</li>
        <li>Payment Terms: Add-on services will be initiated upon receipt of full payment. </li>
        <li>Guest Responsibilities: Timely submission of required documents is necessary to ensure on-schedule service delivery.</li>
        <li>Applicable Taxes: Statutory taxes (including GST) will be applied in accordance with prevailing government regulations at the time of invoicing.</li>
        <li>Optional Availability: Add-on services are strictly optional and availed at the guest's discretion.</li>
    </ul>
    <h3>RESPONSIBILITY & SAFETY GUIDELINES</h3>
    <ul>
        <li><span class="bold">Limitation of Liability:</span> <br>
    Plan To Travel acts solely as an intermediary coordinating between guests and independent service providers (hotels, transport, activities). While we prioritize your safety and seamless execution, the company shall not be held liable for personal injuries, accidents, medical emergencies, or loss of personal belongings occurring during the trip.</li>
        <li><span class="bold">Comprehensive Travel Insurance Recommendation:</span> <br>
    To ensure total peace of mind, travelers are strongly advised to secure comprehensive travel insurance covering medical expenses, trip interruptions, personal accidents, and emergency evacuations prior to departure.</li>
        <li><span class="bold">Indemnification:</span> <br>
    By confirming this booking, guests agree to release Plan To Travel, its employees, and local partners from any legal claims or financial liabilities arising from unforeseen personal accidents or health emergencies during the tour. </li>
        <li><span class="bold">Emergency Support Protocol:</span> <br>
    In the event of a medical emergency or severe incident:
            <ul>
                <li>Contact local emergency medical services or authorities immediately. </li>
                <li>Notify our 24/7 support line so our team can assist with local coordination, documentation, and emergency support.</li>          
            </ul>
        </li>   
    </ul>
</div><!--end content-level1-->
<p style="font-style: italic;margin-top: 40px; color: #c72d66">
Should you have any questions or require further clarification, please do not hesitate to contact our customer support team.

Wishing you safe travels and an unforgettable holiday with <span class="bold">Plan To Travel</span>!
</p>


    </main>

</body>
</html>