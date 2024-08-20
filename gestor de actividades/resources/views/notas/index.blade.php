<x-app-layout>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        #editor-container {
            height: 400px;
            background-color: #ffffff;
            color: #000000;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .ql-editor {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            line-height: 1.6;
        }

        .ql-toolbar {
            background-color: #f5f5f5;
            border: none;
            border-radius: 8px 8px 0 0;
            padding: 4px 8px;
        }

        .ql-toolbar button {
            border: none;
            background: none;
            padding: 8px;
        }

        .ql-toolbar button:hover {
            background-color: #e8e8e8;
        }

        .ql-container {
            border: none;
        }
    </style>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="bg-white border-b border-gray-200">
                <div id="toolbar" class="flex">
                    <button class="ql-bold" title="Bold">
                        <i class="material-icons">format_bold</i>
                    </button>
                    <button class="ql-italic" title="Italic">
                        <i class="material-icons">format_italic</i>
                    </button>
                    <button class="ql-underline" title="Underline">
                        <i class="material-icons">format_underline</i>
                    </button>
                    <button class="ql-link" title="Link">
                        <i class="material-icons">link</i>
                    </button>
                    <button class="ql-image" title="Image">
                        <i class="material-icons">image</i>
                    </button>
                    <button class="ql-code-block" title="Code Block">
                        <i class="material-icons">code</i>
                    </button>
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

        window.addEventListener('beforeunload', function() {
            var notes = quill.root.innerHTML;
            fetch('/save-notes', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    notes: notes
                })
            });
        });

        window.addEventListener('load', function() {
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