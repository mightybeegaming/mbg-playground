async function loadServerMetrics() {
    const request = await fetch('/php/metrics.php?server=vRising', {'cache': 'no-store'});
    const data = await request.json();
    // console.log(data);

    displayCommonMetrics(data);

    document.getElementById('clans').textContent = data.clans;

    /*
    document.getElementById('phase').textContent = data.phase;
    document.getElementById('timeLeft').textContent = data.timeLeft;
    document.getElementById('time').textContent = data.time;
    */

    remaining = intervalSeconds;
}
setInterval(loadServerMetrics, metricsUpdateInterval);
loadServerMetrics();