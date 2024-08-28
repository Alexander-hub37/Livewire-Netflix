import './bootstrap';
import 'flowbite';

/* Import TinyMCE */
import tinymce from 'tinymce/tinymce';

/* Default icons are required. After that, import custom icons if applicable */
import 'tinymce/icons/default/icons.min.js';

/* Required TinyMCE components */
import 'tinymce/themes/silver/theme.min.js';
import 'tinymce/models/dom/model.min.js';

/* Import a skin (can be a custom skin instead of the default) */
import 'tinymce/skins/ui/oxide/skin.js';

/* Import plugins */
import 'tinymce/plugins/advlist';
import 'tinymce/plugins/code';
import 'tinymce/plugins/emoticons';
import 'tinymce/plugins/emoticons/js/emojis';
import 'tinymce/plugins/link';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/table';

function initializeTinyMCE() {
    tinymce.init({
        selector: '#description',
        content_css: "/css/tinymce.css",
        plugins: 'advlist code emoticons link lists table',
        toolbar: 'bold italic | bullist numlist | link emoticons',
        skin_url: 'default',
        menubar: false,
        setup: (editor) => {
            editor.on('init', () => {
                editor.getContainer().style.height = '10em'; 
            });
            editor.on('change', () => {
                editor.save();
                const textarea = document.querySelector('#description');
                textarea.value = editor.getContent();
                textarea.dispatchEvent(new Event('input', { bubbles: true })); 
            });
        }
    });
}

function destroyTinyMCE() {
    const editor = tinymce.get('description');
    if (editor) {
        editor.save();
        const textarea = document.querySelector('#description');
        textarea.value = editor.getContent();
        textarea.dispatchEvent(new Event('change', { bubbles: true }));
        editor.remove();
    }
}

document.addEventListener('show-tinymce', () => {
    requestAnimationFrame(() => {
        initializeTinyMCE();
    });
});

document.addEventListener('hide-tinymce', () => {
    destroyTinyMCE();
});

document.addEventListener('livewire:load', () => {
    initializeTinyMCE();
});

document.addEventListener('livewire:update', () => {
    requestAnimationFrame(() => {
        destroyTinyMCE();
        initializeTinyMCE();
    });
});
