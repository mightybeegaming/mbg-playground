async function loadServerMetrics() {
    const requestMetrics = await fetch('/php/metrics.php?server=all', {cache: 'no-store'});
    const metrics = await requestMetrics.json();
    // console.log(metrics);

    const counterStrike = metrics['counterStrike'];
    document.getElementById('status-counterstrike').innerHTML = counterStrike.server.statusIndicator;
    document.getElementById('tags-counterstrike').innerHTML = tagBuilder(counterStrike.tags);
    // console.log(counterStrike);

    const hytale = metrics['hytale'];
    document.getElementById('status-hytale').innerHTML = hytale.server.statusIndicator;
    document.getElementById('tags-hytale').innerHTML = tagBuilder(hytale.tags);
    // console.log(hytale);

    const projectZomboid = metrics['projectZomboid'];
    document.getElementById('status-projectzomboid').innerHTML = projectZomboid.server.statusIndicator;
    document.getElementById('tags-projectzomboid').innerHTML = tagBuilder(projectZomboid.tags);
    // console.log(projectZomboid);

    const vRising = metrics['vRising'];
    document.getElementById('status-vrising').innerHTML = vRising.server.statusIndicator;
    document.getElementById('tags-vrising').innerHTML = tagBuilder(vRising.tags);
    // console.log(vRising);

    const valheim = metrics['valheim'];
    document.getElementById('status-valheim').innerHTML = valheim.server.statusIndicator;
    document.getElementById('tags-valheim').innerHTML = tagBuilder(valheim.tags);
    // console.log(valheim);
}
setInterval(loadServerMetrics, 5000);
loadServerMetrics();