/** @type {import('tailwindcss').Config} */

import forms from  "@tailwindcss/forms";
export default {
    // darkMode: 'class',
    content: [
        "./index.html",
        "./src/**/*.{js,ts,vue}",
    ],
    theme: {
        extend: {},
    },
    plugins: [
        forms,
    ],
}

