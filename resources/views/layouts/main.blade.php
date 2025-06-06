<!DOCTYPE html>
<html lang="id"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
        {{-- Leaflet CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="Sistem%20Pemetaan%20Lahan%20Pertanian%20&amp;%20Perkebunan%20Gorontalo_files/css2.css" rel="stylesheet">
    <script src="Sistem%20Pemetaan%20Lahan%20Pertanian%20&amp;%20Perkebunan%20Gorontalo_files/3.4.16"></script>
    <link rel="stylesheet" href="Sistem%20Pemetaan%20Lahan%20Pertanian%20&amp;%20Perkebunan%20Gorontalo_files/all.min.css">
    <script>

        
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2E7D32',
                        'primary-light': '#4CAF50',
                        'primary-dark': '#1B5E20',
                        'light-gray': '#F5F5F5',
                        danger: '#D32F2F',
                        success: '#388E3C',
                        warning: '#FFA000',
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                        opensans: ['Open Sans', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'fade-in-up': 'fadeInUp 0.6s forwards',
                        'fade-in-down': 'fadeInDown 0.5s forwards',
                        'spin-slow': 'spin 3s linear infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        fadeInUp: {
                            'from': { 
                                opacity: '0',
                                transform: 'translateY(20px)'
                            },
                            'to': { 
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        fadeInDown: {
                            'from': { 
                                opacity: '0',
                                transform: 'translate(-50%, -10px)'
                            },
                            'to': { 
                                opacity: '1',
                                transform: 'translate(-50%, 0)'
                            },
                        },
                    },
                },
            },
        }
    </script>
    <style>
        /* Style map */
        #mapPer { 
            height: 600px;
            width: 1200px;
            margin: 0 auto;
            z-index: 1;
        }
        .info {
            padding: 6px 8px;
            background: white;
            background: rgba(255,255,255,0.8);
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            border-radius: 5px;
            line-height: 1.5;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination button {
            margin: 0 5px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .pagination button.disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }

        /* Custom Styles */
        .ripple {
            position: relative;
            overflow: hidden;
        }

        .ripple::after {
            content: "";
            display: block;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            background-image: radial-gradient(circle, #fff 10%, transparent 10.01%);
            background-repeat: no-repeat;
            background-position: 50%;
            transform: scale(10, 10);
            opacity: 0;
            transition: transform .5s, opacity 1s;
        }

        .ripple:active::after {
            transform: scale(0, 0);
            opacity: .3;
            transition: 0s;
        }

        /* Skeleton Loading */
        .skeleton {
            background: linear-gradient(90deg, #e0e0e0 25%, #f5f5f5 50%, #e0e0e0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 0.25rem;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Tooltip */
        .tooltip {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 0.8rem 1.2rem;
            border-radius: 4px;
            font-size: 0.9rem;
            z-index: 100;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .tooltip.show {
            opacity: 1;
            visibility: visible;
            animation: fadeInDown 0.5s forwards;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translate(-50%, -10px);
            }
            to {
                opacity: 1;
                transform: translate(-50%, 0);
            }
        }

        /* Nav Link Hover Effect */
        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #2E7D32;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Table Styles */
        .data-table th {
            position: sticky;
            top: 0;
            z-index: 10;
        }

        /* Map Styles */
        .map svg {
            transition: transform 0.3s ease;
        }

        .land {
            transition: transform 0.3s ease;
        }

        /* Modal Animation */
        .modal {
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .modal-content {
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .modal.active .modal-content {
            transform: translateY(0);
        }
    </style>
<style>*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: ;--tw-contain-size: ;--tw-contain-layout: ;--tw-contain-paint: ;--tw-contain-style: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: ;--tw-contain-size: ;--tw-contain-layout: ;--tw-contain-paint: ;--tw-contain-style: }/* ! tailwindcss v3.4.16 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}:host,html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";font-feature-settings:normal;font-variation-settings:normal;-webkit-tap-highlight-color:transparent}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-feature-settings:normal;font-variation-settings:normal;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;letter-spacing:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}button,input:where([type=button]),input:where([type=reset]),input:where([type=submit]){-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}dialog{padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]:where(:not([hidden=until-found])){display:none}.container{width:100%}@media (min-width: 640px){.container{max-width:640px}}@media (min-width: 768px){.container{max-width:768px}}@media (min-width: 1024px){.container{max-width:1024px}}@media (min-width: 1280px){.container{max-width:1280px}}@media (min-width: 1536px){.container{max-width:1536px}}.invisible{visibility:hidden}.fixed{position:fixed}.absolute{position:absolute}.relative{position:relative}.sticky{position:sticky}.inset-0{inset:0px}.bottom-4{bottom:1rem}.left-0{left:0px}.right-4{right:1rem}.top-0{top:0px}.top-full{top:100%}.z-50{z-index:50}.mx-auto{margin-left:auto;margin-right:auto}.mb-2{margin-bottom:0.5rem}.mb-4{margin-bottom:1rem}.mb-6{margin-bottom:1.5rem}.mb-8{margin-bottom:2rem}.mr-2{margin-right:0.5rem}.mt-1{margin-top:0.25rem}.mt-4{margin-top:1rem}.block{display:block}.flex{display:flex}.grid{display:grid}.hidden{display:none}.h-10{height:2.5rem}.h-12{height:3rem}.h-4{height:1rem}.h-48{height:12rem}.h-\[600px\]{height:600px}.h-full{height:100%}.max-h-\[90vh\]{max-height:90vh}.w-10{width:2.5rem}.w-12{width:3rem}.w-4{width:1rem}.w-full{width:100%}.max-w-4xl{max-width:56rem}.max-w-lg{max-width:32rem}.translate-y-5{--tw-translate-y:1.25rem;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.transform{transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}@keyframes fadeInUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}.animate-fade-in-up{animation:fadeInUp 0.6s forwards}@keyframes spin{to{transform:rotate(360deg)}}.animate-spin{animation:spin 1s linear infinite}.grid-cols-1{grid-template-columns:repeat(1, minmax(0, 1fr))}.grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.flex-col{flex-direction:column}.items-center{align-items:center}.justify-end{justify-content:flex-end}.justify-center{justify-content:center}.justify-between{justify-content:space-between}.gap-1{gap:0.25rem}.gap-2{gap:0.5rem}.gap-4{gap:1rem}.gap-6{gap:1.5rem}.gap-8{gap:2rem}.space-y-3 > :not([hidden]) ~ :not([hidden]){--tw-space-y-reverse:0;margin-top:calc(0.75rem * calc(1 - var(--tw-space-y-reverse)));margin-bottom:calc(0.75rem * var(--tw-space-y-reverse))}.overflow-hidden{overflow:hidden}.overflow-x-auto{overflow-x:auto}.overflow-y-auto{overflow-y:auto}.rounded{border-radius:0.25rem}.rounded-full{border-radius:9999px}.rounded-lg{border-radius:0.5rem}.border{border-width:1px}.border-4{border-width:4px}.border-b{border-bottom-width:1px}.border-l{border-left-width:1px}.border-t{border-top-width:1px}.border-none{border-style:none}.border-gray-200{--tw-border-opacity:1;border-color:rgb(229 231 235 / var(--tw-border-opacity, 1))}.border-gray-300{--tw-border-opacity:1;border-color:rgb(209 213 219 / var(--tw-border-opacity, 1))}.border-gray-700{--tw-border-opacity:1;border-color:rgb(55 65 81 / var(--tw-border-opacity, 1))}.border-primary-light{--tw-border-opacity:1;border-color:rgb(76 175 80 / var(--tw-border-opacity, 1))}.border-t-primary{--tw-border-opacity:1;border-top-color:rgb(46 125 50 / var(--tw-border-opacity, 1))}.bg-black{--tw-bg-opacity:1;background-color:rgb(0 0 0 / var(--tw-bg-opacity, 1))}.bg-danger{--tw-bg-opacity:1;background-color:rgb(211 47 47 / var(--tw-bg-opacity, 1))}.bg-gray-400{--tw-bg-opacity:1;background-color:rgb(156 163 175 / var(--tw-bg-opacity, 1))}.bg-green-100{--tw-bg-opacity:1;background-color:rgb(220 252 231 / var(--tw-bg-opacity, 1))}.bg-green-50{--tw-bg-opacity:1;background-color:rgb(240 253 244 / var(--tw-bg-opacity, 1))}.bg-light-gray{--tw-bg-opacity:1;background-color:rgb(245 245 245 / var(--tw-bg-opacity, 1))}.bg-primary{--tw-bg-opacity:1;background-color:rgb(46 125 50 / var(--tw-bg-opacity, 1))}.bg-primary-dark{--tw-bg-opacity:1;background-color:rgb(27 94 32 / var(--tw-bg-opacity, 1))}.bg-primary-light{--tw-bg-opacity:1;background-color:rgb(76 175 80 / var(--tw-bg-opacity, 1))}.bg-red-100{--tw-bg-opacity:1;background-color:rgb(254 226 226 / var(--tw-bg-opacity, 1))}.bg-transparent{background-color:transparent}.bg-warning{--tw-bg-opacity:1;background-color:rgb(255 160 0 / var(--tw-bg-opacity, 1))}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity, 1))}.bg-opacity-10{--tw-bg-opacity:0.1}.bg-opacity-50{--tw-bg-opacity:0.5}.bg-gradient-to-r{background-image:linear-gradient(to right, var(--tw-gradient-stops))}.from-primary{--tw-gradient-from:#2E7D32 var(--tw-gradient-from-position);--tw-gradient-to:rgb(46 125 50 / 0) var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.to-primary-dark{--tw-gradient-to:#1B5E20 var(--tw-gradient-to-position)}.p-2{padding:0.5rem}.p-4{padding:1rem}.p-6{padding:1.5rem}.px-3{padding-left:0.75rem;padding-right:0.75rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-1{padding-top:0.25rem;padding-bottom:0.25rem}.py-12{padding-top:3rem;padding-bottom:3rem}.py-2{padding-top:0.5rem;padding-bottom:0.5rem}.py-20{padding-top:5rem;padding-bottom:5rem}.py-3{padding-top:0.75rem;padding-bottom:0.75rem}.py-4{padding-top:1rem;padding-bottom:1rem}.pb-2{padding-bottom:0.5rem}.pb-6{padding-bottom:1.5rem}.pt-12{padding-top:3rem}.pt-6{padding-top:1.5rem}.text-left{text-align:left}.text-center{text-align:center}.font-opensans{font-family:Open Sans, sans-serif}.font-poppins{font-family:Poppins, sans-serif}.text-2xl{font-size:1.5rem;line-height:2rem}.text-3xl{font-size:1.875rem;line-height:2.25rem}.text-4xl{font-size:2.25rem;line-height:2.5rem}.text-5xl{font-size:3rem;line-height:1}.text-lg{font-size:1.125rem;line-height:1.75rem}.text-sm{font-size:0.875rem;line-height:1.25rem}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-xs{font-size:0.75rem;line-height:1rem}.font-bold{font-weight:700}.font-semibold{font-weight:600}.leading-tight{line-height:1.25}.text-danger{--tw-text-opacity:1;color:rgb(211 47 47 / var(--tw-text-opacity, 1))}.text-gray-300{--tw-text-opacity:1;color:rgb(209 213 219 / var(--tw-text-opacity, 1))}.text-gray-400{--tw-text-opacity:1;color:rgb(156 163 175 / var(--tw-text-opacity, 1))}.text-gray-500{--tw-text-opacity:1;color:rgb(107 114 128 / var(--tw-text-opacity, 1))}.text-gray-600{--tw-text-opacity:1;color:rgb(75 85 99 / var(--tw-text-opacity, 1))}.text-gray-800{--tw-text-opacity:1;color:rgb(31 41 55 / var(--tw-text-opacity, 1))}.text-primary{--tw-text-opacity:1;color:rgb(46 125 50 / var(--tw-text-opacity, 1))}.text-success{--tw-text-opacity:1;color:rgb(56 142 60 / var(--tw-text-opacity, 1))}.text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity, 1))}.opacity-0{opacity:0}.opacity-90{opacity:0.9}.shadow-lg{--tw-shadow:0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);--tw-shadow-colored:0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.shadow-md{--tw-shadow:0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);--tw-shadow-colored:0 4px 6px -1px var(--tw-shadow-color), 0 2px 4px -2px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.shadow-xl{--tw-shadow:0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);--tw-shadow-colored:0 20px 25px -5px var(--tw-shadow-color), 0 8px 10px -6px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.transition-all{transition-property:all;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.transition-colors{transition-property:color, background-color, border-color, fill, stroke, -webkit-text-decoration-color;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, -webkit-text-decoration-color;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.transition-transform{transition-property:transform;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.duration-300{transition-duration:300ms}.after\:absolute::after{content:var(--tw-content);position:absolute}.after\:bottom-0::after{content:var(--tw-content);bottom:0px}.after\:left-0::after{content:var(--tw-content);left:0px}.after\:h-0\.5::after{content:var(--tw-content);height:0.125rem}.after\:w-12::after{content:var(--tw-content);width:3rem}.after\:bg-primary-light::after{content:var(--tw-content);--tw-bg-opacity:1;background-color:rgb(76 175 80 / var(--tw-bg-opacity, 1))}.after\:content-\[\'\'\]::after{--tw-content:'';content:var(--tw-content)}.hover\:-translate-y-0\.5:hover{--tw-translate-y:-0.125rem;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.hover\:-translate-y-1:hover{--tw-translate-y:-0.25rem;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.hover\:bg-green-50:hover{--tw-bg-opacity:1;background-color:rgb(240 253 244 / var(--tw-bg-opacity, 1))}.hover\:bg-light-gray:hover{--tw-bg-opacity:1;background-color:rgb(245 245 245 / var(--tw-bg-opacity, 1))}.hover\:bg-primary-dark:hover{--tw-bg-opacity:1;background-color:rgb(27 94 32 / var(--tw-bg-opacity, 1))}.hover\:text-gray-800:hover{--tw-text-opacity:1;color:rgb(31 41 55 / var(--tw-text-opacity, 1))}.hover\:text-primary:hover{--tw-text-opacity:1;color:rgb(46 125 50 / var(--tw-text-opacity, 1))}.hover\:text-primary-dark:hover{--tw-text-opacity:1;color:rgb(27 94 32 / var(--tw-text-opacity, 1))}.hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity, 1))}.hover\:underline:hover{-webkit-text-decoration-line:underline;text-decoration-line:underline}.hover\:shadow-lg:hover{--tw-shadow:0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);--tw-shadow-colored:0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.focus\:border-primary:focus{--tw-border-opacity:1;border-color:rgb(46 125 50 / var(--tw-border-opacity, 1))}.focus\:outline-none:focus{outline:2px solid transparent;outline-offset:2px}.focus\:ring-2:focus{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.focus\:ring-primary\/20:focus{--tw-ring-color:rgb(46 125 50 / 0.2)}@media (min-width: 768px){.md\:flex{display:flex}.md\:table-cell{display:table-cell}.md\:hidden{display:none}.md\:h-auto{height:auto}.md\:w-auto{width:auto}.md\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.md\:flex-row{flex-direction:row}.md\:text-2xl{font-size:1.5rem;line-height:2rem}.md\:text-5xl{font-size:3rem;line-height:1}}@media (min-width: 1024px){.lg\:grid-cols-3{grid-template-columns:repeat(3, minmax(0, 1fr))}.lg\:grid-cols-4{grid-template-columns:repeat(4, minmax(0, 1fr))}}</style><style>
            @keyframes ripple {
                to {
                    transform: scale(100);
                    opacity: 0;
                }
            }
        </style></head>
<body class="font-opensans text-gray-800 bg-light-gray" cz-shortcut-listen="true">
    <!-- Header & Navigation -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center gap-2 font-poppins font-bold text-2xl text-primary">
                <i class="fas fa-leaf"></i>
                <span>AgriMap Gorontalo</span>
            </a>
            <ul class="hidden md:flex gap-6" id="navLinks">
                <li><a href="{{ url('/') }}" class="nav-link font-semibold text-gray-800 hover:text-primary transition-colors">Beranda</a></li>
                <li><a href="{{ url('/') }}" class="nav-link font-semibold text-gray-800 hover:text-primary transition-colors">Peta Interaktif</a></li>
                <li><a href="{{ route('all-news') }}" class="nav-link font-semibold text-gray-800 hover:text-primary transition-colors">Berita</a></li>
                <li><a href="{{ url('/') }}" class="nav-link font-semibold text-gray-800 hover:text-primary transition-colors">Sumber Data</a></li>
            </ul>
            
            <div class="flex items-center gap-4">
                @if(Route::has('login'))
                @auth
                
                <a href="{{ url('/dashboard') }}" class="bg-primary text-white px-4 py-2 rounded font-semibold hover:bg-primary-dark transition-colors transform hover:-translate-y-0.5 transition-transform ripple">Dashboard</a>
                @else
                @if (Route::has('register'))
                <a href="{{ route('login') }}" class="bg-primary text-white px-4 py-2 rounded font-semibold hover:bg-primary-dark transition-colors transform hover:-translate-y-0.5 transition-transform ripple">Login</a>
                @endif
                @endauth
                @endif
                <button class="md:hidden text-primary text-xl" id="hamburgerBtn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>
        <!-- Mobile Navigation Menu -->
        <div class="md:hidden hidden bg-white w-full shadow-lg absolute top-full left-0 py-4" id="mobileMenu">
            <ul class="flex flex-col">
                <li><a href="#" class="block py-3 px-6 hover:bg-light-gray">Beranda</a></li>
                <li><a href="#map" class="block py-3 px-6 hover:bg-light-gray">Peta Interaktif</a></li>
                <li><a href="#news" class="block py-3 px-6 hover:bg-light-gray">Berita</a></li>
                <li><a href="#data" class="block py-3 px-6 hover:bg-light-gray">Sumber Data</a></li>
            </ul>
        </div>
    </header>

   @yield('content')


    <!-- Footer -->
    <footer class="bg-primary-dark text-white pt-12 pb-6">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="font-poppins text-xl font-semibold mb-6 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-primary-light">Tentang Kami</h3>
                    <p class="text-gray-300 mb-4">Sistem Pemetaan Lahan 
Pertanian &amp; Perkebunan Gorontalo adalah platform berbasis GIS untuk 
pengelolaan data spasial lahan pertanian.</p>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-300 text-xl hover:text-white transition-colors"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-300 text-xl hover:text-white transition-colors"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-300 text-xl hover:text-white transition-colors"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-300 text-xl hover:text-white transition-colors"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="font-poppins text-xl font-semibold mb-6 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-primary-light">Link Cepat</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Beranda</a></li>
                        <li><a href="#map" class="text-gray-300 hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Peta Interaktif</a></li>
                        <li><a href="#news" class="text-gray-300 hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Berita</a></li>
                        <li><a href="#data" class="text-gray-300 hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Sumber Data</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs"></i> Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-poppins text-xl font-semibold mb-6 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-primary-light">Kontak</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-map-marker-alt"></i> Jl. Jaksa Agung Suprapto No. 10, Gorontalo</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-phone"></i> (0435) 821125</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors flex items-center gap-2"><i class="fas fa-envelope"></i> info@pertanian-gorontalo.go.id</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-poppins text-xl font-semibold mb-6 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-primary-light">Instansi Terkait</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white bg-opacity-10 rounded-lg p-4 flex items-center justify-center">
                            <svg viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                                <rect width="50" height="50" fill="transparent"></rect>
                                <circle cx="25" cy="25" r="20" fill="#ffffff" opacity="0.2"></circle>
                                <path d="M15,25 L35,25 M25,15 L25,35" stroke="#ffffff" stroke-width="2"></path>
                                <circle cx="25" cy="25" r="10" fill="#ffffff" opacity="0.4"></circle>
                            </svg>
                        </div>
                        <div class="bg-white bg-opacity-10 rounded-lg p-4 flex items-center justify-center">
                            <svg viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                                <rect width="50" height="50" fill="transparent"></rect>
                                <rect x="10" y="10" width="30" height="30" fill="#ffffff" opacity="0.2"></rect>
                                <rect x="15" y="15" width="20" height="20" fill="#ffffff" opacity="0.4"></rect>
                            </svg>
                        </div>
                        <div class="bg-white bg-opacity-10 rounded-lg p-4 flex items-center justify-center">
                            <svg viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                                <rect width="50" height="50" fill="transparent"></rect>
                                <polygon points="25,10 40,30 10,30" fill="#ffffff" opacity="0.2"></polygon>
                                <polygon points="25,15 35,30 15,30" fill="#ffffff" opacity="0.4"></polygon>
                            </svg>
                        </div>
                        <div class="bg-white bg-opacity-10 rounded-lg p-4 flex items-center justify-center">
                            <svg viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                                <rect width="50" height="50" fill="transparent"></rect>
                                <circle cx="25" cy="25" r="15" fill="#ffffff" opacity="0.2"></circle>
                                <path d="M15,20 L35,20 L35,30 L15,30 Z" fill="#ffffff" opacity="0.4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center text-gray-400 text-sm pt-6 border-t border-gray-700">
                © 2023 Sistem Pemetaan Lahan Pertanian &amp; Perkebunan Gorontalo. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

    <!-- Modal for Land Details -->
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300" id="landModal">
        <div class="bg-white rounded-lg w-full max-w-lg max-h-[90vh] overflow-y-auto shadow-xl transform translate-y-5 transition-transform duration-300">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h3 class="font-poppins text-2xl font-semibold" id="modalTitle">Detail Lahan</h3>
                <button class="text-2xl text-gray-500 hover:text-gray-800 transition-colors" id="closeModal">×</button>
            </div>
            <div class="p-6" id="landDetails">
                <!-- Land details will be inserted here -->
            </div>
            <div class="p-6 border-t border-gray-200 flex justify-end gap-4">
                <button class="px-4 py-2 border border-gray-300 rounded font-semibold hover:bg-light-gray transition-colors" id="closeModalBtn">Tutup</button>
                <button class="px-4 py-2 bg-primary text-white rounded font-semibold hover:bg-primary-dark transition-colors ripple" id="viewSourceBtn">Lihat Sumber Data</button>
            </div>
        </div>
    </div>

    <script>
        // Handle map
        const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            minZoom: 10,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });

        const osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
            minZoom: 10,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>'
        });

        const openTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            minZoom: 10,
            attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
        });

        // var map = L.map('mapPer').setView([0.7203877454558969, 122.47458474464645], 10);

        var map = L.map('mapPer', {
            center: [0.7203877454558969, 122.47458474464645],
            zoom: 10,
            layers: [osm]
        });

        	// Base Layer Opsi
        const baseLayers = {
            'OpenStreetMap': osm,
            'OSM Humanitarian': osmHOT,
            'OpenTopoMap': openTopoMap
        };

        const layerControl = L.control.layers(baseLayers, {}, {
            position: 'bottomleft'
        }).addTo(map);

        // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        // }).addTo(map);


        // Control info saat hover
        const info = L.control();

        info.onAdd = function (map) {
            this._div = L.DomUtil.create('div', 'info leaflet-control');
            this.update();
            return this._div;
        };

        info.update = function (props) {
            this._div.innerHTML = `<h4>Info Lahan</h4>` + 
                (props ? `<b>Kecamatan: ${props.NAMOBJ || 'Tidak diketahui'}</b><br/>Jenis Tanam: ${props.J_Tanam}` : 'Arahkan ke polygon');
        };

        info.addTo(map);

        // Menyusun pagination dengan tampilan lebih terbatas
        function renderPagination() {
            const paginationDiv = document.getElementById('page-buttons');
            paginationDiv.innerHTML = '';

            const range = 2; // Menampilkan dua halaman sebelumnya dan dua halaman setelahnya
            const startPage = Math.max(1, currentPage - range); // Halaman pertama yang ditampilkan
            const endPage = Math.min(totalPages, currentPage + range); // Halaman terakhir yang ditampilkan

            // Tombol "Previous"
            const prevButton = document.getElementById('prev-btn');
            prevButton.disabled = currentPage === 1;
            prevButton.classList.toggle('disabled', currentPage === 1);
            prevButton.onclick = () => {
                if (currentPage > 1) {
                    currentPage--;
                    renderPage(currentPage);
                    renderPagination();
                }
            };

            // Tombol "Next"
            const nextButton = document.getElementById('next-btn');
            nextButton.disabled = currentPage === totalPages;
            nextButton.classList.toggle('disabled', currentPage === totalPages);
            nextButton.onclick = () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    renderPage(currentPage);
                    renderPagination();
                }
            };

            // Tombol halaman dinamis
            for (let page = startPage; page <= endPage; page++) {
                const pageButton = document.createElement('button');
                pageButton.textContent = page;
                pageButton.classList.add("w-10", "h-10", "flex", "items-center", "justify-center", "border", "border-gray-300", "rounded", "hover:bg-light-gray", "transition-colors");
                if (currentPage === page) {
                    pageButton.classList.add('bg-primary', 'text-white');
                }
                pageButton.onclick = () => {
                    currentPage = page;
                    renderPage(currentPage);
                    renderPagination();
                };
                paginationDiv.appendChild(pageButton);
            }
        }

        const colorMap = {}; // Cache warna berdasarkan kategori

        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for(let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        function getColorByKategori(kategori) {
            if (!colorMap[kategori]) {
                colorMap[kategori] = getRandomColor(); // assign sekali saja
            }
            return colorMap[kategori];
        }

        function geoStyle(feature) {
            return {
            fillColor: getColorByKategori(feature.properties.J_Tanam),
            weight: 1,
            opacity: 0.5,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.35
            };
        }

        // Event saat mouseover, mouseout, click
        function highlightFeature(e) {
            const layer = e.target;

            layer.setStyle({
                weight: 3,
                color: '#666',
                dashArray: '',
                fillOpacity: 0.9
            });

            layer.bringToFront();
            info.update(layer.feature.properties);
        }

        function resetHighlight(e) {
            geojson.resetStyle(e.target);
            info.update();
        }

        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
        }

        function onEachFeature(feature, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
            });
        }

        let geojson;

        const legend = L.control({ position: 'bottomright' });

        // Legenda bawah kanan
        legend.onAdd = function () {
            const div = L.DomUtil.create('div', 'info legend');
            div.id = 'legend-box';

            const allValues = new Set();

            geojson.eachLayer(function (layer) {
                const value = layer.feature.properties.J_Tanam;
                if (value) {
                    allValues.add(value);
                }
            });

            const uniqueValues = Array.from(allValues).sort();
            let labels = [];

            for (let value of uniqueValues) {
                const color = getColorByKategori(value);
                const safeValue = value.replace(/\s+/g, '_');
                labels.push(`
                <input type="checkbox" class="legend-filter" data-value="${value}" checked>
                <i style="background:${color}"></i> ${value}
                `);
            }

            div.innerHTML = `
                <button id="close-legend" style="float:right; border:none; background:none; cursor:pointer;">❌</button>
                ${labels.join('<br>')}
                <button id="show-legend" style="display:none; cursor:pointer;">📌 Tampilkan Jenis Tanam</button>
            `;
            return div;
                };
            
            const legendToggle = L.control({ position: 'bottomright' });

            legendToggle.onAdd = function () {
                const div = L.DomUtil.create('div', 'legend-toggle');
                div.innerHTML = `<button id="show-legend" style="display:none; cursor:pointer; background: white; padding: 0.5 px;">📌 Tampilkan Jenis Tanam</button>`;
                return div;
            };
                // Load GeoJSON
            fetch('assets/maps/pertanian.geojson')
            .then(response => response.json())
            .then(data => {
                
                // Mengatur jumlah data per halaman
                const itemsPerPage = 10;
                const totalItems = data.features.length;
                const totalPages = Math.ceil(totalItems / itemsPerPage);
                let currentPage = 1;

                // Menampilkan data pada halaman yang dipilih
                function renderPage(page) {
                    const startIndex = (page - 1) * itemsPerPage;
                    const endIndex = Math.min(startIndex + itemsPerPage, totalItems);

                    // Mengambil elemen tbody untuk menampilkan data
                    const tableBody = document.getElementById('geojson-data');
                    tableBody.innerHTML = '';

                    // Melakukan iterasi untuk setiap feature dalam GeoJSON pada halaman ini
                    for (let i = startIndex; i < endIndex; i++) {
                        const feature = data.features[i];
                        const row = document.createElement('tr');
                        row.classList.add('hover:bg-green-50', 'transition-colors');

                        const noCell = document.createElement('td');
                        noCell.classList.add('p-4', 'border-b', 'border-gray-200');
                        noCell.textContent = i + 1; // Menampilkan urutan

                        const namobjCell = document.createElement('td');
                        namobjCell.classList.add('p-4', 'border-b', 'border-gray-200');
                        namobjCell.innerHTML = `<a href="#" class="text-primary font-semibold hover:underline">${feature.properties.NAMOBJ ?? ''}</a>`;

                        const jTanamCell = document.createElement('td');
                        jTanamCell.classList.add('p-4', 'border-b', 'border-gray-200');
                        jTanamCell.textContent = feature.properties.J_Tanam ?? '';

                        const luasCell = document.createElement('td');
                        luasCell.classList.add('p-4', 'border-b', 'border-gray-200');
                        luasCell.textContent = feature.properties.Luas ?? '';

                        const kelasCell = document.createElement('td');
                        kelasCell.classList.add('p-4', 'border-b', 'border-gray-200', 'hidden', 'md:table-cell');
                        kelasCell.textContent = feature.properties.KELAS ?? '';

                        const kategoriCell = document.createElement('td');
                        kategoriCell.classList.add('p-4', 'border-b', 'border-gray-200');
                        kategoriCell.textContent = feature.properties.KATEGORI ?? '';

                        // Menambahkan sel ke dalam baris
                        row.appendChild(noCell);
                        row.appendChild(namobjCell);
                        row.appendChild(jTanamCell);
                        row.appendChild(luasCell);
                        row.appendChild(kelasCell);
                        row.appendChild(kategoriCell);

                        // Menambahkan baris ke dalam tabel
                        tableBody.appendChild(row);
                    }
                }

                // Membuat tombol navigasi pagination
                function renderPagination() {
                        const paginationDiv = document.getElementById('page-buttons');
                        paginationDiv.innerHTML = '';

                        const range = 2; // Menampilkan dua halaman sebelumnya dan dua halaman setelahnya
                        const startPage = Math.max(1, currentPage - range); // Halaman pertama yang ditampilkan
                        const endPage = Math.min(totalPages, currentPage + range); // Halaman terakhir yang ditampilkan

                        // Tombol "Previous"
                        const prevButton = document.getElementById('prev-btn');
                        prevButton.disabled = currentPage === 1;
                        prevButton.classList.toggle('disabled', currentPage === 1);
                        prevButton.onclick = () => {
                            if (currentPage > 1) {
                                currentPage--;
                                renderPage(currentPage);
                                renderPagination();
                            }
                        };

                        // Tombol "Next"
                        const nextButton = document.getElementById('next-btn');
                        nextButton.disabled = currentPage === totalPages;
                        nextButton.classList.toggle('disabled', currentPage === totalPages);
                        nextButton.onclick = () => {
                            if (currentPage < totalPages) {
                                currentPage++;
                                renderPage(currentPage);
                                renderPagination();
                            }
                        };

                        // Tombol halaman dinamis
                        for (let page = startPage; page <= endPage; page++) {
                            const pageButton = document.createElement('button');
                            pageButton.textContent = page;
                            pageButton.classList.add("w-10", "h-10", "flex", "items-center", "justify-center", "border", "border-gray-300", "rounded", "hover:bg-light-gray", "transition-colors");
                            if (currentPage === page) {
                                pageButton.classList.add('bg-primary', 'text-white');
                            }
                            pageButton.onclick = () => {
                                currentPage = page;
                                renderPage(currentPage);
                                renderPagination();
                            };
                            paginationDiv.appendChild(pageButton);
                        }
                }

                // Render halaman pertama
                    renderPage(currentPage);
                    renderPagination();
                
                geojson = L.geoJSON(data, {
                    style: geoStyle,
                    onEachFeature: onEachFeature
                }).addTo(map);

                legend.addTo(map);
                legendToggle.addTo(map);
                setTimeout(() => {
                    const closeBtn = document.getElementById('close-legend');
                    const showBtn = document.getElementById('show-legend');

                    if (closeBtn) {
                        closeBtn.onclick = () => {
                    const legendBox = document.getElementById('legend-box');
                    if (legendBox) legendBox.style.display = 'none';
                    if (showBtn) showBtn.style.display = 'block';
                    };
                    }

                    if (showBtn) {
                        showBtn.onclick = () => {
                        const legendBox = document.getElementById('legend-box');
                        if (legendBox) legendBox.style.display = 'block';
                            showBtn.style.display = 'none';
                        };
                    }
                    
                    // Checkbox event listeners
                    const checkboxes = document.querySelectorAll('.legend-filter');
                    checkboxes.forEach(checkbox => {
                        checkbox.addEventListener('change', () => {
                            const selectedValues = Array.from(checkboxes)
                                .filter(cb => cb.checked)
                                .map(cb => cb.dataset.value);

                            geojson.eachLayer(layer => {
                                const val = layer.feature.properties.J_Tanam;
                                if (selectedValues.includes(val)) {
                                    layer.setStyle({ fillOpacity: 0.35, opacity: 1 });
                                } else {
                                    layer.setStyle({ fillOpacity: 0, opacity: 0 });
                                }
                            });
                        });
                    });
                }, 500);
            })
            .catch(error => console.error('Error loading GeoJSON:', error));

        // DOM Elements
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const viewMapBtn = document.getElementById('viewMapBtn');
        const mapSection = document.getElementById('map');
        const mapPlaceholder = document.getElementById('mapPlaceholder');
        const mapTooltip = document.getElementById('mapTooltip');
        const landModal = document.getElementById('landModal');
        const closeModal = document.getElementById('closeModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const viewSourceBtn = document.getElementById('viewSourceBtn');
        const landDetails = document.getElementById('landDetails');
        const modalTitle = document.getElementById('modalTitle');
        const luasLahan = document.getElementById('luasLahan');
        const luasValue = document.getElementById('luasValue');
        const zoomIn = document.getElementById('zoomIn');
        const zoomOut = document.getElementById('zoomOut');

        // Mobile Navigation Toggle
        hamburgerBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Scroll to Map Section
        viewMapBtn.addEventListener('click', () => {
            mapSection.scrollIntoView({ behavior: 'smooth' });
        });

        // Show Map Tooltip
        window.addEventListener('load', () => {
            setTimeout(() => {
                mapTooltip.classList.add('show');
                
                setTimeout(() => {
                    mapTooltip.classList.remove('show');
                }, 5000);
            }, 2000);
            
            // Hide loading spinner and show map
            setTimeout(() => {
                mapPlaceholder.innerHTML = createMapSVG();
                initializeMap();
            }, 1500);
        });

        // Create SVG Map
        function createMapSVG() {
            return `
                <svg width="100%" height="100%" viewBox="0 0 800 600" xmlns="http://www.w3.org/2000/svg">
                    <rect width="800" height="600" fill="#e8f5e9"/>
                    
                    <!-- Water bodies -->
                    <path d="M0,300 Q200,250 400,300 T800,300 L800,600 L0,600 Z" fill="#bbdefb" opacity="0.7"/>
                    
                    <!-- Main land -->
                    <path d="M100,100 L300,50 L500,80 L700,150 L750,300 L650,450 L500,500 L300,480 L150,400 L100,250 Z" fill="#a5d6a7" stroke="#2e7d32" stroke-width="2"/>
                    
                    <!-- Districts -->
                    <path class="district" d="M100,100 L300,50 L350,150 L250,200 L150,180 Z" fill="#66bb6a" stroke="#2e7d32" stroke-width="1"/>
                    <path class="district" d="M300,50 L500,80 L450,200 L350,150 Z" fill="#4caf50" stroke="#2e7d32" stroke-width="1"/>
                    <path class="district" d="M500,80 L700,150 L600,250 L450,200 Z" fill="#66bb6a" stroke="#2e7d32" stroke-width="1"/>
                    <path class="district" d="M150,180 L250,200 L300,300 L200,350 L100,250 Z" fill="#81c784" stroke="#2e7d32" stroke-width="1"/>
                    <path class="district" d="M250,200 L350,150 L450,200 L400,300 L300,300 Z" fill="#4caf50" stroke="#2e7d32" stroke-width="1"/>
                    <path class="district" d="M450,200 L600,250 L550,350 L400,300 Z" fill="#66bb6a" stroke="#2e7d32" stroke-width="1"/>
                    <path class="district" d="M100,250 L200,350 L250,450 L150,400 Z" fill="#81c784" stroke="#2e7d32" stroke-width="1"/>
                    <path class="district" d="M200,350 L300,300 L400,400 L300,480 L250,450 Z" fill="#4caf50" stroke="#2e7d32" stroke-width="1"/>
                    <path class="district" d="M300,300 L400,300 L500,400 L400,400 Z" fill="#66bb6a" stroke="#2e7d32" stroke-width="1"/>
                    <path class="district" d="M400,300 L550,350 L650,450 L500,400 Z" fill="#81c784" stroke="#2e7d32" stroke-width="1"/>
                    <path class="district" d="M250,450 L300,480 L500,500 L400,400 Z" fill="#4caf50" stroke="#2e7d32" stroke-width="1"/>
                    <path class="district" d="M400,400 L500,400 L650,450 L500,500 Z" fill="#66bb6a" stroke="#2e7d32" stroke-width="1"/>
                    
                    <!-- Agricultural lands -->
                    <circle class="land" cx="200" cy="150" r="15" fill="#ffeb3b" stroke="#2e7d32" stroke-width="1" data-id="1" data-name="Kebun Kelapa Limboto" data-owner="Ahmad Dahlan" data-area="45.2" data-commodity="Kelapa"/>
                    <circle class="land" cx="350" cy="100" r="12" fill="#ffc107" stroke="#2e7d32" stroke-width="1" data-id="2" data-name="Sawah Padi Telaga" data-owner="Budi Santoso" data-area="32.8" data-commodity="Padi"/>
                    <circle class="land" cx="550" cy="120" r="18" fill="#ffeb3b" stroke="#2e7d32" stroke-width="1" data-id="3" data-name="Kebun Jagung Batudaa" data-owner="Citra Dewi" data-area="28.5" data-commodity="Jagung"/>
                    <circle class="land" cx="180" cy="280" r="14" fill="#f44336" stroke="#2e7d32" stroke-width="1" data-id="4" data-name="Perkebunan Kelapa Boalemo" data-owner="Dani Pratama" data-area="87.3" data-commodity="Kelapa"/>
                    <circle class="land" cx="320" cy="220" r="16" fill="#ffeb3b" stroke="#2e7d32" stroke-width="1" data-id="5" data-name="Lahan Jagung Gorontalo Utara" data-owner="Eko Widodo" data-area="56.1" data-commodity="Jagung"/>
                    <circle class="land" cx="480" cy="150" r="13" fill="#ffc107" stroke="#2e7d32" stroke-width="1" data-id="6" data-name="Sawah Bone Bolango" data-owner="Fajar Nugroho" data-area="22.4" data-commodity="Padi"/>
                    <circle class="land" cx="580" cy="300" r="17" fill="#ffeb3b" stroke="#2e7d32" stroke-width="1" data-id="7" data-name="Kebun Kelapa Pohuwato" data-owner="Gita Purnama" data-area="65.7" data-commodity="Kelapa"/>
                    <circle class="land" cx="250" cy="380" r="15" fill="#f44336" stroke="#2e7d32" stroke-width="1" data-id="8" data-name="Lahan Jagung Tilamuta" data-owner="Hendra Wijaya" data-area="34.2" data-commodity="Jagung"/>
                    <circle class="land" cx="400" cy="350" r="14" fill="#ffc107" stroke="#2e7d32" stroke-width="1" data-id="9" data-name="Perkebunan Padi Kwandang" data-owner="Indra Kusuma" data-area="41.8" data-commodity="Padi"/>
                    <circle class="land" cx="500" cy="450" r="16" fill="#ffeb3b" stroke="#2e7d32" stroke-width="1" data-id="10" data-name="Kebun Jagung Paguyaman" data-owner="Joko Susilo" data-area="29.6" data-commodity="Jagung"/>
                    
                    <!-- Cities/Towns -->
                    <circle cx="200" cy="150" r="5" fill="#ffffff" stroke="#2e7d32" stroke-width="1"/>
                    <text x="200" y="135" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">Limboto</text>
                    
                    <circle cx="350" cy="100" r="5" fill="#ffffff" stroke="#2e7d32" stroke-width="1"/>
                    <text x="350" y="85" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">Telaga</text>
                    
                    <circle cx="550" cy="120" r="5" fill="#ffffff" stroke="#2e7d32" stroke-width="1"/>
                    <text x="550" y="105" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">Batudaa</text>
                    
                    <circle cx="180" cy="280" r="5" fill="#ffffff" stroke="#2e7d32" stroke-width="1"/>
                    <text x="180" y="265" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">Boalemo</text>
                    
                    <circle cx="480" cy="150" r="5" fill="#ffffff" stroke="#2e7d32" stroke-width="1"/>
                    <text x="480" y="135" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">Bone Bolango</text>
                    
                    <circle cx="320" cy="220" r="5" fill="#ffffff" stroke="#2e7d32" stroke-width="1"/>
                    <text x="320" y="205" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">Gorontalo</text>
                    
                    <!-- Compass -->
                    <circle cx="730" cy="70" r="30" fill="#ffffff" stroke="#2e7d32" stroke-width="1" opacity="0.8"/>
                    <path d="M730,40 L730,100 M700,70 L760,70" stroke="#2e7d32" stroke-width="1"/>
                    <text x="730" y="55" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">U</text>
                    <text x="745" y="75" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">T</text>
                    <text x="730" y="90" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">S</text>
                    <text x="715" y="75" font-size="12" text-anchor="middle" fill="#2e7d32" font-weight="bold">B</text>
                    
                    <!-- Scale -->
                    <rect x="650" y="550" width="100" height="10" fill="#ffffff" stroke="#2e7d32" stroke-width="1"/>
                    <text x="700" y="540" font-size="12" text-anchor="middle" fill="#2e7d32">10 km</text>
                </svg>
            `;
        }

        // Initialize Map Interactions
        function initializeMap() {
            const lands = document.querySelectorAll('.land');
            
            lands.forEach(land => {
                land.addEventListener('click', (e) => {
                    const landData = {
                        id: e.target.getAttribute('data-id'),
                        name: e.target.getAttribute('data-name'),
                        owner: e.target.getAttribute('data-owner'),
                        area: e.target.getAttribute('data-area'),
                        commodity: e.target.getAttribute('data-commodity')
                    };
                    
                    showLandDetails(landData);
                });
                
                land.addEventListener('mouseover', () => {
                    land.style.cursor = 'pointer';
                    land.style.transform = 'scale(1.2)';
                    land.style.transition = 'transform 0.3s ease';
                });
                
                land.addEventListener('mouseout', () => {
                    land.style.transform = 'scale(1)';
                });
            });
            
            // Zoom controls
            let currentZoom = 1;
            const mapSvg = document.querySelector('.map svg');
            
            zoomIn.addEventListener('click', () => {
                currentZoom += 0.1;
                if (currentZoom > 2) currentZoom = 2;
                mapSvg.style.transform = `scale(${currentZoom})`;
            });
            
            zoomOut.addEventListener('click', () => {
                currentZoom -= 0.1;
                if (currentZoom < 0.5) currentZoom = 0.5;
                mapSvg.style.transform = `scale(${currentZoom})`;
            });
            
            // Make map draggable
            let isDragging = false;
            let startX, startY, translateX = 0, translateY = 0;
            
            mapSvg.addEventListener('mousedown', (e) => {
                isDragging = true;
                startX = e.clientX - translateX;
                startY = e.clientY - translateY;
                mapSvg.style.cursor = 'grabbing';
            });
            
            document.addEventListener('mousemove', (e) => {
                if (!isDragging) return;
                translateX = e.clientX - startX;
                translateY = e.clientY - startY;
                mapSvg.style.transform = `scale(${currentZoom}) translate(${translateX/currentZoom}px, ${translateY/currentZoom}px)`;
            });
            
            document.addEventListener('mouseup', () => {
                isDragging = false;
                mapSvg.style.cursor = 'grab';
            });

            // Touch events for mobile
            mapSvg.addEventListener('touchstart', (e) => {
                if (e.touches.length === 1) {
                    isDragging = true;
                    startX = e.touches[0].clientX - translateX;
                    startY = e.touches[0].clientY - translateY;
                }
            });
            
            mapSvg.addEventListener('touchmove', (e) => {
                if (!isDragging || e.touches.length !== 1) return;
                translateX = e.touches[0].clientX - startX;
                translateY = e.touches[0].clientY - startY;
                mapSvg.style.transform = `scale(${currentZoom}) translate(${translateX/currentZoom}px, ${translateY/currentZoom}px)`;
                e.preventDefault(); // Prevent page scrolling
            });
            
            mapSvg.addEventListener('touchend', () => {
                isDragging = false;
            });
        }

        // Show Land Details Modal
        function showLandDetails(landData) {
            modalTitle.textContent = landData.name;
            
            landDetails.innerHTML = `
                <div class="mb-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center mr-3">
                            <i class="fas fa-map-marker-alt text-white"></i>
                        </div>
                        <h4 class="font-poppins font-semibold text-lg">${landData.name}</h4>
                    </div>
                    <div class="bg-light-gray rounded-lg p-4 mb-4">
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Pemilik:</span>
                            <span>${landData.owner}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Luas Lahan:</span>
                            <span>${landData.area} hektar</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-semibold">Komoditas Utama:</span>
                            <span>${landData.commodity}</span>
                        </div>
                    </div>
                    <div class="bg-green-50 rounded-lg p-4">
                        <h5 class="font-poppins font-semibold mb-2">Informasi Tambahan</h5>
                        <p class="text-sm">Data terakhir diperbarui pada 10 Juni 2023. Lahan ini memiliki produktivitas di atas rata-rata untuk komoditas ${landData.commodity} di wilayah Gorontalo.</p>
                    </div>
                </div>
            `;
            
            landModal.classList.remove('invisible', 'opacity-0');
            landModal.querySelector('.modal-content').classList.remove('translate-y-5');
        }

        // Close Modal
        closeModal.addEventListener('click', () => {
            landModal.classList.add('invisible', 'opacity-0');
            landModal.querySelector('.modal-content').classList.add('translate-y-5');
        });
        
        closeModalBtn.addEventListener('click', () => {
            landModal.classList.add('invisible', 'opacity-0');
            landModal.querySelector('.modal-content').classList.add('translate-y-5');
        });
        
        viewSourceBtn.addEventListener('click', () => {
            window.location.href = '#data';
            landModal.classList.add('invisible', 'opacity-0');
            landModal.querySelector('.modal-content').classList.add('translate-y-5');
        });

        // Update Luas Lahan Value
        luasLahan.addEventListener('input', () => {
            luasValue.textContent = `${luasLahan.value} ha`;
        });

        // Add ripple effect to buttons
        const rippleButtons = document.querySelectorAll('.ripple');
        
        rippleButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.width = '1px';
                ripple.style.height = '1px';
                ripple.style.borderRadius = '50%';
                ripple.style.transform = 'scale(0)';
                ripple.style.backgroundColor = 'rgba(255, 255, 255, 0.7)';
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;
                ripple.style.animation = 'ripple 0.6s linear';
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
        
        // Ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(100);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        
    </script>

    <script>
    (function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'93c6e287a5f44c11',t:'MTc0NjY4NTU4MC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();
    </script>
    <iframe height="1" width="1" style="position: absolute; top: 0px; left: 0px; border: medium; visibility: hidden;">
    </iframe>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>