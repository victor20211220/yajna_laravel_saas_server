
$(function(){
    $businessCard = $(`#businessCard`)[0];
    $businessCard.style.setProperty('--custom-section-border-color', getRelativeBorderColor());
    $(`#businessCard`).fadeIn();
})
function getRelativeBorderColor() {
    // Get the value of --custom-color from CSS
    const customColor = getComputedStyle($businessCard)
        .getPropertyValue('--custom-card-bg')
        .trim();

    // Convert hex/rgb to RGB values
    const rgb = getRGBValues(customColor);
    if (!rgb) return '#ccc'; // fallback

    const brightness = getBrightness(rgb.r, rgb.g, rgb.b);

    // Threshold: 128 is mid-point (0–255)
    return brightness > 180 ? '#C9CCD1' : '#000000';
}

// Helper to convert any CSS color (hex or rgb) to RGB object
function getRGBValues(color) {
    if (color.startsWith('#')) {
        let c = color.substring(1);
        if (c.length === 3) c = c.split('').map(ch => ch + ch).join('');
        if (c.length !== 6) return null;
        return {
            r: parseInt(c.slice(0, 2), 16),
            g: parseInt(c.slice(2, 4), 16),
            b: parseInt(c.slice(4, 6), 16)
        };
    } else if (color.startsWith('rgb')) {
        const match = color.match(/rgba?\((\d+),\s*(\d+),\s*(\d+)/);
        if (!match) return null;
        return {
            r: parseInt(match[1]),
            g: parseInt(match[2]),
            b: parseInt(match[3])
        };
    }
    return null;
}

// Brightness formula based on perceived luminance
function getBrightness(r, g, b) {
    return 0.299 * r + 0.587 * g + 0.114 * b;
}
