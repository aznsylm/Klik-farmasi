@props(['id', 'name', 'value' => '', 'config' => 'full', 'required' => false])

<textarea id="{{ $id }}" name="{{ $name }}" class="form-control ckeditor-textarea"
    {{ $required ? 'required' : '' }} data-config="{{ $config }}">{{ $value }}</textarea>

@once
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // CKEditor configurations
            const configs = {
                light: {
                    toolbar: ['bold', 'italic', 'link'],
                    placeholder: 'Masukkan teks...'
                },
                medium: {
                    toolbar: [
                        'bold', 'italic', 'link', '|',
                        'bulletedList', 'numberedList'
                    ],
                    placeholder: 'Masukkan deskripsi...'
                },
                full: {
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'link', '|',
                        'bulletedList', 'numberedList', 'blockQuote'
                    ],
                    heading: {
                        options: [{
                                model: 'paragraph',
                                title: 'Paragraph',
                                class: 'ck-heading_paragraph'
                            },
                            {
                                model: 'heading3',
                                view: 'h3',
                                title: 'Heading 3',
                                class: 'ck-heading_heading3'
                            },
                            {
                                model: 'heading4',
                                view: 'h4',
                                title: 'Heading 4',
                                class: 'ck-heading_heading4'
                            }
                        ]
                    },
                    placeholder: 'Masukkan narasi lengkap...'
                }
            };

            // Initialize all CKEditor instances
            document.querySelectorAll('.ckeditor-textarea').forEach(function(element) {
                const configType = element.dataset.config || 'full';
                const config = configs[configType] || configs.full;

                ClassicEditor
                    .create(element, config)
                    .then(editor => {
                        // Store editor instance for later access
                        element.ckeditorInstance = editor;

                        // Sync data to original textarea before form submission
                        const form = element.closest('form');
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                // Update textarea with CKEditor content
                                element.value = editor.getData();
                            });
                        }

                        // Also sync on CKEditor data change for real-time sync
                        editor.model.document.on('change:data', () => {
                            element.value = editor.getData();
                        });
                    })
                    .catch(error => {
                        console.error('CKEditor initialization error:', error);
                    });
            });
        });
    </script>
@endonce
