<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel Data PDF</title>
    <style>
        body {
            margin: 0;
            /* Remove body margins */
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .page {
            width: 100%;
            height: 100%;
            page-break-after: always;
            /* Ensure each page starts fresh */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .last-page {
            page-break-after: auto;
            /* Prevent blank page after the last page */
        }

        .message {
            text-align: center;
            position: relative;
            /* height: 4ch; */
        }

        .content {
            position: absolute;
            width: 100%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .address {
            font-size: 14px;
            margin-bottom: 2px;
        }

        .name {
            font-size: 14px;
            /* font-weight: 500; */
            margin-bottom: 12px;
        }
        tr, td{
            vertical-align: top;
        }
    </style>
</head>

<body>
    @foreach ($items as $item)
        <div class="page">
            <table>
                <tr>
                    <td>
                        <div class="name">From:</div>
                    </td>
                    <td>
                        <div class="name">{{ $item['from_name'] }}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="address">To:</div>
                    </td>
                    <td>
                        <div class="address">{{ $item['contact_name'] }}</div>
                        <div class="address">{{ $item['address_1'] }} @if ($item['address_2'])
                            , {{ $item['address_2'] }}
                        @endif
                    </div>
                    <div class="address">{{ $item['city'] }}, {{ $item['province'] }}, {{ $item['postalcode'] }}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="address">Phone:</div>
                    </td>
                    <td>
                        <div class="address">{{ $item['phone'] }}</div>
                    </td>
                </tr>
            </table>
            
        </div>
        <div class="message last-page">
            <h1 class="content">{{ $item['message'] }}</h1>
        </div>
    @endforeach
</body>

</html>
