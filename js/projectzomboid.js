async function loadServerMetrics() {
    const request = await fetch('/php/metrics.php?server=projectZomboid', {'cache': 'no-store'});
    const data = await request.json();
    // console.log(data);
    
    displayCommonMetrics(data);

    let dateTime = '';
    dateTime += `<span class="highlight">${data.worldDate}</span>`;
    dateTime += '<b> | </b>';
    dateTime += `<span class="highlight">${data.worldTime}</span>`;

    document.getElementById('worldAge').textContent = `Day ${data.worldAge}`;
    document.getElementById('dateTime').innerHTML = dateTime;
    document.getElementById('season').textContent = data.season;
    document.getElementById('weather').textContent = data.weather;
    document.getElementById('temperature').textContent = `${data.temperature} °C`;

    remaining = intervalSeconds;
}
setInterval(loadServerMetrics, metricsUpdateInterval);
loadServerMetrics();