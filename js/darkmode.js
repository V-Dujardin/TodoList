function changeMode(mode)
{
    if (mode)
    { // light mode
        document.getElementById ( 'lightCss' ).href = '/Session/css/acceuil/colordark.css';
    }
    else
    { // dark mode   
        document.getElementById ( 'lightCss' ).href = '/Session/css/acceuil/colorlight.css';
    }
}

// heho

window.onload = function()
{
    document.getElementById('lightCss').href = '/Session/css/acceuil/colorlight.css';
}