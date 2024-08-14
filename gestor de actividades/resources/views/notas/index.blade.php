<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Welcome to RAM IA!") }}
        </h2>
    </x-slot>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        #editor-container {
            height: 400px;
            background-color: #1e1e1e;
            color: #ffffff;
        }
        .ql-editor {
            font-family: 'Courier New', Courier, monospace;
            font-size: 16px;
            line-height: 1.5;
        }
        .ql-toolbar {
            background-color: #fffefe;
            border: none;
        }
        .ql-container {
            border: none;
        }
    </style>    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="bg-white border-b border-gray-200">
                <div id="toolbar">
                    <button class="ql-bold"></button>
                    <button class="ql-italic"></button>
                    <button class="ql-underline"></button>
                    <button class="ql-link"></button>
                    <button class="ql-image"></button>
                    <button class="ql-code-block"></button>
                </div>
                <div id="editor-container">
                    <!-- Aquí el usuario escribirá sus notas -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: '#toolbar'
            }
        });
    
        window.addEventListener('beforeunload', function () {
            var notes = quill.root.innerHTML;
            fetch('/save-notes', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ notes: notes })
            });
        });
    
        window.addEventListener('load', function () {
            fetch('/load-notes', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.notes) {
                    quill.root.innerHTML = data.notes;
                }
            });
        });
    </script>
</x-app-layout>