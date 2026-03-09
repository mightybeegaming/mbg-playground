async function loadServerMetrics() {
    const request = await fetch('/php/servermetrics.php?server=ProjectZomboid', {cache: 'no-store'});
    const data = await request.json();
    // console.log(data);

    let worldAge = '';
    if(data.worldAge && data.season) {
        worldAge += `<span class="highlight">${data.season}</span>`;
        worldAge += '<b> | </b>';
        worldAge += `<span class="highlight">${data.worldAge} days</span>`;
    }

    let dateTime = '';
    if(data.worldDate && data.worldTime) {
        dateTime += `<span class="highlight">${data.worldDate}</span>`;
        dateTime += '<b> | </b>';
        dateTime += `<span class="highlight">${data.worldTime}</span>`;
    }

    let weatherTemperature = '';
    if(data.weather && data.temperature) {
        weatherTemperature = `<span class="highlight">${data.weather}</span>`;
        weatherTemperature += '<b> | </b>';
        weatherTemperature += `<span class="highlight">${data.temperature} °C</span>`;
    }

    document.getElementById('statusText').textContent = data.server.statusText;
    document.getElementById('uptime24').textContent = `${data.server.uptime24} %`;
    document.getElementById('onlinePlayers').textContent = `${data.onlinePlayers} / 100`;
    document.getElementById('worldAge').innerHTML = worldAge;
    document.getElementById('dateTime').innerHTML = dateTime;
    document.getElementById('weatherTemperature').innerHTML = weatherTemperature;
}
setInterval(loadServerMetrics, 5000);
loadServerMetrics();