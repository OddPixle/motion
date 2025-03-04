<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notion-like Editor</title>
    <!-- Option 1: Include via CDN -->
</head>
<body>
    <button id="saveButton">Save</button>
    <div id="editorjs"></div>

    <script>
        import EditorJS from '@editorjs/editorjs'; 
        import Header from '@editorjs/header'; 
        import List from '@editorjs/list'; 
        const editor = new EditorJS({
            holder: 'editorjs',
            tools: { 
            header: {
                class: Header, 
                inlineToolbar: ['link'] 
            }, 
            list: { 
                class: List, 
                inlineToolbar: true 
            } 
        }});    

        document.getElementById('saveButton').addEventListener('click', async () => {
            try {
                const outputData = await editor.save();
                console.log('Data: ', outputData);

                fetch('/save-editor', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ data: outputData })
                })
                .then(response => response.json())
                .then(data => console.log('Success:', data))
                .catch(error => console.error('Error:', error));
            } catch (error) {
                console.error('Saving failed: ', error);
            }
        });
    </script>
</body>
</html>
