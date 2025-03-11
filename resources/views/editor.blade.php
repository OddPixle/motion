<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Notion-like Editor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Load Editor.js -->
    <script type="module">
           import EditorJS from "@editorjs/editorjs";
            import Header from "@editorjs/header";
            import List from "@editorjs/list";
            import { Table } from "@editorjs/table";
            import { ImageTool } from "@editorjs/image";
            import { CodeTool } from "@editorjs/code";
            import { Checklist } from "@editorjs/checklist";
            import { Quote } from "@editorjs/quote";
            import { Embed } from "@editorjs/embed";
            import Paragraph from "@editorjs/paragraph";
    document.addEventListener("DOMContentLoaded", function () {
        const editor = new EditorJS({
            holder: "editorjs",
            placeholder: "Start writing your Notion-like document...",
            tools: {
                header: {   
                    class: Header,
                    inlineToolbar: true,
                    config: {
                        placeholder: "Enter a heading",
                        levels: [2, 3, 4],
                        defaultLevel: 2
                    }
                },
                list: {
                    class: List,
                    inlineToolbar: true,
                    config: {
                        defaultStyle: "unordered"
                    }
                },
                table: {
                    class: Table,  // Named import
                    inlineToolbar: true,
                    config: {
                        rows: 2,
                        cols: 3
                    }
                },
                image: {
                    class: ImageTool,  // Named import
                    config: {
                        endpoints: {
                            byFile: "/editor-upload" // Laravel backend for image upload
                        },
                        additionalRequestHeaders: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    }
                },
                code: CodeTool,  // Named import
                checklist: Checklist,  // Named import
                quote: {
                    class: Quote,  // Named import
                    inlineToolbar: true,
                    config: {
                        quotePlaceholder: "Enter a quote",
                        captionPlaceholder: "Author"
                    }
                },
                embed: {
                    class: Embed,  // Named import
                    config: {
                        services: {
                            youtube: true,
                            twitter: true,
                            instagram: true
                        }
                    }
                },
                paragraph: {
                    class: Paragraph,
                    inlineToolbar: true
                }
            }
        });
    });
    document.getElementById("saveButton").addEventListener("click", async () => {
        try {
            const outputData = await editor.save();
            console.log("Saved Data:", outputData);

            fetch("/save-editor", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ data: outputData })
            })
            .then(response => response.json())
            .then(data => console.log("Success:", data))
            .catch(error => console.error("Error:", error));

        } catch (error) {
            console.error("Saving failed: ", error);
        }
    });
    
</script>

</head>
<body>
    <h2>Editor.js - Advanced Configuration</h2>
    <div id="editorjs"></div>
    <button id="saveButton">Save Content</button>
</body>
</html>
