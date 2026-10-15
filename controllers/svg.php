<?php
// Gráficos SVG de Ghost Hunter's Den
function svgCasaEmbrujada() {
    return '<svg viewBox="0 0 600 300" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Casa embrujada bajo la luna">
        <rect width="600" height="300" fill="#060a08"/>
        <circle cx="500" cy="60" r="38" fill="#e9edc9" opacity="0.9"/>
        <circle cx="488" cy="50" r="38" fill="#060a08"/>
        <g fill="#0e1512" stroke="#4dff9e" stroke-width="2">
            <polygon points="150,160 300,60 450,160" />
            <rect x="180" y="160" width="240" height="120" />
        </g>
        <rect x="270" y="200" width="60" height="80" fill="#060a08" stroke="#ff2e4d" stroke-width="2"/>
        <rect x="205" y="185" width="35" height="35" fill="#ffcf6b" opacity="0.85"/>
        <rect x="360" y="185" width="35" height="35" fill="#4dff9e" opacity="0.35"/>
        <g stroke="#8fa89f" stroke-width="2">
            <path d="M40,290 C80,260 120,290 160,270" fill="none"/>
            <path d="M420,290 C460,265 500,290 560,270" fill="none"/>
        </g>
        <g fill="#0e1512">
            <ellipse cx="80" cy="95" rx="10" ry="4"/>
            <ellipse cx="105" cy="80" rx="8" ry="3"/>
            <ellipse cx="130" cy="100" rx="9" ry="3"/>
        </g>
    </svg>';
}
function svgEquipo($tipo) {
    switch ($tipo) {
        case 'emf':
            return '<svg viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg"><rect x="20" y="20" width="80" height="90" rx="8" fill="#0e1512" stroke="#4dff9e" stroke-width="3"/><rect x="32" y="32" width="56" height="30" fill="#060a08" stroke="#ffcf6b" stroke-width="2"/><circle cx="45" cy="47" r="4" fill="#ff2e4d"/><circle cx="60" cy="47" r="4" fill="#ffcf6b"/><circle cx="75" cy="47" r="4" fill="#4dff9e"/><circle cx="60" cy="85" r="14" fill="#060a08" stroke="#4dff9e" stroke-width="3"/></svg>';
        case 'camara':
            return '<svg viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg"><rect x="15" y="35" width="90" height="55" rx="8" fill="#0e1512" stroke="#ff2e4d" stroke-width="3"/><circle cx="60" cy="62" r="22" fill="#060a08" stroke="#ffcf6b" stroke-width="3"/><circle cx="60" cy="62" r="10" fill="#4dff9e" opacity="0.5"/><rect x="40" y="22" width="40" height="15" fill="#0e1512" stroke="#ff2e4d" stroke-width="2"/></svg>';
        case 'linterna':
            return '<svg viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg"><rect x="35" y="20" width="30" height="60" rx="6" fill="#0e1512" stroke="#4dff9e" stroke-width="3"/><polygon points="35,20 65,20 78,5 22,5" fill="#0e1512" stroke="#4dff9e" stroke-width="3"/><polygon points="30,85 70,85 95,115 5,115" fill="#ffcf6b" opacity="0.25"/></svg>';
        default:
            return '<svg viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg"><rect x="52" y="10" width="16" height="70" rx="8" fill="#0e1512" stroke="#4dff9e" stroke-width="3"/><circle cx="60" cy="92" r="18" fill="#060a08" stroke="#ff2e4d" stroke-width="3"/><rect x="56" y="30" width="8" height="50" fill="#ff2e4d"/><circle cx="60" cy="92" r="9" fill="#ff2e4d"/></svg>';
    }
}
function svgFantasma($color) {
    return '<svg viewBox="0 0 120 140" xmlns="http://www.w3.org/2000/svg"><path d="M60 10 C25 10 15 40 15 65 L15 120 L30 105 L45 120 L60 105 L75 120 L90 105 L105 120 L105 65 C105 40 95 10 60 10 Z" fill="' . $color . '" opacity="0.85"/><circle cx="42" cy="60" r="7" fill="#060a08"/><circle cx="78" cy="60" r="7" fill="#060a08"/><ellipse cx="60" cy="80" rx="10" ry="6" fill="#060a08" opacity="0.6"/></svg>';
}
function svgHabitacion() {
    return '<svg viewBox="0 0 400 240" xmlns="http://www.w3.org/2000/svg"><rect width="400" height="240" fill="#060a08"/><polygon points="120,0 280,0 400,240 0,240" fill="#ffcf6b" opacity="0.06"/><rect x="60" y="40" width="60" height="90" fill="#0e1512" stroke="#4dff9e" stroke-width="2"/><rect x="280" y="60" width="50" height="70" fill="#0e1512" stroke="#ff2e4d" stroke-width="2"/><circle cx="200" cy="170" r="18" fill="#4dff9e" opacity="0.5"/><rect x="0" y="210" width="400" height="30" fill="#0e1512"/></svg>';
}