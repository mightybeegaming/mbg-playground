async function loadServerMetrics() {
    const request = await fetch('/php/metrics.php?server=hytale', {'cache': 'no-store'});
    const data = await request.json();
    // console.log(data);

    displayCommonMetrics(data);

    let worldAge = '';
    worldAge += `<span class="highlight">Day ${data.dayOfYear}</span>`;
    worldAge += '<b> | </b>';
    worldAge += `<span class="highlight">Year ${data.year}</span>`;

    document.getElementById('worldAge').innerHTML = worldAge;
    document.getElementById('moonPhase').textContent = `${data.moonPhase} phase`;

    remaining = intervalSeconds;
}
setInterval(loadServerMetrics, metricsUpdateInterval);
loadServerMetrics();