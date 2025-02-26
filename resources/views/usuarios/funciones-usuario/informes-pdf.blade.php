<!DOCTYPE html>
<html>
<head>
    <title>Informe de Ventas {{ ucfirst($tipo) }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Informe de Ventas - {{ ucfirst($tipo) }}</h2>
    <p>Generado el: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Fecha</th>
                <th>Tipo Comprobante</th>
                <th>Subtotal</th>
                <th>IGV</th>
                <th>Total</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{ $venta->id_venta }}</td>
                    <td>{{ $venta->fecha }}</td>
                    <td>{{ $venta->tipo_comprobante }}</td>
                    <td>${{ number_format($venta->subtotal, 2) }}</td>
                    <td>${{ number_format($venta->igv, 2) }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td>{{ $venta->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
