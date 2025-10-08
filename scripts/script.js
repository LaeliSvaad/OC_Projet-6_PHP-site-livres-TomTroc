document.addEventListener('DOMContentLoaded', () => {
    const textarea = document.getElementById('input-description');
    function autoResize(el) {
        el.style.height = 'auto';
        el.style.height = el.scrollHeight + 'px';
    }
    textarea.addEventListener('input', () => autoResize(textarea));
    autoResize(textarea);
});