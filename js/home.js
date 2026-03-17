async function loadServerMetrics() {
    const requestMetrics = await fetch('/php/metrics.php?server=all', {cache: 'no-store'});
    const metrics = await requestMetrics.json();
    // console.log(metrics);

    const counterStrike = metrics['counterStrike'];
    const counterStrikeStatus = statusBuilder(counterStrike);
    document.getElementById('status-counterstrike').innerHTML = counterStrikeStatus.indicator;
    document.getElementById('tags-counterstrike').innerHTML = tagBuilder(counterStrike.tags);
    // console.log(counterStrike);

    const hytale = metrics['hytale'];
    const hytaleStatus = statusBuilder(hytale);
    document.getElementById('status-hytale').innerHTML = hytaleStatus.indicator;
    document.getElementById('tags-hytale').innerHTML = tagBuilder(hytale.tags);
    // console.log(hytale);

    const projectZomboid = metrics['projectZomboid'];
    const projectZomboidStatus = statusBuilder(projectZomboid);
    document.getElementById('status-projectzomboid').innerHTML = projectZomboidStatus.indicator;
    document.getElementById('tags-projectzomboid').innerHTML = tagBuilder(projectZomboid.tags);
    // console.log(projectZomboid);

    const vRising = metrics['vRising'];
    const vRisingStatus = statusBuilder(vRising);
    document.getElementById('status-vrising').innerHTML = vRisingStatus.indicator;
    document.getElementById('tags-vrising').innerHTML = tagBuilder(vRising.tags);
    // console.log(vRising);

    const valheim = metrics['valheim'];
    const valheimStatus = statusBuilder(valheim);
    document.getElementById('status-valheim').innerHTML = valheimStatus.indicator;
    document.getElementById('tags-valheim').innerHTML = tagBuilder(valheim.tags);
    // console.log(valheim);
}
setInterval(loadServerMetrics, 5000);
loadServerMetrics();