import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
        "./Modules/**/*.blade.php",
    ],

    theme: {
        extend: {
            fill: {
                skin: {
                    base: withOpacity("--color-base"),
                },
            },
            textColor: {
                skin: {
                    base: withOpacity("--color-base"),
                    secondary: withOpacity("--color-secondary"),
                },
            },
            backgroundColor: {
                skin: {
                    base: withOpacity("--color-base"),
                    secondary: withOpacity("--color-secondary"),
                },
            },
            borderColor: {
                skin: {
                    base: withOpacity("--color-base"),
                    secondary: withOpacity("--color-secondary"),
                },
            },
            ringColor: {
                skin: {
                    base: withOpacity("--color-base"),
                    secondary: withOpacity("--color-secondary"),
                },
            },
            ringOffsetColor: {
                skin: {
                    base: withOpacity("--color-base"),
                    secondary: withOpacity("--color-secondary"),
                },
            },
            outlineColor: {
                skin: {
                    base: withOpacity("--color-base"),
                    secondary: withOpacity("--color-secondary"),
                },
            },
            colors: {
                "on-tertiary-fixed-variant": "#474746",
                "background": "#f8f9fa",
                "on-error": "#ffffff",
                "inverse-on-surface": "#f0f1f2",
                "tertiary-fixed-dim": "#c8c6c5",
                "secondary-fixed": "#ffdad7",
                "on-secondary-fixed": "#410004",
                "surface-container": "#edeeef",
                "primary-fixed": "#beebe5",
                "on-secondary-fixed-variant": "#832423",
                "on-secondary": "#ffffff",
                "on-tertiary-fixed": "#1b1b1b",
                "on-surface": "#191c1d",
                "surface": "#f8f9fa",
                "inverse-primary": "#a2cfc9",
                "on-error-container": "#93000a",
                "outline": "#717977",
                "surface-tint": "#3b6661",
                "primary": "#002522",
                "on-primary-container": "#7ba6a1",
                "secondary-fixed-dim": "#ffb3ad",
                "tertiary-fixed": "#e5e2e1",
                "surface-dim": "#d9dadb",
                "surface-container-high": "#e7e8e9",
                "on-primary-fixed-variant": "#224e49",
                "on-background": "#191c1d",
                "surface-variant": "#e1e3e4",
                "on-tertiary": "#ffffff",
                "on-primary-fixed": "#00201d",
                "outline-variant": "#c0c8c6",
                "inverse-surface": "#2e3132",
                "tertiary-container": "#353535",
                "surface-bright": "#f8f9fa",
                "secondary": "#a33b38",
                "surface-container-low": "#f3f4f5",
                "surface-container-highest": "#e1e3e4",
                "primary-fixed-dim": "#a2cfc9",
                "on-secondary-container": "#741819",
                "secondary-container": "#fe8078",
                "error": "#ba1a1a",
                "on-surface-variant": "#404847",
                "tertiary": "#202020",
                "primary-container": "#0d3c38",
                "surface-container-lowest": "#ffffff",
                "on-tertiary-container": "#9f9e9d",
                "on-primary": "#ffffff",
                "error-container": "#ffdad6",
            },
            fontFamily: {
                sans: ["Manrope", ...defaultTheme.fontFamily.sans],
                label: ["Hanken Grotesk", ...defaultTheme.fontFamily.sans],
                "label-md": ["Hanken Grotesk"],
                "body-md": ["Manrope"],
                "headline-md": ["Manrope"],
                "display-lg": ["Manrope"],
                "title-lg": ["Manrope"],
                "body-lg": ["Manrope"],
                "caption": ["Hanken Grotesk"],
                "headline-lg": ["Manrope"],
                "headline-lg-mobile": ["Manrope"],
            },
            fontSize: {
                "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                "title-lg": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                "caption": ["12px", {"lineHeight": "16px", "fontWeight": "400"}],
                "headline-lg": ["32px", {"lineHeight": "40px", "fontWeight": "600"}],
                "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
            },
            spacing: {
                "stack-lg": "24px",
                "gutter": "24px",
                "stack-sm": "4px",
                "margin-desktop": "40px",
                "stack-md": "12px",
                "base": "8px",
                "margin-mobile": "16px",
                "container-max": "1280px",
            },
            animation: {
                blink: "blink 1s infinite",
            },
            keyframes: {
                blink: {
                    "0%, 100%": { opacity: 1 },
                    "50%": { opacity: 0.5 },
                },
            },

            variants: {
                space: ["responsive", "direction"],
            },
        },
    },

    plugins: [
        forms,
        typography,
        require("flowbite/plugin"),
        require("@tailwindcss/forms"),
    ],
};

function withOpacity(variableName) {
    return ({ opacityValue }) => {
        if (opacityValue !== undefined) {
            return `rgba(var(${variableName}), ${opacityValue})`;
        }
        return `rgb(var(${variableName}))`;
    };
}
