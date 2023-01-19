<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice : {{$order->reference}}</title>
    <style>
        th {
            text-align: left;
            background: #222;
            color: #fff;
        }
        *{
            font-family: monospace
        }
        td, th {
            border: 1px solid #222;
            padding: 10px 20px;
        }
        table {
            width: 100%; border:1px solid black;border-collapse: collapse;
            margin-bottom: 1em;
        }
    </style>
</head>
<body>
    <h1>INVOICE</h1>
    <table>
        <tr>
            <th>
                To
            </th>
            <td>{{$order->user->name}}</td>
            <th>Date</th>
            <td>{{$order->created_at->format('m-d-y')}}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td >{{$order->user->full_address}}</td>
        </tr>
    </table>
    <table>
        <tr>
            <th>Reference #: </th>
            <td>{{$order->reference}}</td>
        </tr>
    </table>
    <table style="">
        <tr>
            <th>Description </th>
            <th>Quantity</th>
            <th>Price </th>
            <th>SubTotal</th>
        </tr>
        @foreach ($order->orderItems as $item)
            <tr>
                <td>
                    {{$item->product->name}}
                </td>
                <td>
                    {{$item->quantity}}
                </td>
                <td>
                    PHP {{$item->price}}
                </td>
                <td>
                    PHP {{$item->price * $item->quantity}}
                </td>
            </tr>
        @endforeach
        <tr>
            <th colspan="3">Shipping Cost</th>
            <td>PHP {{$order->shipping_cost}}</td>
        </tr>
        <tr>
            <th colspan="3">TOTAL</th>
            <td>PHP {{$order->total}}</td>
        </tr>
    </table>
    <script>
        window.print()
    </script>
</body>
</html>
