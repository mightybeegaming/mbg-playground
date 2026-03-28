/*
 * Globals
 */
const metricsUpdateInterval = 10000;

/*
 * Auto Refresh Countdown
 */

function formatTime(sec) {
    let minutes = Math.floor(sec / 60);
    minutes = String(minutes).padStart(2, '0');

    let seconds = sec % 60;
    seconds = String(seconds).padStart(2, '0');

    return `${minutes}:${seconds}`;
}

function autoRefreshCountdown() {
    const autoRefreshCountdownElement = document.getElementById('autoRefreshCountdown');

    setInterval(() => {
        remaining--;
        if(remaining < 0) remaining = intervalSeconds;

        autoRefreshCountdownElement.textContent = formatTime(remaining);
    }, 1000);
}

let intervalSeconds = metricsUpdateInterval / 1000;
autoRefreshCountdown();

/*
 * Metrics Builders
 */

function tagBuilder(tags) {
    tags = tags.split('|');

    let stringTags = '';
    for(let i = 0; i < tags.length; i++) {
        stringTags += `<span class="widget tag">${tags[i]}</span>`;
    }

    return stringTags;
}

function statusBuilder(metrics) {
    const status = [];
    
    let onlinePlayers = metrics.onlinePlayers;
    onlinePlayers = (onlinePlayers > 0) ? `${onlinePlayers} ` : '';

    const onlineIndicator = `<span class="widget status-online">${onlinePlayers}ONLINE</span>`;
    const offlineIndicator = '<span class="widget status-offline">OFFLINE</span>';

    const serverStatus = metrics.server.status;
    status.indicator = serverStatus ? onlineIndicator : offlineIndicator;
    status.text = serverStatus ? 'ONLINE' : 'OFFLINE';

    return status;
}

function displayCommonMetrics(data) {
    const status = statusBuilder(data);
    const statusTextElement = document.getElementById('statusText');
    statusTextElement.textContent = status.text;
    statusTextElement.classList.add(status.text);

    document.getElementById('tags').innerHTML = tagBuilder(data.tags);
    document.getElementById('uptime24').textContent = `${data.server.uptime24} %`;
    document.getElementById('onlinePlayers').textContent = `${data.onlinePlayers} / ${data.maxPlayers}`;
}