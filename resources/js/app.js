import './bootstrap';

import Alpine from 'alpinejs';
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
        tools: {
            header: { class: Header, inlineToolbar: true },
            list: { class: List, inlineToolbar: true },
            table: { class: Table, inlineToolbar: true },
            image: { class: ImageTool, config: { endpoints: { byFile: "/editor-upload" } } },
            code: CodeTool,
            checklist: Checklist,
            quote: Quote,
            embed: Embed,
            paragraph: Paragraph
        }
    });
});


window.Alpine = Alpine;

Alpine.start();
