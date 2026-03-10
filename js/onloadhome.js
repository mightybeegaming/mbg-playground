async function loadServerMetrics() {
    const requestCounterStrike = await fetch('/php/server.php?metrics=counterStrike', {cache: 'no-store'});
    const dataCounterStrike = await requestCounterStrike.json();
    document.getElementById('status-counterstrike').innerHTML = dataCounterStrike.server.statusIndicator;
    // console.log(dataCounterStrike);

    const requestHytale = await fetch('/php/server.php?metrics=hytale', {cache: 'no-store'});
    const dataHytale = await requestHytale.json();
    document.getElementById('status-hytale').innerHTML = dataHytale.server.statusIndicator;
    // console.log(dataHytale);

    const requestProjectZomboid = await fetch('/php/server.php?metrics=projectZomboid', {cache: 'no-store'});
    const dataProjectZomboid = await requestProjectZomboid.json();
    document.getElementById('status-projectzomboid').innerHTML = dataProjectZomboid.server.statusIndicator;
    // console.log(dataProjectZomboid);

    const requestVRising = await fetch('/php/server.php?metrics=vRising', {cache: 'no-store'});
    const dataVRising = await requestVRising.json();
    document.getElementById('status-vrising').innerHTML = dataVRising.server.statusIndicator;
    // console.log(dataVRising);
}
setInterval(loadServerMetrics, 5000);
loadServerMetrics();