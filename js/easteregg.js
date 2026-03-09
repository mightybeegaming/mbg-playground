const konamiCode = [
    'ArrowUp', 'ArrowUp',
    'ArrowDown','ArrowDown',
    'ArrowLeft', 'ArrowRight',
    'ArrowLeft', 'ArrowRight',
    'b','a'
];

let userInput = [];

document.addEventListener('keydown', function(e) {
    userInput.push(e.key);

    if(userInput.length > konamiCode.length) userInput.shift();

    if(JSON.stringify(userInput) === JSON.stringify(konamiCode)) {
        document.getElementById('1up').play();
        console.log('Konami Code Activated!');
    }
});