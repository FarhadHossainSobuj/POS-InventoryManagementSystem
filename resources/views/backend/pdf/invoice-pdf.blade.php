<html>
<head>
    <title>Invoice PDF</title>
{{--    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">--}}
</head>
<body>
@php
    $payment = \App\Models\Payment::where('invoice_id', $invoice->id)->first();
@endphp
<table width="100%" class="table">

    <tbody>
    <tr>
        <td><strong>Invoice No: #{{ $invoice->invoice_no }}</strong></td>
        <td>
            <span style="font-size: 20px; background: #1781BF; padding: 3px 10px 3px 10px; color: #fff;">
                Shapla Shopping Mall
            </span><br>
            Uttar-badda, dhaka
        </td>
        <td>
            <span>
                showroom: 0192454545 <br>
                Owner No : 01454545456
            </span>

        </td>
    </tr>
    <tr>
        <td width="30%"></td>
        <td width="40%">
            <u><strong><span style="font-size: 15px">Customer Invoice</span></strong></u>
        </td>
        <td width="30%"></td>
    </tr>
    <tr></tr>
    <tr>
        <td width="30%"><p><strong>Name : </strong> {{ $payment['customer']['name'] }}</p></td>
        <td width="30%"><p><strong>Phone : </strong> {{ $payment['customer']['phone'] }}</p></td>
        <td width="40%"><p><strong>Address : </strong> {{ $payment['customer']['address'] }}</p></td>
    </tr>
    <tr>
        <td width="30%"></td>
        <td width="40%"><u>Customer Invoice</u></td>
        <td width="30%"></td>
    </tr>
    </tbody>
</table>
<table class="table" border="1" width="100%">
    <thead>
    <tr class="text-center">
        <th>Sl.</th>
        <th>Category</th>
        <th>Product Name</th>
        <th class="text-center" style="background: #ddd; padding: 1px;">Current Stock</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Total Price</th>
    </tr>
    </thead>
    <tbody>
    @php
        $total_sum = '0';
    @endphp
    @foreach($invoice['invoice_details'] as $key => $details)
        <tr class="text-center">
            <input type="hidden" name="category_id[]" value="{{ $details->category_id }}">
            <input type="hidden" name="product_id[]" value="{{ $details->product_id }}">
            <input type="hidden" name="selling_qty[{{ $details->id }}]" value="{{ $details->selling_qty }}">
            <td>{{ $key+1 }}</td>
            <td>{{ $details['category']['name'] }}</td>
            <td>{{ $details['product']['name'] }}</td>
            <td class="text-center" style="background: #ddd; padding: 1px;">
                {{ $details['product']['quantity'] }}
            </td>
            <td>{{ $details->selling_qty }}</td>
            <td>{{ $details->unit_price }}</td>
            <td>{{ $details->selling_price }}</td>
        </tr>
        @php
            $total_sum += $details->selling_price;
        @endphp
    @endforeach
    <tr  class="text-center">
        <td colspan="6" class="text-right"><strong>Sub Total</strong></td>
        <td><strong>{{ $total_sum }}</strong></td>
    </tr>
    <tr  class="text-center">
        <td colspan="6" class="text-right">Discount</td>
        <td><strong>{{ $payment->discount_amount }}</strong></td>
    </tr>
    <tr  class="text-center">
        <td colspan="6" class="text-right">Paid Amount</td>
        <td><strong>{{ $payment->paid_amount }}</strong></td>
    </tr>
    <tr  class="text-center">
        <td colspan="6" class="text-right">Due Amount</td>
        <td><strong>{{ $payment->due_amount }}</strong></td>
    </tr>
    <tr  class="text-center">
        <td colspan="6" class="text-right"><strong>Grand Total</strong></td>
        <td><strong>{{ $payment->total_amount }}</strong></td>
    </tr>

    </tbody>
</table>
<div class="container">
    @php
        $date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
    @endphp
    <i>Printing time : {{ $date->format('F j, Y, g:i a') }}</i>
    <div class="row">
        <div class="col-md-12">
            <hr style="margin-bottom: 0px;">
            <table class="table" border="0" width="100%">
                <thead>
                <tr>
                    <td style="width: 40%;">
                        <p style="text-align: center; margin-left: 20px;">Customer Signature</p>
                    </td>
                    <td style="width: 20%"></td>
                    <td style="width: 40%; text-align: center;">
                        <p style="text-align: center;">Seller Signature</p>
                    </td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
