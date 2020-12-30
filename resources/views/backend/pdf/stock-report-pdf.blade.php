<html>
<head>
    <title>Stock Report PDF</title>
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

<h4 style="text-align: center; margin: 0 auto;">
    <u><strong><span style="font-size: 15px;">
                        Stock Report
                        </span></strong></u>
</h4>

<hr>

<table border="1" id="example1" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>Sl.</th>
        <th>Product Name</th>
        <th>Supplier</th>
        <th>Category</th>
        <th>Stock</th>
        <th>Unit</th>
    </tr>
    </thead>

    <tbody>
    @forelse($products as $key => $product)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->supplier->name}}</td>
            <td>{{$product->category->name}}</td>
            <td>{{$product->quantity}}</td>
            <td>{{$product->unit->name}}</td>
        </tr>
    @empty
    @endforelse

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
