<html>
<head>
    <title>Invoice PDF</title>
    {{--    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">--}}
</head>
<body>
<table width="100%" class="table">

    <tbody>
    <tr>
        <td width="10%"><strong></strong></td>
        <td width="60%">
            <span style="font-size: 20px; background: #1781BF; padding: 3px 10px 3px 10px; color: #fff;">
                Shapla Shopping Mall
            </span><br>
            Uttar-badda, dhaka
        </td>
        <td width="30%">
            <span>
                showroom: 0192454545 <br>
                Owner No : 01454545456
            </span>
        </td>
    </tr>
    </tbody>
</table>
<hr>
<table class="table">
    <tbody>
    <tr>
        <td width="20%"></td>
        <td width="70%">
            <u><strong><span style="font-size: 15px">
                        Daily Invoice Report({{ date('Y-m-d', strtotime($start_date)) }} - {{ date('Y-m-d', strtotime($end_date)) }})
                    </span></strong></u>
        </td>
        <td width="10%"></td>
    </tr>
    </tbody>
</table>
<hr>
<table border="1" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>Sl.</th>
        <th>Customer Name</th>
        <th>Invoice No</th>
        <th>Date</th>
        <th>Description</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>
    @php
        $total_sum = 0;
    @endphp
    @forelse($allData as $key => $invoice)
        <tr>
            <td>{{$key+1}}</td>
            <td>
                {{$invoice->payment->customer->name}} -
                {{$invoice->payment->customer->phone}} -
                {{$invoice->payment->customer->address}}

            </td>
            <td>Invoice No #{{ $invoice->invoice_no }}</td>
            <td>{{ date('d-m-Y', strtotime($invoice->date)) }}</td>
            <td>{{$invoice->description}}</td>
            <td>{{$invoice['payment']['total_amount']}}</td>

        </tr>
        @php
            $total_sum += $invoice['payment']['total_amount'];
        @endphp
    @empty
    @endforelse
    <tr>
        <td colspan="5" style="text-align: right"><strong>Grand Total</strong></td>
        <td>{{ $total_sum }}</td>
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
                        <p style="text-align: center;">Owner Signature</p>
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
