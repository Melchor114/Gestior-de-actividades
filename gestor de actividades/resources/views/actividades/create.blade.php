<x-app-layout>
    <!DOCTYPE html>
    <html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Efecto al pasar el mouse</title>
    <style>
      .contenedor {
        width: 200px;
        height: 200px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.5em;
        transition: transform 0.3s ease-in-out;
      }
    
      .contenedor:hover {
        transform: scale(1.1);
        cursor: pointer;
      }
    </style>
    </head>
    <body>
    
    <div class="contenedor">
      Pasa el mouse aquí
    </div>
    
    </body>
    </html>
    
    
    <div data-dial-init class="fixed end-6 bottom-6 group" data-reference="#">
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="fixed end-6 bottom-6 flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
            <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
            </svg>
            <span class="sr-only">Open actions menu</span>
        </button>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const openModalBtn = document.querySelector('[data-modal-toggle="crud-modal"]');
        const closeModalBtn = document.getElementById('close-modal');
        const modal = document.getElementById('crud-modal');

        openModalBtn.addEventListener('click', function () {
            modal.classList.remove('hidden');
            modal.classList.add('flex'); // Asegura que el modal se muestre centrado
        });

        closeModalBtn.addEventListener('click', function () {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });

        // Event listener to close the modal when clicking outside of it
        window.addEventListener('click', function (e) {
            if (e.target == modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    });
</script>

