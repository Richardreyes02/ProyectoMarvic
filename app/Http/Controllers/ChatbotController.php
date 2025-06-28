<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

class ChatbotController extends Controller
{
    public function mostrarChatbot()
    {
        return view('Admin.chatbot.chatbot');
    }

    public function handle(Request $request)
    {
        $mensajeUsuario = $request->input('message');

        try {
            $respuestaWit = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('WIT_TOKEN') // Asegúrate de usar el nombre correcto
            ])->get('https://api.wit.ai/message', [
                'q' => $mensajeUsuario
            ]);

            $datos = $respuestaWit->json();

            $intencion = $datos['intents'][0]['name'] ?? null;
            $nombreProductoCapturado = $datos['entities']['producto:producto'][0]['body'] ?? null;

            if (!$nombreProductoCapturado || $intencion !== 'consultar_stock') {
                return response()->json(['respuesta' => 'No entendí bien tu pregunta. ¿Puedes repetirla?']);
            }

            $productos = Product::all();
            if ($productos->isEmpty()) {
                return response()->json(['respuesta' => 'No hay productos registrados.']);
            }

            $producto = $this->buscarProductoSimilar($nombreProductoCapturado, $productos);

            if (!$producto) {
                return response()->json([
                    'respuesta' => 'No encontré ningún producto similar a "' . $nombreProductoCapturado . '".'
                ]);
            }

            $respuestasPosibles = [
                'Actualmente hay %d unidades del producto con código "%s" y descripción "%s".',
                'Tenemos %d unidades disponibles del producto "%s" (código: %s).',
                'El producto "%s" (código: %s) tiene %d unidades en stock.',
                'Hay %d en inventario del producto "%s" con código "%s".',
                'El stock actual del producto "%s" (código: %s) es de %d unidades.'
            ];

            // Elegir una plantilla aleatoria
            $plantilla = $respuestasPosibles[array_rand($respuestasPosibles)];

            // Ajustar orden de sprintf según plantilla
            // Algunas plantillas requieren reordenar los parámetros
            if (strpos($plantilla, '%s" (código: %s) tiene %d') !== false || 
                strpos($plantilla, 'producto "%s" (código: %s) es de %d') !== false) {
                $respuestaFormateada = sprintf(
                    $plantilla,
                    $producto->descripcion,
                    $producto->codigo,
                    $producto->cantidad
                );
            } else {
                $respuestaFormateada = sprintf(
                    $plantilla,
                    $producto->cantidad,
                    $producto->codigo,
                    $producto->descripcion
                );
            }

            return response()->json([
                'respuesta' => $respuestaFormateada
            ]);

        } catch (\Exception $e) {
            Log::error('Error en ChatbotController: ' . $e->getMessage());
            return response()->json(['respuesta' => 'Ocurrió un error. Inténtalo más tarde.']);
        }
    }

    private function buscarProductoSimilar($nombreBuscado, $productos)
    {
        $nombreBuscado = strtolower($nombreBuscado);
        $mejorCoincidencia = null;
        $mayorSimilitud = 0;

        foreach ($productos as $producto) {
            $codigo = strtolower($producto->codigo ?? '');
            $descripcion = strtolower($producto->descripcion ?? '');

            similar_text($nombreBuscado, $codigo, $simCodigo);
            similar_text($nombreBuscado, $descripcion, $simDescripcion);

            $similitud = max($simCodigo, $simDescripcion);

            if ($similitud > $mayorSimilitud) {
                $mayorSimilitud = $similitud;
                $mejorCoincidencia = $producto;
            }
        }

        return ($mayorSimilitud > 60) ? $mejorCoincidencia : null;
    }
}
