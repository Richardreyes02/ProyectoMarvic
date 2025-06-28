<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      margin: 40px;
      color: #333;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .company-info {
      font-size: 14px;
    }

    .title {
      text-align: center;
      font-size: 18px;
      font-weight: bold;
      text-decoration: underline;
      margin-bottom: 20px;
    }

    .info-box {
      width: 100%;
      margin-bottom: 20px;
    }

    .info-box td {
      padding: 4px;
      vertical-align: top;
    }

    .items-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    .items-table th, .items-table td {
      border: 1px solid #999;
      padding: 8px;
      text-align: left;
    }

    .items-table th {
      background-color: #f0f0f0;
      text-align: center;
    }

    .right {
      text-align: right;
    }

    .total-box {
      width: 100%;
      margin-top: 20px;
    }

    .total-box td {
      padding: 6px;
    }

    .signature {
      margin-top: 40px;
    }

    .signature div {
      margin-top: 60px;
      text-align: center;
    }

    .nombreencargado div {
      margin-top: 10px;
      text-align: center;
      font-weight: bold;
    }

    .encargado {
      margin-top: 10px;
      text-align: center;
    }

    .footer {
      text-align: center;
      font-size: 10px;
      margin-top: 30px;
    }
  </style>
</head>
<body>

  <div class="header">
    <div class="company-info">
      <strong>MARVIC SAC</strong><br>
      RUC 10203040504<br>
      Jr. Ejemplo 123 - Lima<br>
      Tel: (01) 123-4567
    </div>
  </div>

  <div class="title">NOTA DE INGRESO DE PRODUCTOS</div>
  <div class="title">{{ $nota->codigo }}</div>

  <table class="info-box">
    <tr>
      <td><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($nota->fecha)->format('d/m/Y') }}</td>
    </tr>
    <tr>
    </tr>
    <tr>
      <td><strong>Tipo Doc. Relacionado:</strong> {{ $nota->tipo_documento }}</td>
      <td><strong>N° Documento:</strong> {{ $nota->numero_documento }}</td>
    </tr>
    <tr>
      <td><strong>Usuario:</strong> {{ $nota->usuario->name }}</td>
      <td><strong>Sede:</strong> {{ $nota->sede->nombre }}</td>
    </tr>
  </table>

  <table class="items-table">
    <thead>
      <tr>
        <th>CANT</th>
        <th>UNIDAD</th>
        <th>DESCRIPCIÓN</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($nota->detalles as $detalle)
        <tr>
          <td class="right">{{ $detalle->cantidad }}</td>
          <td class="right">unidades</td>
          <td>{{ $detalle->producto->descripcion }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @if($nota->observaciones)
    <div><strong>Observaciones:</strong> {{ $nota->observaciones }}</div>
  @endif

  <div class="signature">
    <div>------------------------------------</div>
  </div>

  <div class="nombreencargado">
    <div>{{ $nota->usuario->name }}</div>
  </div>

  <div class="encargado">Encargado</div>

  <div class="footer">
    Documento generado por el sistema - {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
  </div>

</body>
</html>
