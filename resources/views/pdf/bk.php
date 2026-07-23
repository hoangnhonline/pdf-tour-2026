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

       
        <div class="section-header">Terms & Conditions </div>
        <h3>Visa, Immigration and Customs </h3>
        <div>
        <span class="bold">Type of Visa</span>: Tourist Visa <br>
        This visa permits the applicant to visit Vietnam for a holiday or recreation or to 
        visit family and / or Friends for a stay </div>
        <p><span class="bold">Duration</span>: 30 Days </p>
        <p><span class="bold">Entry Type</span>: Single </p>
        <p><span class="bold">Visa Processing:</span> <br>
        <span class="bold">Processing Time:</span> The visa for Vietnam is typically processed within <span class="bold">7-10 
        working days</span>. However, delays may occur due to unforeseen 
        circumstances beyond our control, such as government holidays or 
        processing backlogs at the embassy. 
        </p>
        <div>
        <span class="bold">Documents Required:</span> To apply for a Vietnam visa, the following documents 
        must be submitted: 
        <ul style="list-style: none;">
            <li>
        <span class="bold">1. Passport:</span> A valid passport with <span class="bold">at least 6 months</span> of validity from the 
        intended date of entry into Vietnam. The passport must also have at least 
        2 blank pages. 
        </li>
        <li>
        <span class="bold">2. Photograph:</span> A recent passport-sized photograph (as per embassy 
        specifications). 
        </li>
        <li>
        <span class="bold">3. Flight Tickets:</span> A confirmed flight itinerary showing entry and exit dates 
        for Vietnam. 
        </li>
        <li>
        4. Guest holds the responsibility of presenting the valid documents to the 
        relevant authority with proper validity, no wear and tear and no fraudulent 
        markings. 
        </li>
        <li>
        5. If the Visa processing is booked via <span class="bold">Plan To Travel</span>, all documents to be 
        provided as per the Vietnam embassy checklist <span class="bold">atleast 30 days</span> prior to 
        travel. Beyond which <span class="bold">Plan To Travel</span> will not be held accountable for probable 
        delays 
        </li>
        </ul>
        </div>
        <div>
        <p><span class="bold">General Conditions:</span> </p>
        <ul style="list-style: disc;">
            <li>
        <span class="bold">Accuracy of Information:</span> All details submitted must be accurate and 
        correspond to the information in your passport. Any discrepancies may 
        result in visa rejection, for which we are not responsible. 
        </li><li>
        <span class="bold">Visa Rejection or Delays:</span> We are not liable for any delays, rejections, or 
        cancellations of the visa application by the Vietnam Immigration 
        Department or Embassy. 
        </li><li>
        <span class="bold">Visa Validity and Stay Duration:</span> The visa granted will have specific 
        validity and permitted duration of stay. Overstaying your visa may result 
        in fines, deportation, or being barred from re-entering Vietnam in the 
        future. 
        </li><li>
        <span class="bold">Non-Refundable Fees:</span> Visa fees are non-refundable once the application 
        is submitted, irrespective of whether the visa is approved, delayed, or 
        rejected.
        </li>
        </ul>
        </div>
        <div>

        <p><span class="bold">Important Notes:</span> </p>
        <ul style="list-style: disc;">
        <li>
        <span class="bold">Entry Approval:</span> Possession of a visa does not guarantee entry into 
        Vietnam. Entry is at the discretion of the immigration officers at the point 
        of entry. 
        </li><li>
        <span class="bold">Embassy Closure:</span> Processing times may be extended if the embassy or 
        consulate is closed due to holidays or any other reasons. 
        </li><li>
        <span class="bold">Urgent Visa Processing:</span> In case of an urgent visa requirement, please 
        contact us for express visa options, subject to additional charges and 
        embassy regulations. 
        </li>
        </ul>
        </div>

<div class="section-header">General Conditions </div>
<h3>Booking and Payment Policies </h3>
<p style="font-style: italic;">In these terms, "land cost" refers to all non-flight components of your package. </p>
<div>

<p style="font-weight: bold">1.Bookings with Flights</p>
<ul style="list-style: disc;">
 <li> 
<span class="bold">At the time of booking:</span> 100% of flight cost + 10% of land cost </li>
<li>
<span class="bold">Exactly between booking date and 16 days before departure:</span> 40% of land cost 
</li>
<li>
<span class="bold">16 days before departure:</span> The remaining 50% of land cost 
</li>
</ul>
</div>
<div>
    <p style="font-weight: bold">2. Bookings without Flights</p>
    <ul style="list-style: disc;">
        <li> 
            <span class="bold">At the time of booking:</span> 25% of land cost  
        </li>
        <li>
            <span class="bold">Exactly between booking date and 16 days before departure:</span> 25% of land cost 
        </li>
        <li>
            <span class="bold">16 days before departure:</span> The remaining 50% of land cost 
        </li>
    </ul>
