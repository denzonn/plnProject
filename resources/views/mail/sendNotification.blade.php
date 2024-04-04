<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div style="padding: 1rem 0rem;">
        <div style="color: #1a87a3; font-weight: bold; font-size: 1rem;">List Material Reaches of Limit :</div>

        <div style="overflow-x: auto;">
            <table style="border-collapse: collapse; width: 100%;">
                <!-- head -->
                <thead style="color: #333; font-size: 1rem;">
                    <tr>
                        <th style="padding: 0.5rem; border-bottom: 1px solid #ccc;"></th>
                        <th style="padding: 0.5rem; border-bottom: 1px solid #ccc;">Name</th>
                        <th style="padding: 0.5rem; border-bottom: 1px solid #ccc;">Stock</th>
                    </tr>
                </thead>
                <tbody style="color: #666;">
                    @forelse ($materials as $index => $item)
                    <tr>
                        <td style="padding: 0.5rem;">{{ $index + 1 }}</td>
                        <td style="padding: 0.5rem;">{{ $item->name }}</td>
                        <td style="padding: 0.5rem;">{{ $item->new_stock }} stock</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="padding: 1rem;">
                            <div style="text-align: center;">
                                <img src="{{ asset('no_data.svg') }}" alt="" style="width: 100px; margin: 0 auto; display: block;">
                                <div style="margin-top: 0.5rem;">Tidak ada Data</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
