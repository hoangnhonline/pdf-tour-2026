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