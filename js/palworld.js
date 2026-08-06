async function loadServerMetrics() {
    const request = await fetch('/php/metrics.php?server=palworld', {'cache': 'no-store'});
    const data = await request.json();
    // console.log(data);

    displayCommonMetrics(data);

    document.getElementById('worldAge').textContent = `Day ${data.worldAge}`;
    document.getElementById('baseCamps').textContent = data.baseCamps;

    remaining = intervalSeconds;
}
setInterval(loadServerMetrics, metricsUpdateInterval);
loadServerMetrics();