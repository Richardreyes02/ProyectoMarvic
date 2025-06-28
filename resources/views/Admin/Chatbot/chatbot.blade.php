@extends('Admin.Main.main')

@section('title', 'Materiales')

@section('content')
<div x-data="chatBot()" class="p-4 h-screen max-h-[calc(100vh-100px)] overflow-y-auto bg-white">
    <div class="flex flex-col justify-between h-full">
        <div id="messages" class="overflow-y-auto space-y-4 mb-4">
            <!-- Mensajes -->
            <template x-for="(message, index) in messages" :key="index">
                <div class="flex items-start"
                     :class="message.from === 'bot' ? 'justify-start' : 'justify-end'">
                    
                    <!-- Bot Message -->
                    <div class="flex items-start space-x-2" x-show="message.from === 'bot'">
                        <img src="/images/chatbot.png"
                             class="w-10 h-10 rounded-full border"
                             alt="Bot Avatar">
                        <div class="inline-block px-4 py-2 rounded-xl bg-gray-100 text-gray-800 max-w-xs">
                            <span x-html="message.text"></span>
                        </div>
                    </div>

                    <!-- User Message -->
                    <div class="flex items-start space-x-2" x-show="message.from === 'user'">
                        <div class="inline-block px-4 py-2 rounded-xl bg-blue-500 text-white max-w-xs text-right">
                            <span x-html="message.text"></span>
                        </div>
                        <img src="/images/usuario.png"
                             class="w-10 h-10 rounded-full border"
                             alt="User Avatar">
                    </div>
                </div>
            </template>

            <!-- Indicador de escritura del bot (sin fondo de burbuja) -->
            <div x-show="loadingBot" class="flex items-start space-x-2">
                <img src="/images/chatbot.png"
                    class="w-10 h-10 rounded-full border"
                    alt="Bot Avatar">
                <div class="flex items-center">
                    <img src="https://support.signal.org/hc/article_attachments/360016877511/typing-animation-3x.gif"
                        alt="Escribiendo..."
                        class="w-12 h-auto ml-1 mt-1">
                </div>
            </div>

        </div>

        <!-- Input con estilo personalizado -->
        <div class="border-t-2 border-gray-200 px-4 pt-4 mb-2 sm:mb-0">
            <div class="relative flex">
                <input type="text"
                    placeholder="Escribe algo..."
                    autocomplete="off"
                    autofocus
                    @keydown.enter="sendMessage"
                    x-ref="input"
                    class="text-md w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pl-5 pr-16 bg-gray-100 border-2 border-gray-200 focus:border-blue-500 rounded-full py-2" />
                
                <div class="absolute right-2 items-center inset-y-0 hidden sm:flex">
                    <button type="button"
                            @click.prevent="sendMessage"
                            class="inline-flex items-center justify-center rounded-full h-8 w-8 transition duration-200 ease-in-out text-white bg-blue-500 hover:bg-blue-600 focus:outline-none">
                        <i class="mdi mdi-arrow-right text-xl leading-none"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function chatBot() {
    return {
        messages: [{ from: 'bot', text: 'Hola, ¿en qué te puedo ayudar?' }],
        loadingBot: false,

        sendMessage() {
            const input = this.$refs.input;
            const text = input.value.trim();
            if (!text) return;

            // Mostrar mensaje del usuario
            this.messages.push({ from: 'user', text });
            input.value = '';

            // Mostrar efecto "escribiendo..."
            this.loadingBot = true;

            // Llamar al backend
            fetch('/admin/chatbot', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ message: text })
            })
            .then(res => res.json())
            .then(data => {
                // Ocultar "escribiendo..."
                this.loadingBot = false;

                // Mostrar respuesta del bot
                this.messages.push({ from: 'bot', text: data.respuesta });

                this.$nextTick(() => {
                    const messagesContainer = document.getElementById("messages");
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                });
            })
            .catch(err => {
                this.loadingBot = false;
                this.messages.push({ from: 'bot', text: 'Ocurrió un error. Inténtalo más tarde.' });
            });
        }
    }
}
</script>
@endsection
