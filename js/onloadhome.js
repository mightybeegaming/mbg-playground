async function loadServerMetrics() {
    const requestMetrics = await fetch('/php/server.php?method=getMetrics', {cache: 'no-store'});
    const metrics = await requestMetrics.json();

    const counterStrike = metrics['counterStrike'];
    document.getElementById('status-counterstrike').innerHTML = counterStrike.server.statusIndicator;
    // console.log(counterStrike);

    const hytale = metrics['hytale'];
    document.getElementById('status-hytale').innerHTML = hytale.server.statusIndicator;
    // console.log(hytale);

    const projectZomboid = metrics['projectZomboid'];
    document.getElementById('status-projectzomboid').innerHTML = projectZomboid.server.statusIndicator;
    // console.log(projectZomboid);

    const vRising = metrics['vRising'];
    document.getElementById('status-vrising').innerHTML = vRising.server.statusIndicator;
    // console.log(vRising);
}
setInterval(loadServerMetrics, 5000);
loadServerMetrics();