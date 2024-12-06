<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel Data PDF</title>
    <style>
        @page{
            margin: 36px;
        }
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
            /* display: flex;
            align-items: center;
            justify-content: center; */
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
            font-size: 18px;
            margin-bottom: 2px;
        }

        .name {
            font-size: 18px;
            /* font-weight: 500; */
            margin-bottom: 12px;
        }

        tr,
        td {
            vertical-align: top;
        }
    </style>
</head>

<body>
    @foreach ($items as $item)
        <div class="page">
            <div class="name">
                <div style="display: inline-block; width:60px; vertical-align: top;">
                    From:
                </div>
                <div style="display: inline-block; max-width:220px; vertical-align: top;">
                    {{ $item['from_name'] }}
                </div>
            </div>
            <div class="address">
                <div style="display: inline-block; width:60px; vertical-align: top;">
                    To:
                </div>
                <div style="display: inline-block; max-width:220px; vertical-align: top;">
                    <div class="address">{{ $item['contact_name'] }}</div>
                </div>
            </div>
            <div class="address" style="margin-top:16px; margin-bottom:0px">
                <div style="display: inline-block; width:60px;">

                </div>
                <div style="display: inline-block; max-width:220px">
                    <div class="address">{{ $item['address_1'] }}
                    </div>
                    @if ($item['address_2'])
                        <div class="address">
                            {{ $item['address_2'] }}

                        </div>
                    @endif
                    <div class="address">{{ $item['city'] }}, {{ $item['province'] }}, {{ $item['postalcode'] }}</div>
                </div>
            </div>
            <div class="address" style="margin-top:-5px;">
                <div style="display: inline-block; width:60px">
                    Phone:
                </div>
                <div style="display: inline-block">
                    {{ $item['phone'] }}
                </div>
            </div>
        </div>
        <div class="message last-page">
            <h1 class="content">{{ $item['message'] }}</h1>
        </div>
    @endforeach
</body>

</html>