</div>
<h3>Important Notes: </h3>
<ul style="list-style: disc;">
    <li>
        <span class="bold"> Failure to Pay:</span> Timely payment is essential to confirm and retain your 
        booking. All hotel bookings and associated services must be paid in full by 
        the stipulated due date. Failure to make the payment by the due date 
        will result in the automatic release of the booking without prior 
        notice, and any advance payments will be forfeited. 
    </li>
    <li>
        <span class="bold"> Payment for Last-Minute Bookings:</span> For bookings made within 21 days 
        of the departure date, 100% of the total cost is required at the time of 
        booking. 
    </li>
    <li>
        <span class="bold"> Flight Payments:</span> Flight costs must always be paid in full at the time of 
    booking, irrespective of the departure date. 
    </li>
    <li>
        <span class="bold">Payment Methods:</span> We accept payments via internet banking and bank 
    transfers. 
        <ul style="list-style: disc;">
            <li>UPI</li>
            <li>Bank transfer (NEFT/IMPS)</li>
            <li>Credit/Debit Card (upto 2.75% depending on card. The exact 
        amount will be available at the checkout)</li>
        </ul>
    </li>
</ul>
<h3>Force Majeure </h3>
<ul style="list-style: disc;">
    <li>
        Plan To Travel is not liable for any loss, damage, or disruption caused by 
    events beyond our reasonable control, including but not limited to natural 
    disasters, political unrest, health crises (e.g. pandemics), volcanic 
    eruptions, airline strikes, airspace closures, or airline operational failures, 
    or other unforeseen circumstances. 
    </li>
    <li>
        In such events, refunds or changes are subject to the policies of 
    third-party service providers such as airlines, hotels, or tour operators, 
    and we cannot guarantee a refund or rebooking. 
    </li>
    <li>
        Any additional costs incurred as a result of such events — including fare 
    differentials on alternate flights — will be the responsibility of the traveller. 
    </li>
</ul>
<h3>Price and Availability </h3>
<ul style="list-style: disc;">
    <li>
        <span class="bold">Price Changes:</span> Prices may change at any time. If an incorrect price is 
    shown, we will notify you as soon as possible. You may choose to accept 
    the correct price or cancel the booking. 
    </li>
    <li>
        <span class="bold">Availability:</span> Airline seats and hotel rooms are subject to availability at the time of booking. 
    </li>
</ul>

<h3>Cancellation and Refund Policy </h3>
<ul id="cancellations">
    <li>
        <span class="bold">Cancellation by You:</span> Cancellations must be made in writing by the lead 
name on the booking. Charges are dependent upon the type of booking 
(Some bookings are non-refundable).
        <ul>
            <li>Hotels, Activities, and Transfers: 
                <ul>
                    <li>
                        10% of the total package value deduction for 
                    cancellations made more than 45 days before the travel date 
                    excluding non-refundable components. 
                    </li>
                    <li>
                        25% of the total package value deduction for 
                        cancellations made between 45–21 days before the travel 
                        date excluding non-refundable components. 
                    </li>
                    <li>
                        100% of the total package value deduction for 
                        cancellations made within 21 days of the travel date 
                        excluding non-refundable components. 
                    </li>
                </ul>
            </li><!-- Hotels, Activities, and Transfers-->
          
            <li>
                Flights: 
                <ul>
                    <li>
                        Low-Cost Carriers (LCC): Airlines such as VietJet, AirAsia, 
                        Scoot, and Batik Air are non-cancellable and 
                        non-refundable. 
                    </li>
                    <li>
                        Full-Service Carriers (FSC): Airlines such as Thai Airways, 
                        Lufthansa, Singapore Airlines, etc., are subject to their 
                        respective cancellation and refund policies. Any penalties 
                        or refunds will be based on the airline’s terms. 
                    </li>
                </ul>
            </li>
        </ul>
        </li><!--Cancellation by You-->
        <li>
            <span class="bold">Partial Cancellations:</span> If only some members cancel, the holiday cost 
will be recalculated for remaining travelers, potentially resulting in extra 
room charges. 
        </li>
        <li>
            <span class="bold">Changes by Us:</span> We reserve the right to make changes or correct errors 
before and after bookings are confirmed. We also reserve the right to 
cancel bookings at any time. <br>
            <span class="bold">Major Changes:</span> In case of major changes or cancellations, we will 
inform you as soon as possible and offer the choice of:
            <ul>
                <li>
                    Accepting the changed arrangements. 
                </li>
                <li>
                    Purchasing alternative arrangements of similar standard (price differences will be refunded or charged accordingly).
                </li>
            </ul>
        </li>
</ul> <!-- cancel ul -->

 
<h3>Refunds: </h3>
<ul>
    <li><span class="bold">Processing Time:</span> Refunds are typically processed within 3-4 working 
days but may take up to 7 working days from day of confirmation. </li>
    <li><span class="bold">Mode:</span> Refunds will be made to the original payment method. If not 
possible, a refund may be done to the buyer's bank account after 
verification, which may take upto 7 working days. </li>
    <li><span class="bold">Activity Refunds:</span> Refunds for non-operational paid activities will be 
processed within 7 days post trip completion. No refunds for 
complimentary activities not charged to Couple Trails. </li>
    <li><span class="bold">Paid Activity Refunds:</span> Refunds of non-operational paid activities will be 
processed within 30 days. </li>
</ul>

<h3>Modifications by You: </h3>
<ul>
    <li><span class="bold">Amendments:</span> Changes must be requested by the lead name on the 
booking. Costs may increase closer to the departure date. </li>
    <li><span class="bold">Non-Amendable Arrangements:</span> Some arrangements may not be 
amended once confirmed, and changes may incur up to 100% cancellation 
charges.</li>
</ul>