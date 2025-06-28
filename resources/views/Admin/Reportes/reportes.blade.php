@extends('Admin.Main.main')

@section('title', 'Registrar Proveedor')

@section('content')

<body class="bg-gray-100">
    <div class="max-w-screen-xl mx-auto px-4 max-h-[calc(100vh-100px)]">
      <!-- Grid con 5 columnas, 6 filas y espacios definidos -->
      <div class="grid grid-cols-5 grid-rows-5 gap-4">
        
        <!-- Card 1: Total de salidas -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-md p-4 flex flex-col items-center justify-center text-center">
            <!-- Círculo con SVG -->
            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-blue-100 mb-3">
                <svg class="w-6 h-6 text-blue-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4.5V19a1 1 0 0 0 1 1h15M7 14l4-4 4 4 5-5m0 0h-3.207M20 9v3.207" />
                </svg>
            </div>

            <!-- Título -->
            <h5 class="text-xl font-bold mb-1 uppercase"></h5>

            <!-- Etiqueta -->
            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-smmb-2">
                Salidas Producto
            </span>

            <!-- Monto -->
            <p class="text-gray-700 text-xs font-medium mt-2" style="font-family: poppins">
              Total Mes
            </p>
            <p class="text-gray-700 text-2xl font-semibold" style="font-family: poppins">
                {{ number_format($totalSalidasMes, 0, ',', '.') }} UNID
            </p>
        </div>



        <!-- Card 2: Producto con menor stock -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-md p-4 flex flex-col items-center justify-center text-center">
            <!-- SVG en círculo con verde -->
            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 mb-3">
                <svg class="w-6 h-6 text-green-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4.5V19a1 1 0 0 0 1 1h15M7 10l4 4 4-4 5 5m0 0h-3.207M20 15v-3.207" />
                </svg>
            </div>

            <h5 class="text-xl font-bold mb-1 uppercase"></h5>
            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-sm mb-2">
                Producto Menos Stock
            </span>
            <p class="text-gray-700 text-xs font-medium">
                {{ $productoMenorStock->descripcion }}
            </p>
            <p class="text-gray-700 text-2xl font-semibold" style="font-family: poppins">
                {{ number_format($productoMenorStock->cantidad, 0, ',', '.') }} UNID
            </p>
        </div>



        <!-- Card 3: Producto más salido -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-md p-4 flex flex-col items-center justify-center text-center">
            <!-- SVG en círculo con amarillo -->
            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-yellow-100 mb-3">
                <svg class="w-6 h-6 text-yellow-800" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                </svg>
            </div>

            <h5 class="text-xl font-bold mb-1 uppercase"></h5>
            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-sm mb-2">
                Producto del Mes
            </span>
            <p class="text-gray-700 text-xs font-medium" style="font-family: poppins">
                {{ $productoMasSalido->descripcion ?? 'Sin datos' }}
            </p>
            <p class="text-gray-700 text-2xl font-semibold" style="font-family: poppins">
                {{ number_format($productoMasSalido->total ?? 0, 0, ',', '.') }} UNID
            </p>
        </div>



        
        <!-- Card 4: Productos con menor stock -->
        <div class="col-span-2 row-span-2 bg-white rounded-lg border border-gray-200 shadow-md p-4 flex flex-col overflow-auto" style="font-family: Poppins">
          <h5 class="text-xl text-center font-bold mb-5 mt-2">PRODUCTOS CON MENOS STOCK</h5>
          <div class="relative overflow-x-auto rounded-xl">
            <table class="w-full text-sm text-left text-gray-500">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                  <th class="px-6 py-3">Descripción</th>
                  <th class="px-6 py-3">Cant</th>
                  <th class="px-6 py-3">U/M</th>
                </tr>
              </thead>
              <tbody>
                @foreach($productosMenorStock as $producto)
                  <tr class="bg-white hover:bg-gray-50">
                    <td class=" px-6 py-3 font-medium text-gray-900">{{ $producto->descripcion }}</td>
                    <td class="px-6 py-3 text-center text-gray-500">{{ $producto->cantidad }}</td>
                    <td class="px-6 py-3 text-gray-400">unid</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        
        <!-- Card 5: Top productos y materiales más salidos (con gráficos) -->
        <div class="col-span-3 row-span-3 row-start-2 bg-white rounded-lg border border-gray-200 shadow-md p-4 flex flex-col" style="font-family: Poppins">
          <h5 class="text-xl font-bold mb-4 text-center">SALIDAS DEL MES</h5>

          <div class="grid grid-cols-2 gap-6 mt-8">
            <div>
              <h2 class="text-lg font-semibold text-center mb-2">Productos más salidos</h2>
              <canvas id="doughnutChart"></canvas>
            </div>
            <div>
              <h2 class="text-lg font-semibold text-center mb-2">Materiales más salidos</h2>
              <canvas id="pieChart"></canvas>
            </div>
          </div>
        </div>
        
        <!-- Card 6: Materiales con menor stock -->
        <div class="col-span-2 row-span-2 col-start-4 row-start-3 bg-white rounded-lg border border-gray-200 shadow-md p-4 flex flex-col overflow-auto" style="font-family: Poppins">
          <h5 class="text-xl text-center font-bold mb-5 mt-2">MATERIALES CON MENOS STOCK</h5>
          <div class="relative overflow-x-auto rounded-xl">
            <table class="w-full text-sm text-left text-gray-500">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                  <th class="px-6 py-3">Descripción</th>
                  <th class="px-6 py-3">Cant</th>
                  <th class="px-6 py-3">U/M</th>
                </tr>
              </thead>
              <tbody>
                @foreach($materialesMenorStock as $material)
                <tr class="bg-white hover:bg-gray-50">
                  <td class="px-6 py-3 font-medium text-gray-900">{{ $material->nombre }}</td>
                  <td class="px-6 py-3 text-center text-gray-500">{{ $material->stock }}</td>
                  <td class="px-6 py-3 text-gray-400">{{ $material->unidad_medida }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>

  

  <script>
    window.topProductosLabels = @json($topProductosLabels);
    window.topProductosValores = @json($topProductosValores);
    window.topMaterialesLabels = @json($topMaterialesLabels);
    window.topMaterialesValores = @json($topMaterialesValores);
</script>


@endsection